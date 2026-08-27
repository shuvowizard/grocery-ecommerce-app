<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function create()
    {
        if (Auth::guard('web')->check()) {
            return to_route('dashboard');
        }
        return view('user.auth.register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\']+$/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:3']
        ], [
            'name.regex' => 'Name can only contain letters, spaces, hyphens and apostrophes.',
        ]);

        $token = hash('sha256', time());

        $user = new User;
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = $credentials['password'];
        $user->token = $token;
        $user->token_expires_at = Carbon::now()->addHours(1);
        $user->save();

        $link = route('verify.email', [$user->token, $user->email]);
        $subject = "Email Verification";
        $message = "Click on the following link to verify your email: <a href='$link'>$link</a>";

        Mail::to($user->email)->send(new WebsiteMail($subject, $message));

        return redirect()->back()->with('success', 'Registration successful. Please check your email for verify your account.');
    }

    public function verifyEmail($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();

        if ($user) {
            $user->token = null;
            $user->token_expires_at = null;
            $user->status = 1;
            $user->update();
            return redirect()->route('login')->with('success', 'Email verified successfully. You can now login.');
        }

        return redirect()->route('login')->with('error', 'Invalid token or email.');
    }

    public function loginForm()
    {
        if (Auth::guard('web')->check()) {
            return to_route('dashboard');
        }
        return view('user.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'status' => 1,
        ];

        if (Auth::guard('web')->attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function forgetPassword()
    {
        if (Auth::guard('web')->check()) {
            return to_route('dashboard');
        }
        return view('user.auth.forget-password');
    }

    public function forgetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'lowercase'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = hash('sha256', time());
            $user->token = $token;
            $user->token_expires_at = Carbon::now()->addHours(1);  // Token expires in 1 hour
            $user->update();

            $link = route('reset.password', [$token, $request->email]);
            $subject = "Reset Your Password";
            $message = "Click the following link to reset your password (Valid for 1 hour): <a href='$link'>$link</a>";

            Mail::to($request->email)->send(new WebsiteMail($subject, $message));
            return redirect()->back()->with('success', 'Password reset link has been sent to your email.');
        } else {
            return redirect()->back()->with('error', 'Email not found.');
        }
    }

    public function resetPassword(string $token, string $email)
    {
        $user = User::where('token', $token)
            ->where('email', $email)
            ->where('token_expires_at', '>', Carbon::now())
            ->first();

        if ($user) {
            return view('user.auth.reset-password', compact('token', 'email'));
        } else {
            return redirect()->route('forget.password')->with('error', 'Invalid token or email.');
        }
    }

    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        $user = User::where('token', $request->token)
            ->where('email', $request->email)
            ->where('token_expires_at', '>', Carbon::now())
            ->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->token = null;
            $user->token_expires_at = null;
            $user->update();
            return redirect()->route('login')->with('success', 'Password reset successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid token or email.');
        }
    }

    public function profile()
    {
        $user = Auth::guard('web')->user();
        return view('user.auth.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\']+$/u'],
            'password' => ['nullable', 'min:3', 'confirmed'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/', 'unique:users,phone,' . Auth::guard('web')->user()->id],
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'zip' => ['required', 'string', 'max:20'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'name.regex' => 'Name can only contain letters, spaces, hyphens and apostrophes.',
            'phone.regex' => 'Phone can only contain numbers, +, -, spaces and parentheses.',
        ]);

        $user = Auth::guard('web')->user();

        // Update password
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Upload photo
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($user->photo && file_exists(public_path('uploads/user/' . $user->photo))) {
                unlink(public_path('uploads/user/' . $user->photo));
            }
            // Upload new photo
            $image = $request->file('photo');
            $imageName = 'user_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user'), $imageName);
            $user->photo = $imageName;
        }

        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->country = $validated['country'];
        $user->state = $validated['state'];
        $user->city = $validated['city'];
        $user->zip = $validated['zip'];
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::guard('web')->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.orders', compact('orders'));
    }

    public function wishlist()
    {
        return view('user.wishlist');
    }

}

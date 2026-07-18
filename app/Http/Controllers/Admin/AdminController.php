<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    public function forgetPassword()
    {
        return view('admin.auth.forget-password');
    }

    public function forgetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'lowercase'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            $token = hash('sha256', time());
            $admin->token = $token;
            $admin->token_expires_at = Carbon::now()->addHours(1);  // Token expires in 1 hour
            $admin->update();

            $link = route('admin.reset.password', [$token, $request->email]);
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
        $admin = Admin::where('token', $token)
            ->where('email', $email)
            ->where('token_expires_at', '>', Carbon::now())
            ->first();

        if ($admin) {
            return view('admin.auth.reset-password', compact('token', 'email'));
        } else {
            return redirect()->route('admin.forget.password')->with('error', 'Invalid token or email.');
        }
    }

    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $admin = Admin::where('token', $request->token)
            ->where('email', $request->email)
            ->where('token_expires_at', '>', Carbon::now())
            ->first();

        if ($admin) {
            $admin->password = Hash::make($request->password);
            $admin->token = null;
            $admin->token_expires_at = null;
            $admin->update();
            return redirect()->route('admin.login')->with('success', 'Password reset successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid token or email.');
        }
    }

    public function profile()
    {
   
        return view('admin.auth.profile',);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\']+$/u'],
            'password' => ['nullable', 'min:3', 'confirmed'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ], [
            'name.regex' => 'Name can only contain letters, spaces, hyphens and apostrophes.',
        ]);

        $admin = Auth::guard('admin')->user();

        // ২. Password update
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // ৩. Photo update
        if ($request->hasFile('photo')) {
            // old photo delete
            if ($admin->photo && file_exists(public_path('uploads/admin/' . $admin->photo))) {
                unlink(public_path('uploads/admin/' . $admin->photo));
            }

            // new photo upload
            $image = $request->file('photo');
            $imageName = 'admin_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin'), $imageName);
            $admin->photo = $imageName;  // consistent column name
        }

        // ৪. Other fields update
        $admin->name = $request->name;
        $admin->update();

        return back()->with('success', 'Profile updated successfully.');
    }
}

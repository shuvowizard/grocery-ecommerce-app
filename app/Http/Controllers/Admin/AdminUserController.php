<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\']+$/u'],
            'email' => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/', 'unique:users,phone'],
            'address' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'zip' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'string', 'max:100'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ], [
            'name.regex' => 'Name can only contain letters, spaces, hyphens and apostrophes.',
            'phone.regex' => 'Phone can only contain numbers, +, -, spaces and parentheses.',
        ]);

        $user = new User();

        if ($request->hasFile('photo')) {
            # new photo upload
            $image = $request->file('photo');
            $imageName = 'user_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user'), $imageName);
            $user->photo = $imageName;  # consistent column name
        }

        # Generate an 8-character random password
        $password = Str::random(8);
        $user->password = Hash::make($password);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->status = $request->status;
        $user->save();

        // Send Mail to User with their credentials
        $subject = "Your account has been created successfully.";
        $message = "<h3>Hello " . $request->name . ",</h3>
                    <p>See your login details below.</p>
                    <p><strong>Login URL:</strong> <a href='" . route('login') . "'>" . route('login') . "</a></p>
                    <p><strong>Email:</strong> " . $request->email . "</p>
                    <p><strong>Password:</strong> " . $password . "</p>
                ";

        Mail::to($request->email)->send(new WebsiteMail($subject, $message));

        return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\']+$/u'],
            'email' => ['required', 'string', 'email', 'lowercase', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/', Rule::unique(User::class)->ignore($user->id)],
            'address' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'zip' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'string', 'max:100'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ], [
            'name.regex' => 'Name can only contain letters, spaces, hyphens and apostrophes.',
            'phone.regex' => 'Phone can only contain numbers, +, -, spaces and parentheses.',
        ]);

        if ($request->hasFile('photo')) {
            # old photo delete
            if ($user->photo && file_exists(public_path('uploads/user/' . $user->photo))) {
                unlink(public_path('uploads/user/' . $user->photo));
            }
            # new photo upload
            $image = $request->file('photo');
            $imageName = 'user_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user'), $imageName);
            $user->photo = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.user.index')
                ->with('error', 'User not found.');
        }

        # Photo delete
        if ($user->photo != null && file_exists(public_path('uploads/user/' . $user->photo))) {
            unlink(public_path('uploads/user/' . $user->photo));
        }

        # User delete
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }
}

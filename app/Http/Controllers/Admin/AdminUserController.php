<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'phone' => ['nullable', 'string', 'max:20', 'unique:users,phone'],
            'address' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'zip' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'string', 'max:100'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ], [
            'name.regex' => 'Name can only contain letters, spaces, hyphens and apostrophes.',
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

    public function edit(String $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }
}

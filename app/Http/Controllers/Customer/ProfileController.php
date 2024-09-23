<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Display the authenticated user's profile.
     */
    public function show()
    {
        $user = Auth::guard('customer')->user(); // Get the authenticated user
        return view('customer.layout.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::guard('customer')->user(); // Get the authenticated user
        return view('customer.layout.edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    //     $user = Auth::guard('customer')->user(); // Get the authenticated user

    //     // Validate the request
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:15',
    //         'username' => 'required|string|max:255|unique:customers,username,' . $user->id,
    //         'email' => 'required|string|email|max:255|unique:customers,email,' . $user->id,
    //         'password' => 'nullable|string|min:5|confirmed', // Password is optional for update
    //     ]);

    //     // Update user information
    //     $user->name = $request->name;
    //     $user->phone = $request->phone;
    //     $user->username = $request->username;
    //     $user->email = $request->email;
    //     $user->password = $request->password;

    //     $user->save();

    //     return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}

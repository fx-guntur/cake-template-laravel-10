<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\merchant\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddMerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.layout.daftar-merchant');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.panel.daftar-merchant.pages.daftar-merchant');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:customers|max:255',
            'email' => 'required|string|email|unique:customers|max:255',
            'password' => 'required|string|min:5|confirmed',
        ]);

        // Create a new customer account
        $merchant = new Merchant();
        $merchant->username = $request->username;
        $merchant->email = $request->email;
        $merchant->password = bcrypt($request->password); // Hash the password
        $merchant->save(); // UUID is generated here automatically

        Session::flash('success', 'Registration Successful! You can now log in.');
        return redirect()->route('admin.add-merchant.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic to display a specific merchant
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logic to show edit form for a specific merchant
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic to update a specific merchant
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic to remove a specific merchant
    }
}
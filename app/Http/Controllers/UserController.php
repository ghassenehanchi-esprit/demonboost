<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function ban(User $user)
    {
        $user->is_banned = true;
        $user->save();

        return redirect()->back()->with('success', 'User has been banned successfully.');
    }

    public function unban(User $user)
    {
        $user->is_banned = false;
        $user->save();

        return redirect()->back()->with('success', 'User has been unbanned successfully.');
    }
    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('success', 'Account settings updated successfully.');
    }

    public function updateSecurity(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
        ]);

        // Verify the current password
        if (!Hash::check($request->input('currentPassword'), $user->password)) {
            return redirect()->back()->with('error', 'Invalid current password.');
        }

        // Update the password
        $user->password = Hash::make($request->input('newPassword'));
        $user->save();

        return redirect()->back()->with('success', 'Security settings updated successfully.');
    }
}

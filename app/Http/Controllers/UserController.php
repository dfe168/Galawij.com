<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show()
    {
        $user = Auth::getUser();
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $userId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:4|confirmed',
        ]);

        $user = User::findOrFail($userId);



        // Check and update password if provided
        if (!empty($request->current_password)) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'password' => 'Current password inccorect.',
                ])->onlyInput('current_password');
            }

            $user->password = Hash::make($request->password);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return back()->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

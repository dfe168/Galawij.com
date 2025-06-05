<?php

namespace App\Http\Controllers;

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::getUser();
        return Inertia::render('Dashboard/User', ['userInfo' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, int $userId)
    {
        $request->validated();

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
}

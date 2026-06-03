<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . Auth::id(),
            'address' => 'nullable|string|max:255',
            'gender'  => 'nullable|in:Male,Female,Other',
            'avatar'  => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->address = $request->address;
        $user->gender  = $request->gender;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

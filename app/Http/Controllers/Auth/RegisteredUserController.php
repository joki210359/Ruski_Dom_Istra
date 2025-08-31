<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'familyname' => 'nullable|string|max:255',
            'interested' => 'nullable|string|max:255',
            'username'   => 'required|string|max:255|unique:users,username',
            'email'      => 'required|email|max:255|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'gender'     => 'nullable|string',
            'bio'        => 'nullable|string',
            'website'    => 'nullable|url',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png,webp,jfif,gif,|max:1024',
            'location'   => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'remember'   => 'nullable|boolean',
        ]);

        $avatarPath = $request->hasFile('avatar') && $request->file('avatar')->isValid()
            ? $request->file('avatar')->store('avatars', 'public')
            : null;

        $user = User::create([
            'name'       => $validated['name'],
            'familyname' => $validated['familyname'] ?? null,
            'interested' =>$validated[ 'interested']?? null,
            'username'   => $validated['username'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'phone'      => $validated['phone'] ?? null,
            'gender'     => $validated['gender'] ?? null,
            'bio'        => $validated['bio'] ?? null,
            'website'    => $validated['website'] ?? null,
            'avatar' => $request->hasFile('avatar') ? $request->file('avatar')->store('avatars', 'public') : null,
            'location'   => $validated['location'] ?? null,
        ]);

        event(new Registered($user));
        Auth::login($user, true);

        return redirect(RouteServiceProvider::HOME);
    }
}

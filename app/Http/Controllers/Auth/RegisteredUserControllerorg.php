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
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserControllerorg extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */


    public function store(Request $request): RedirectResponse
    {




        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'familyname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'website' => ['nullable', 'url'],
            ]);

            // dd($request->username); // Ova linija će zaustaviti izvršavanje i ispisati vrijednost
            dd($request->all()); // Ovo će ispisati sve podatke iz forme i zaustaviti kod

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => $request->hasFile('avatar') ? $request->file('avatar')->store('avatars', 'public') : null,
                'username' => $request->username,
                'phone' => $request->phone,
                'familyname' => $request->familyname,
                'gender' => $request->gender,
                'bio' => $request->bio,
                'website' => $request->website,
            ];

            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->hasFile('avatar') ? $request->file('avatar')->store('avatars', 'public') : null,
            'username' => $request->username,
            'phone' => $request->phone,
            'familyname' => $request->familyname,
            'gender' => $request->gender,
            'bio' => $request->bio,
            'website' => $request->website,
            ]);

        event(new Registered($user));

        // Auth::login($user);
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

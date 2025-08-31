<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Prikaz forme za uređivanje profila.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Prikaz profila korisnika po ID-u.
     */



    public function show($username)
    {
        // Dohvati korisnika s brojem postova, followers i following
        $user = User::withCount(['posts', 'followers', 'following'])
            ->where('username', $username)
            ->firstOrFail();

        // Izračun broja pratitelja i pratnji direktno
        $user->posts_count = $user->posts->count();
        $user->followers_count = $user->followers->count();
        $user->following_count = $user->following->count();

        return view('profile.show', compact('user'));
    }

    /**
     * Alternativna forma za uređivanje profila.
     */
    public function urediprofil(Request $request): View
    {
        return view('profile.urediprofil', ['user' => $request->user()]);
    }

    /**
     * Ažuriranje profilne slike.
     */
    public function updatePicture(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif|max:2048',
        ]);

        $user = Auth::user();

        if (!$user instanceof User) {
            abort(500, 'Authenticated user is not valid.');
        }

        // Obriši prethodni avatar ako postoji
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Generiši random ime s originalnom ekstenzijom
        $filename = 'avatars/' . Str::random(40) . '.' . $request->file('avatar')->getClientOriginalExtension();

        // Snimi avatar
        $request->file('avatar')->storeAs('public', $filename);

        // Snimi putanju u bazu (npr. avatars/abc.jpg)
        $user->avatar = $filename;
        $user->save();

        return back()->with('status', 'Profilna slika je uspješno ažurirana.');
    }

    /**
     * Ažuriranje korisničkih podataka.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'username'   => ['required', 'string', 'max:255'],
            'familyname' => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255'],
            'remember'   => ['nullable', 'boolean'],
            'role'       => ['required', 'string', 'max:255'],
            'location'   => ['required', 'string', 'max:255'],
            'phone'      => ['required', 'string', 'max:20'],
            'gender'     => ['required', Rule::in(['male', 'female', 'other'])],
            'bio'        => ['nullable', 'string', 'max:1000'],
            'website'    => ['nullable', 'url', 'max:255'],
        ]);

        $user = $request->user();

        $validated['remember_token'] = $request->boolean('remember') ? Str::random(60) : null;

        $user->update($validated);

        return back()->with('status', 'Profil je uspješno ažuriran.');
    }

    /**
     * Brisanje korisničkog računa.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return Redirect::to('/');
// Provjerite stanje sesije

        // Preusmjerite korisnika na stranicu 'choicelanguage'
        return redirect()->route('choicelanguage.page'); // Dodano preusmjeravanje

    }

}

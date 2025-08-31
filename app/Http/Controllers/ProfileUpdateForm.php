<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfileUpdateForm extends Component
{
use WithFileUploads;

public string $interested = '';
public string $location = '';
public string $phone = '';
public string $gender = '';
public ?string $bio = null;
public ?string $website = null;
public bool $remember = false;
public $avatar; // fajl ili null

public function mount()
{
$user = auth()->user();

if (!$user instanceof User) {
throw new Exception('Authenticated user is not an instance of User model.');
}

$this->interested = $user->interested ?? '';
$this->location   = $user->location ?? '';
$this->phone      = $user->phone ?? '';
$this->gender     = $user->gender ?? '';
$this->bio        = $user->bio ?? '';
$this->website    = $user->website ?? '';
$this->remember   = !empty($user->remember_token);
$this->avatar     = null;
}

public function updateProfile()
{
$this->validate();

$user = auth()->user();

if (!$user instanceof User) {
throw new Exception('Authenticated user is not an instance of User model.');
}

// Ažuriranje polja
$user->fill([
'interested'      => $this->interested,
'location'        => $this->location,
'phone'           => $this->phone,
'gender'          => $this->gender,
'bio'             => $this->bio,
'website'         => $this->website,
'remember_token'  => $this->remember ? Str::random(60) : null,
]);

// Avatar upload sa unikatnim imenom i ispravnim putem
if ($this->avatar instanceof UploadedFile) {
// Obriši stari avatar ako postoji
if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
Storage::disk('public')->delete($user->avatar);
}

$randomName = Str::random(40) . '.' . $this->avatar->getClientOriginalExtension();
$avatarPath = $this->avatar->storeAs('avatars', $randomName, 'public');

$user->avatar = $avatarPath; // avatars/xxx.jpg
}

$user->save();

session()->flash('status', 'profile-updated');
}

public function rules()
{
return [
'interested' => 'required|string|max:255',
'location'   => 'required|string|max:255',
'phone'      => 'required|string|max:20',
'gender'     => ['required', Rule::in(['male', 'female', 'other'])],
'bio'        => 'nullable|string|max:500',
'website'    => 'nullable|url|max:255',
'remember'   => 'nullable|boolean',
'avatar'     => 'nullable|image|mimes:jpg,jpeg,png,webp,jfif,gif|max:2048',
];
}
}

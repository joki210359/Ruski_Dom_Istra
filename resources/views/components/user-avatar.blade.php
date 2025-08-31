<div>
    <img
        src="{{ $user && $user->avatar ? asset('storage/avatars/' . basename($user->avatar)) : asset('storage/avatars/default.png') }}"
        alt="{{ $user->name ?? 'Unknown' }}"
        class="w-{{ $size }} h-{{ $size }} rounded-full"
    />
</div>

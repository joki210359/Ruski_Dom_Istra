<section>
    <header>
        {{-- <h2 class="text-lg font-medium text-gray-900"> 
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p> --}}

        <h2 class="font-extrabold text-red-900 mt-1 mb-1 mr-1 ml-9" style="font-size: 2.25rem;">
            {{ __('Account Information') }}
        </h2>
        <p class="mt-1 text-sm text-blue-600 mb-1 mr-1 ml-9">
            {{ __("Update your account's email address and delete account.") }}
        </p>



    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="relative">
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input id="current_password" name="current_password" type="password"
                class="mt-1 block w-full pr-10" autocomplete="current-password" />

            <button type="button" onclick="togglePassword('current_password')"
                class="absolute right-3 text-sm text-gray-500"
                style="top: 65%; transform: translateY(-50%);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-4.477 7-10 7S2 15.866 2 12s4.477-7 10-7 10 3.134 10 7z" />
                </svg>
            </button>


            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                if (input.type === "password") {
                    input.type = "text";
                } else {
                    input.type = "password";
                }
            }
        </script>


        <div class="relative">
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password"
                class="mt-1 block w-full pr-10" autocomplete="new-password" />

            <button type="button" onclick="togglePassword('password')"
                class="absolute right-3 text-sm text-gray-500"
                style="top: 65%; transform: translateY(-50%);">
                <!-- 👁️ -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-4.477 7-10 7S2 15.866 2 12s4.477-7 10-7 10 3.134 10 7z" />
                </svg>
            </button>

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                if (input) {
                    input.type = input.type === "password" ? "text" : "password";
                }
            }
        </script>


        <div class="relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full pr-10" autocomplete="new-password" />

            <button type="button" onclick="togglePassword('password_confirmation')"
                class="absolute right-3 text-sm text-gray-500"
                style="top: 65%; transform: translateY(-50%);">
                <!-- 👁️ -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-4.477 7-10 7S2 15.866 2 12s4.477-7 10-7 10 3.134 10 7z" />
                </svg>
            </button>

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                if (input) {
                    input.type = input.type === "password" ? "text" : "password";
                }
            }
        </script>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
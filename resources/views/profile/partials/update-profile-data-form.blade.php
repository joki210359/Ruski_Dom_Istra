<section>
    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your profile data information.") }}
        </p>
    </header> -->

    <!-- Verifikacija -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="hidden">
        @csrf
    </form>

    <!-- Glavna forma za ažuriranje profila -->
    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <!-- Intersted -->
        <div>
            <x-input-label for="interested" :value="__('Interested')" />
            <x-text-input id="intersted" class="block mt-1 w-full text-xs" type="text" name="intersted"
                :value="intersted('intersted') ?? auth()->user()->intersted" required
                autocomplete="intersted" placeholder="Intersted" />
            <x-input-error :messages="$errors->get('intersted')" class="mt-2" />
        </div>

        <!-- Location -->
        <div>
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input id="location" class="block mt-1 w-full text-xs" type="text" name="location"
                :value="old('location') ?? auth()->user()->location" required
                autocomplete="loc" placeholder="Location" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full text-xs" type="text" name="phone"
                :value="old('phone') ?? auth()->user()->phone" required
                autocomplete="tel" placeholder="Phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="block mt-1 w-full text-xs" required>
                <option value="male" {{ (old('gender') ?? auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ (old('gender') ?? auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ (old('gender') ?? auth()->user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-text-input id="bio" class="block mt-1 w-full text-xs" type="text" name="bio"
                :value="old('bio') ?? auth()->user()->bio" placeholder="Bio" />
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <!-- Website -->
        <div>
            <x-input-label for="website" :value="__('Website (optional)')" />
            <x-text-input id="website" class="block mt-1 w-full text-xs" type="url" name="website"
                :value="old('website') ?? auth()->user()->website" placeholder="Website" oninput="updateLink(this.value)" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />

            <!-- Prikaz linka -->
            <a id="websiteLink" href="#" target="_blank"
                class="text-xs text-blue-500 hover:text-blue-700 hidden mt-1">Visit Website</a>
        </div>

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> -->

        <div class="mt-4">
            <label class="inline-flex items-center">
            <input type="hidden" name="remember" value="0">
                <input type="checkbox" name="remember" value="1"
                    {{ old('remember') || request()->user()->remember_token ? 'checked' : '' }}
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">Remember Me</span>
            </label>
        </div>


        <!-- <div class="mt-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="remember"  value="1 class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
        <span class="ml-2 text-sm text-gray-600">Remember Me</span>
    </label>
</div> -->


        <!-- Submit dugme + poruka -->
        <div class="flex items-center gap-4 mt-8">
            <x-primary-button>{{ __('UPDATE') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600">
                {{ __('Saved.') }}
            </p>
            @endif
        </div>
    </form>

    <script>
        function updateLink(url) {
            const linkElement = document.getElementById('websiteLink');
            if (url) {
                linkElement.href = url;
                linkElement.textContent = url;
                linkElement.classList.remove('hidden');
            } else {
                linkElement.classList.add('hidden');
            }
        }

        // Ako postoji početna vrednost za website, odmah prikazati link
        document.addEventListener('DOMContentLoaded', function() {
            const websiteInput = document.getElementById('website');
            if (websiteInput && websiteInput.value) {
                updateLink(websiteInput.value);
            }
        });
    </script>
</section>

<x-guest-layout>


    <div aria-disabled="false" role="button" tabindex="0" style="cursor: pointer;" class=" mb-2 text-center">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="" role="img"
            style="background-image: url('https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png');">
        </i>
    </div>


    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/Ruski dom Istra logo.png') }}" alt="Description of the image" class="img-fluid">
        <!-- <p class="text-center text-secondary p-0 m-0"> Sign up to see photos and videos from your friends.</p> -->
        <p class="text-center text-secondary p-0 m-0">{{ __('register.Sign up to see photos and videos from your friends.') }}
        </p>

    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Profile Image -->
        <div class="mt-3" style="display: flex; align-items: center;">
            <img id="previewImage" class="rounded-full" style="width: 100px; height: 100px; object-fit: cover;
            border: 0.2px solid transparent;
            background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) border-box;
            padding: 5px; margin-left: 20px;margin-bottom: 10px;"
                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png"
                alt="Profilna slika">
            <div style="display: flex; flex-direction: column; margin-left: 150px;">
                <div>
                    <label for="formFileMultiple" class="form-label btn btn-primary rounded-4 align-middle"
                        style="cursor: pointer; margin-left: -20px;">
                        <!-- Place photo -->
                        {{ __('register.place_photo') }}
                    </label>

                    <input class="form-control" type="file" id="formFileMultiple" style="display: none;" name="avatar">
                    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                </div>
            </div>
        </div>

        <script>
            document.getElementById('formFileMultiple').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('previewImage').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
        <!-- Name -->
        <div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" placeholder="{{ __('register.name') }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- familyname -->
        <div class="mt-3">
            <x-text-input id="familyname" class="block mt-1 w-full  text-base" type="text" name="familyname"
                :value="old('familyname')" required autofocus autocomplete="familyname" placeholder="{{ __('register.surname') }}" />
            <x-input-error :messages="$errors->get('familyname')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-3">
            <x-text-input id="username" class="block mt-1 w-full text-base" type="text" name="username"
                :value="old('username')" required autofocus autocomplete="username" placeholder="{{ __('register.username') }}" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-3">
            <x-text-input id="role" class="block mt-1 w-full text-base" type="text" name="role" :value="old('role')"
                required autofocus autocomplete="role" placeholder="{{ __('register.role') }}" />
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-3">
            <x-text-input id="email" class="block mt-1 w-full  text-base" type="email" name="email"
                :value="old('email')" required autocomplete="email" placeholder="{{ __('register.email') }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Location -->
        <div class="mt-3">
            <x-text-input id="location" class="block mt-1 w-full  text-base" type="text" name="location"
                :value="old('location')" required autocomplete="location" placeholder="{{ __('register.location') }}" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-3">
            <x-text-input id="phone" class="block mt-1 w-full  text-base" type="text" name="phone" :value="old('phone')"
                required autocomplete="phone" placeholder="{{ __('register.phone') }}" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-3 relative">
            <x-text-input id="password" class="block mt-1 w-full text-base pr-10" type="password" name="password"
                required autocomplete="password" placeholder="{{ __('register.password') }}" />
            <button type="button" onclick="togglePassword('password')"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">
                <!-- 👁️ -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-4.477 7-10 7S2 15.866 2 12s4.477-7 10-7 10 3.134 10 7z" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-3 relative">
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-base pr-10" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder=" {{ __('register.confirm_password') }} "/>

            <button type="button" onclick="togglePassword('password_confirmation')"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">
                <!-- 👁️ -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-4.477 7-10 7S2 15.866 2 12s4.477-7 10-7 10 3.134 10 7z" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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


        <!-- Gender -->
        <div class="mt-3">
            <!-- <label for="gender" class="text-base">Gender:</label> -->
            <label for="gender" class="text-base">{{ __('register.Gender:') }}</label>
            <!-- <select id="gender" name="gender" class="block mt-1 w-full text-base" required>
                <option value="male" {{ old(
    'gender'
) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old(
    'gender'
) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old(
    'gender'
) == 'other' ? 'selected' : '' }}>Other</option>
            </select> -->
            <select name="gender" id="gender" class="form-select mt-1 block w-full">
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('register.Male') }}</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('register.Female') }}</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('register.Other') }}</option>
            </select>

            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Bio -->
        <div class="mt-3">
            <x-text-input id="bio" class="block mt-1 w-full text-base" type="text" name="bio" :value="old('bio')"
                placeholder="{{ __('register.bio') }}" />
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <!-- Website -->
        <div class="mt-3">
            <!-- Polje za unos URL-a -->
            <x-text-input id="website" class="block mt-1 w-full text-base" type="url" name="website"
                :value="old('website')" placeholder="{{ __('register.website') }}" oninput="updateLink(this.value)" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />

            <!-- Prikaz linka -->
            <!-- <a id="websiteLink" href="#" target="_blank"
                class="text-base text-blue-500 hover:text-blue-700 hidden">Visit Website</a> -->
            <a id="websiteLink" href="#" target="_blank"
                class="text-base text-blue-500 hover:text-blue-700 hidden">{{ __('register.Visit Website') }}</a>

        </div>

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
        </script>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-red-700 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember"
                    value="1">
                <!-- <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span> -->
                 <span class="ml-2 text-sm text-gray-600">{{ __('register.Remember me') }}</span>
            </label>

        </div>



        <div class="flex items-center justify-end mt-3">
            <x-primary-button class="">
                {{ __('register.Register') }}
            </x-primary-button>
        </div>
        
        <div class="mt-3 text-center">
            <a class="text-blue-500 hover:text-blue-700 text-decoration-none" href="{{ route('login') }}">
                <!-- <span class="text-blue-500 hover:text-blue-700 text-decoration-none">Already registered?</span> -->
                 <span class="text-blue-500 hover:text-blue-700 text-decoration-none">{{ __('register.Already registered?') }}
</span>
            </a>
        </div>
    </form>

</x-guest-layout>
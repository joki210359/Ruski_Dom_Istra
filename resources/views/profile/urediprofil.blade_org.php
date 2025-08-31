<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="w-[38rem] p-4 ml-[0rem] sm:p-8">
                <!--                <div class="max-w-xl">-->
                <!--                    @include('profile.partials.update-profile-information-form')-->
                <!--                </div>-->

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                    <!--            <div class="w-[20rem] ml-30 mr-12sm:p-8 bg-white shadow sm:rounded-lg">-->
                    <!--            <div class="w-[38rem] p-4 ml-[0rem] sm:p-8 bg-green-600 shadow sm:rounded-lg">-->

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH') <!-- Ovdje koristi 'PATCH', ne 'PUT' -->

                        <div
                            class="w-[35rem] ml-[-2.3rem] mr-[2rem] mt-[0rem] mb-[0rem] p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                <!-- Profile picture label above the image -->
                                <h5 class="text-xl font-medium text-gray-900 ml-[0rem] mr-[2rem] mt-[-1rem] mb-[-1rem]">
                                    Profile picture
                                </h5>

                                <div style="display: flex; align-items: center;">
                                    <!-- Image with specified margins -->
                                    <img id="previewImage" class="ml-[0rem] mr-[2rem] mt-[2rem] mb-[0rem] rounded-full"
                                        style="width: 100px; height: 100px; object-fit: cover;
                                border: 0.2px solid transparent; background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) border-box;
                                padding: 5px;"
                                        src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                                        alt="Profilna slika">

                                    <!-- Buttons to the right of the image -->
                                    <div style="display: flex; align-items: center; gap: 0rem; margin-left: auto;">
                                        <label for="formFileMultiple"
                                            class="ml-[0rem] mr-[2rem] mt-[2rem] mb-[0rem] form-label btn btn-primary rounded-4"
                                            style="cursor: pointer;">
                                            Change picture
                                        </label>
                                        <input class="form-control" type="file" id="formFileMultiple"
                                            style="display: none;"
                                            name="avatar">
                                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />

                                        <button type="submit"
                                            class="ml-[0rem] mr-[2rem] mt-[2rem] mb-[0rem] btn btn-primary">
                                            Save picture
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        document.getElementById("formFileMultiple").addEventListener("change", function(e) {
                            var reader = new FileReader();
                            reader.onload = function() {
                                document.getElementById("previewImage").src = reader.result;
                            };
                            reader.readAsDataURL(e.target.files[0]);
                        });
                    </script>

                </div>

            </div>
            

            <!--            <div class="w-[20rem] ml-30 mr-12sm:p-8 bg-white shadow sm:rounded-lg">-->
            <div class="w-[38rem] p-4 ml-[0rem] sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xl">
                    <!--                    @include('profile.partials.update-profile-information-form')-->
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profile Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your account's profile information.") }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                        </form>

                        <!-- Phone -->
                        <div class="mt-3">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full  text-xs" type="text" name="phone"
                                :value="old('phone')" required
                                autocomplete="username" placeholder="Phone" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Gender -->
                        <div class="mt-3">
                            <label for="gender" class="text-xs">Gender:</label>
                            <select id="gender" name="gender" class="block mt-1 w-full text-xs" required>
                                <option value="male" {{ old(
                                    'gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old(
                                    'gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old(
                                    'gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <!-- Bio -->
                        <div class="mt-3">
                            <label for="bio" class="text-xs">Bio:</label>
                            <x-text-input id="bio" class="block mt-1 w-full text-xs" type="text" name="bio"
                                :value="old('bio')"
                                placeholder="Bio" />
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>

                        <!-- Website -->
                        <div class="mt-3">
                            <label for="bio" class="text-xs">Bio:</label>
                            <!-- Polje za unos URL-a -->
                            <x-text-input id="website" class="block mt-1 w-full text-xs" type="url" name="website"
                                :value="old('website')"
                                placeholder="Website (optional)" oninput="updateLink(this.value)" />
                            <x-input-error :messages="$errors->get('website')" class="mt-2" />

                            <!-- Prikaz linka -->
                            <a id="websiteLink" href="#" target="_blank"
                                class="text-xs text-blue-500 hover:text-blue-700 hidden">Visit Website</a>
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

                        <!-- Remember Me -->
                        <div class="mt-3">
                            <label for="remember_me" class="flex items-center text-xs">
                                <input id="remember_me" type="checkbox" name="remember" class="mr-2" {{ old('remember')
                                    ? 'checked' : ''
                                    }}>
                                Remember Me
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Pohrani') }}</x-primary-button>
                            @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Saved.') }}
                            </p>
                            @endif
                        </div>
                        </form>
                    </section>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
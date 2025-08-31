<section>

    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your profile picture.") }}
        </p>
    </header> -->

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="familyname" :value="__('Family Name')" />
            <x-text-input id="familyname" name="familyname" type="text"
                class="mt-1 block w-full" :value="old('familyname', $user->familyname)" required autofocus autocomplete="familyname" />
            <x-input-error class="mt-2" :messages="$errors->get('familyname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form> -->

    <form method="POST" action="{{ route('profile.updatePicture') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- <div class="w-[35rem] ml-[-2.3rem] mr-[2rem] mt-[0rem] mb-[0rem] p-4 sm:p-8 bg-white shadow sm:rounded-lg">        </div> -->
        <div class="max-w-xl">
            <h5 class="text-xl font-medium text-gray-900 ml-[0rem] mr-[2rem] mt-[-1rem] mb-[-1rem]">
                Profile picture
            </h5>

            <div style="display: flex; align-items: center;">
                <img id="previewImage" class="ml-[0rem] mr-[1rem] mt-[2rem] mb-[0rem] rounded-full"
                    style="width: 100px; height: 100px; object-fit: cover;
                            border: 0.2px solid transparent; background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) border-box;
                            padding: 5px;"
                    src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                    alt="Profile picture">

                <div style="display: flex; align-items: center; gap: 0rem; margin-left: auto; flex-direction: column;">
                <label type="submit" for="formFileMultiple" class="ml-[-0.5rem] mr-[2rem] mt-[2rem] mb-[0rem] 
                        form-label inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-6 transition ease-in-out duration-150">
                        Change picture
                        </label>
                    <input class="form-control" type="file" id="formFileMultiple" style="display: none;" name="avatar">
                    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />

                    <!-- <button type="submit" class="ml-[-2rem] mr-[0.5rem] mt-[0.5rem] mb-[0rem] btn btn-primary"> -->
                    <button type="submit" class="ml-[-2rem] mr-[0.5rem] mt-[0.5rem] mb-[0rem] inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-6 transition ease-in-out duration-150">

                        Save picture
                    </button>
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


</section>
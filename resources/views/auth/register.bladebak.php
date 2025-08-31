<x-guest-layout>


    <div aria-disabled="false" role="button" tabindex="0" style="cursor: pointer;" class=" mb-2 text-center">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="" role="img"
           style="background-image: url('https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png');">
        </i>
    </div>


    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/Ruski dom Istra logo.png') }}" alt="Description of the image" class="img-fluid">
        <p class="text-center text-secondary p-0 m-0"> Sign up to see photos and videos from your friends.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Profile Image -->
        <div class="mt-3" style="display: flex; align-items: center;">
            <!--            <img id="previewImage" class="rounded-circle"-->
            <!---->
            <!--                 style="width: 100px; height: 100px; object-fit: cover;-->
            <!--                    border: 0.2px solid transparent;-->
            <!--        background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) border-box;-->
            <!--        padding: 5px; margin-left: 20px;"-->
            <!---->
            <!--                 src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png"-->
            <!--                 alt="Profilna slika">-->
            <img id="previewImage" class="rounded-full"
                 style="width: 100px; height: 100px; object-fit: cover;
            border: 0.2px solid transparent;
            background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) border-box;
            padding: 5px; margin-left: 20px;"
                 src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png"
                 alt="Profilna slika">
            <div style="display: flex; flex-direction: column; margin-left: 150px;"> <!-- Dodat margin-left: 50px -->
                <label for="avatar" style="margin-bottom: 10px;">Slika Profila:</label>

                <div>
                    <label for="formFileMultiple" class="form-label btn btn-primary rounded-4 align-middle"
                           style="cursor: pointer;">
                        Postavi sliku
                    </label>
                    <input class="form-control" type="file" id="formFileMultiple" style="display: none;"
                           name="avatar">
                    <x-input-error :messages="$errors->get('avatar')" class="mt-2"/>
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
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Family Name -->
        <div class="mt-3">
            <x-text-input id="familyname" class="block mt-1 w-full  text-xs" type="text" name="familyname" :value="old('familyname')"
                          required autofocus autocomplete="familyname" placeholder="familyname"/>
            <x-input-error :messages="$errors->get('familyname')" class="mt-2"/>
        </div>

        <!-- Username -->
        <div class="mt-3">
            <x-text-input id="username" class="block mt-1 w-full text-xs" type="text" name="username" :value="old('username')"
                          required autofocus autocomplete="username" placeholder="Korisničko ime"/>
            <x-input-error :messages="$errors->get('username')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-3">
            <x-text-input id="email" class="block mt-1 w-full  text-xs" type="email" name="email" :value="old('email')" required
                          autocomplete="username" placeholder="Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Phone -->
        <div class="mt-3">
            <x-text-input id="phone" class="block mt-1 w-full  text-xs" type="text" name="phone" :value="old('phone')" required
                          autocomplete="username" placeholder="Phone"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-3">
            <x-text-input id="password" class="block mt-1 w-full text-xs" type="password" name="password" required
                          autocomplete="new-password" placeholder="Password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-3">
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-xs" type="password"
                          name="password_confirmation" required autocomplete="new-password"
                          placeholder="Confirm Password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <!-- Gender -->
        <div class="mt-3">
            <!--            <label for="gender">Gender:</label>-->
            <label for="gender" class="text-xs">Gender:</label>
            <select id="gender" name="gender" class="block mt-1 w-full text-xs" required>
                <option value="male" {{ old(
                'gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old(
                'gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old(
                'gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2"/>
        </div>

        <!-- Bio -->
        <div class="mt-3">
            <x-text-input id="bio" class="block mt-1 w-full text-xs" type="text" name="bio" :value="old('bio')"
                          placeholder="Bio"/>
            <x-input-error :messages="$errors->get('bio')" class="mt-2"/>
        </div>

        <!-- Website -->
        <div class="mt-3">
            <!-- Polje za unos URL-a -->
            <x-text-input id="website" class="block mt-1 w-full text-xs" type="url" name="website" :value="old('website')"
                          placeholder="Website (optional)" oninput="updateLink(this.value)"/>
            <x-input-error :messages="$errors->get('website')" class="mt-2"/>

            <!-- Prikaz linka -->
            <a id="websiteLink" href="#" target="_blank" class="text-xs text-blue-500 hover:text-blue-700 hidden">Visit Website</a>
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
                <input id="remember_me" type="checkbox" name="remember" class="mr-2" {{ old('remember') ? 'checked' : ''
                }}>
                Remember Me
            </label>
        </div>

        <div class="flex items-center justify-end mt-3">
            <x-primary-button class="">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- <div class="mt-3 text-center">
            <a class=" text-muted text-decoration-none" href="{{ route('login') }}">
                <span class="text-primary ">Already registered?</span>
            </a>
        </div> -->
    </form>

</x-guest-layout>

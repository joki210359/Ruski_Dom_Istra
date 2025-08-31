<x-app-layout>

    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> -->

    <header>
    
            <h2 class="font-extrabold text-red-900 mt-1 mb-1 mr-1 ml-9" style="font-size: 2.25rem;">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-blue-600 mb-1 mr-1 ml-9">
            {{ __("Update your account's profile information.") }}
            </p>

    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column: Profile Picture & Profile Information -->
                <div class="space-y-6">
                    <!-- Profile Picture -->
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-picture-form')
                        </div>
                    </div>
                    <!-- Profile Information -->
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
                {{--  <!-- Right Column: Password & Delete User --> 
                <div class="space-y-6">
                    <!-- Password -->
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                    <!-- Delete User -->
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

</x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Icons -->
    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    --}}
    <link rel="icon" href="{{ asset('assets/RDI.png') }}" type="image/png">




    {{-- <link rel="icon" type="image/svg+xml" href="{{ asset('images/laravel-icon.svg') }}">
    --}}
    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content items-center justify-center">
            <!-- Page content here -->
            <!-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label> -->
            {{$slot}}
        </div>
        <!-- <div class="drawer-side overflow-visible z-10"> -->
        <div class="drawer-side overflow-visible z-10 w-[30rem] !w-[30rem]">


            <label for="my-drawer-2" class="drawer-overlay"></label>

            {{-- @include('layouts.sidebar') --}}
            <livewire:components.sidebar />

        </div>
    </div>

    @livewire('wire-elements-modal')

</body>

</html>
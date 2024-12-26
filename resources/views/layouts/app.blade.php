<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon for modern browsers (SVG) -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('RDI.svg') }}">

    <!-- Fallback PNG Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('RDI.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('RDI.png') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('RDI.png') }}">

    <!-- Favicon for legacy browsers -->
    <link rel="icon" href="{{ asset('RDI.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('RDI.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', config('Ruski_Dom_Istra', 'RD Istra-Добро пожаловать'))</title>
</head>

<body class="font-sans antialiased">

<div class="drawer lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col items-center justify-center">
        <!-- Page content here -->
        <!--  <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Otvori menu</label>
  -->        {{$slot}}
    </div>
    <div class="drawer-side">
        <label for="my-drawer-2" class="drawer-overlay"></label>

        @include('layouts.sidebar')

    </div>
</div>
<div>
    @yield('content')
</div>

</body>
</html>

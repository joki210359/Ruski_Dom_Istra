<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="icon" href="{!! asset('assets/RDP.svg') !!}"/> -->
    <!-- <link rel="icon" href="{{ asset('favicon.ico') }}?v=M44lzPylqQ" type="image/x-icon"/> -->
    <!-- <link rel="icon" href="/images/favicon.ico?v=M44lzPylqQ"> -->

    <!-- <link rel="preload" as="image" href="{!! asset('assets/RDP.svg') !!}"/> -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="./favicon_16x16.png"> -->

    <!-- <link rel="icon" type="image/svg+xml" href="{{ asset('assets/RDP.svg') }}" /> -->


<!-- Favicon for modern browsers and browsers supporting SVG -->
<link rel="icon" type="image/svg+xml" href="{{ asset('RDI.svg') }}">

<!-- PNG Favicon for older browsers (Chrome, Firefox, etc.) -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('RDI.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('RDI.png') }}">

<!-- Apple Touch Icon for Safari -->
<link rel="apple-touch-icon" href="{{ asset('RDI.png') }}">

<!-- Favicon for legacy browsers (Internet Explorer, etc.) -->
<link rel="icon" href="{{ asset('RDI.ico') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('RDI.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>


    <title>@yield('title', config('Ruski_Dom_Istra', 'RD Istra-Добро пожаловать'))</title>
    <!--<title>Ruski Dom Pula</title>
    <title>@yield('Ruski Dom Pula', config('app.name', 'Ruski Dom Pula'))</title>-->




    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        [x-cloak]{
            display: none !important;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{!! asset('assets/RDP.svg') !!}"/>
    <title>@yield('title', config('Ruski_Dom_Pula', 'RD Istra-Добро пожаловать'))</title>
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

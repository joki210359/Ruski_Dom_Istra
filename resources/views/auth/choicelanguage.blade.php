<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('Ruski_Dom_Istra', 'RD Istra-Добро пожаловать'))</title>

    <!-- Favicon for modern browsers -->
    <link rel="icon" href="{{ asset('assets/RDI.png') }}" type="image/png">

    <!-- PNG Favicon for older browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/RDI.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/RDI.png') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/RDI.svg') }}">

    <!-- Favicon for legacy browsers -->
    <link rel="icon" href="{{ asset('assets/RDI.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/RDI.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* TailwindCSS styles (simplified for example) */
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
        }

        .bg-gray-100 {
            background-color: #f7fafc;
        }

        .dark\:bg-black {
            background-color: #000;
        }

        .dark\:text-white\/50 {
            color: rgba(255, 255, 255, 0.5);
        }

        .text-center {
            text-align: center;
        }

        .text-2xl {
            font-size: 1.5rem;
            line-height: 2rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .bg-green-500 {
            background-color: #10b981;
        }

        .bg-red-500 {
            background-color: #ef4444;
        }

        .text-white {
            color: #fff;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .px-4,
        .py-2 {
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .absolute {
            position: absolute;
        }

        .top-4 {
            top: 1rem;
        }

        .right-4 {
            right: 1rem;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .flex {
            display: flex;
        }

        .justify-center {
            justify-content: center;
        }

        .items-center {
            align-items: center;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: inherit;
            color: #1004f5ff;
        }

        p {
            font-size: 0.875remrem;
            font-weight: inherit;
              color: #c88731;
        }


        a {
            font-size: 1rem;
            color: inherit;
            text-decoration: inherit;
        }

        h3 {
            font-size: 1.5rem;
            font-weight: inherit;
            color: #1004f5ff;
        }

        .flex {
            display: flex;
            justify-content: center;
        }

        .min-h-screen {
            min-height: 56vh;
        }

        /* Pozadinska slika */
        #background {
            position: absolute;
            left: 0;
            top: 0;
            /* max-width: 1877px; */
            max-width: 2900px;
            /* height: 1300px; */
            height: 600px;
            pointer-events: none;
            /* Omogućava interakciju sa dugmadi */
            z-index: -1;
            /* Postavlja sliku iza ostalih elemenata */
        }

        /* Glavni sadržaj */
        .content {
            position: relative;
            z-index: 10;
            /* Osigurava da se sadržaj pojavljuje iznad pozadinske slike */
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-white dark:text-white/50 min-h-screen">

    <!-- Pozadinska slika -->
    <img id="background" class="absolute -left-0 top-0 max-w-[877px] h-[300px] pointer-events-none"
        src="{{ asset('assets/language.svg') }}" />

            <div class="flex justify-content: center">
        <img src="{{ asset('assets/Ruski dom Istra logo.png') }}" class="ml-[5rem] rounded-md px-4 py-4"
            width="530px" alt="Ruski dom Istra logo.png">
    </div>

    <!-- Glavni sadržaj -->
    <div class="flex items-center justify-center min-h-screen content">
        <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <div class="text-left p-6">
                <h3>
                    Welcome to RD Istra
                    <br>
                    <a href="{{ route('set.language', ['lang' => 'en']) }}"
                        class="px-4 py-1 bg-blue-500 text-white rounded-lg">
                        🇺🇸 Choose your language
                    </a> <br>
                    <br>
                    Dobro došli u RD Istra <!-- Hrvatski -->
                    <br>
                    <a href="{{ route('set.language', ['lang' => 'hr']) }}"
                        class="px-4 py-1 bg-green-500 text-white rounded-lg">
                        🇭🇷 Izaberiti svoj jezik
                    </a> <br>
                    <!-- Izaberiti svoj jezik -->
                    <br>
                    <br>
                    Добро пожаловать <!-- Ruski -->
                    <br>
                    <a href="{{ route('set.language', ['lang' => 'ru']) }}"
                        class="px-4 py-1 bg-red-500 text-white rounded-lg">
                        🇷🇺 Выберите свой язык
                    </a> <br>
                    <!-- Выберите свой язык  -->
                    <br>
                </h3>
            </div>
        </div>
    </div>

    @livewireScripts

    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        <section class="bg-red-100 p-0 m-1">
            <div class="flex items-center justify-center">
                <p class="text-gray-800/90 mt-4 text-sm text-center">

                    <!-- Русский Дом "Истрия" &#169; 2024 All rights reserved<br>
                                Designed by Dusan Jovanovic -->
                    {{ __('welcome.footer.copyright') }}<br>
                    {{ __('welcome.footer.designed_by') }}

                </p>
            </div>
        </section>
    </footer>
</body>

</html>
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    safelist: [
        // već postojeći
        'sm:max-w-sm', 'sm:max-w-md',
        'md:max-w-lg', 'md:max-w-xl',
        'lg:max-w-2xl', 'lg:max-w-3xl',
        'xl:max-w-4xl', 'xl:max-w-5xl',
        '2xl:max-w-6xl', '2xl:max-w-7xl',

        // 🎨 boje za share gumbe
        'bg-sky-500', 'hover:bg-sky-600',
        'bg-purple-600', 'hover:bg-purple-700',
        'bg-blue-600', 'hover:bg-blue-700',
        'bg-blue-800', 'hover:bg-blue-900',
        'bg-green-500', 'hover:bg-green-600',
        'bg-red-500', 'hover:bg-red-600',
        'bg-gray-300', 'hover:bg-gray-400',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                iphone15: '430px',
            },
        },
    },

    daisyui: {
        themes: ['light'],
    },

    plugins: [
        forms,
        require('daisyui'),
        require('tailwind-scrollbar-hide'),
    ],
};

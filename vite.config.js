import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import livewire from '@defstudio/vite-livewire-plugin';
export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '192.168.1.118', // tvoja IP
        },
    },

//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js',
//             ],
//             refresh: false,
//         }),
//
//         livewire({
//             refresh: ['resources/css/app.css'],
//         }),
//     ],
// });


    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: false,
        }),

        livewire({  // Here we add it to the plugins
            refresh: ['resources/css/app.css'],
        }),

    ],
});

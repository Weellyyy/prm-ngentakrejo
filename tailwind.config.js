import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
            'hijau-tua': '#163C31',
            'emas': '#D8AE52',
            'emas-tua': '#97721F',
            'krem': '#FAF7EE',
            'krem-gelap': '#F1ECDD',
            'tinta': '#1E2B25',
            'tinta-lembut': '#61705F',
            'garis': '#E1D9C4',
            'merah': '#B24C3A',
            },
            fontFamily: {
            display: ['Fraunces', 'serif'],
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            mono: ['"IBM Plex Mono"', 'monospace'],
            },
        }
    },
    plugins: [forms],
};

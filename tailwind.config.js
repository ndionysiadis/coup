import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                heading : ['Tinos', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: {
                    '50': '#f8f6f4',
                    '100': '#f0ece4',
                    '200': '#dfd8c9',
                    '300': '#cbbda6',
                    '400': '#baa589',
                    '500': '#a68969',
                    '600': '#99785d',
                    '700': '#80634e',
                    '800': '#695243',
                    '900': '#554339',
                    '950': '#2d221d',
                    DEFAULT: '#baa589'
                },
            }
        },
    },

    plugins: [
        forms,
        require('tailwind-scrollbar'),
    ],
};

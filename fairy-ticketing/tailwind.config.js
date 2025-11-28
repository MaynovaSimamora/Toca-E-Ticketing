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
            fontFamily: {
                sans: ['Fredoka', ...defaultTheme.fontFamily.sans],
                cute: ['Fredoka', 'Quicksand', 'sans-serif'],
                comic: ['Comic Neue', 'cursive'],
            },
            colors: {
                toca: {
                    pink: '#FF6B9D',
                    purple: '#C77DFF',
                    blue: '#4CC9F0',
                    yellow: '#FFD60A',
                    orange: '#FF9F1C',
                    green: '#7AE582',
                    peach: '#FFB5A7',
                    lavender: '#E0AAFF',
                    mint: '#CDEAC0',
                    coral: '#FF6B9D',
                    sky: '#B8E0F6',
                    cream: '#FFF5E1',
                    warmYellow: '#FFE4A0',
                    warmOrange: '#FFB366',
                },
            },
            borderRadius: {
                'toca': '20px',
                'toca-xl': '30px',
                'blob': '60% 40% 70% 30% / 40% 60% 30% 70%',
            },
            boxShadow: {
                'toca': '8px 8px 0px 0px rgba(0, 0, 0, 0.3)',
                'toca-lg': '12px 12px 0px 0px rgba(0, 0, 0, 0.3)',
                'toca-sm': '4px 4px 0px 0px rgba(0, 0, 0, 0.2)',
            },
        },
    },

    plugins: [forms],
};

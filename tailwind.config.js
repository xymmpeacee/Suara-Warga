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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#1B3FE4',
                    50: '#EEF0FD',
                    100: '#D4DAFC',
                    200: '#A9B5F8',
                    300: '#7E90F5',
                    400: '#536BF1',
                    500: '#1B3FE4',
                    600: '#1632B6',
                    700: '#102689',
                    800: '#0B195B',
                    900: '#050D2E',
                },
                accent: {
                    DEFAULT: '#FFD600',
                    50: '#FFF9E0',
                    100: '#FFF3C2',
                    200: '#FFE885',
                    300: '#FFDC47',
                    400: '#FFD600',
                    500: '#C2A300',
                    600: '#857000',
                },
            },
            animation: {
                'fade-in': 'fadeIn 0.6s ease-out forwards',
                'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                'slide-in-left': 'slideInLeft 0.6s ease-out forwards',
                'slide-in-right': 'slideInRight 0.6s ease-out forwards',
                'pulse-dot': 'pulseDot 2s ease-in-out infinite',
                'count-up': 'countUp 0.4s ease-out forwards',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(24px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInLeft: {
                    '0%': { opacity: '0', transform: 'translateX(-32px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                slideInRight: {
                    '0%': { opacity: '0', transform: 'translateX(32px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                pulseDot: {
                    '0%, 100%': { opacity: '1', transform: 'scale(1)' },
                    '50%': { opacity: '0.5', transform: 'scale(1.5)' },
                },
            },
        },
    },

    plugins: [forms],
};

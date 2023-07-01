import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist:[
        'bg-pink-100','bg-yellow-100','bg-yellow-200','bg-blue-100','bg-green-100',
        'border-pink-400','border-yellow-400','border-blue-400','border-green-400',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    '50': '#eef2ff',
                    '100': '#e0e7ff',
                    '200': '#c7d2fe',
                    '300': '#a5b4fc',
                    '400': '#818cf8',
                    '500': '#6366f1',
                    '600': '#4f46e5',
                    '700': '#4338ca',
                    '800': '#3730a3',
                    '900': '#312e81',
                },
                secondary: {
                    50: '#f9fafb',
                    100: '#f3f4f6',
                    200: '#e5e7eb',
                    300: '#d1d5db',
                    400: '#9ca3af',
                    500: '#6b7280',
                    600: '#4b5563',
                    700: '#374151',
                    800: '#1f2937',
                    900: '#111827'
                },
                tertiary: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                },
                quaternary: {
                    50: '#bcd1d9',
                    100: '#161b22',
                    200: '#0d1117',
                    300: '#010409',
                },
                neutral: {
                    'white': '#FFFFFF',
                    'black': '#000000'
                }
            },

            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                sora: ['Sora', ...defaultTheme.fontFamily.sans]
            },
            maxWidth: {
                '2xs': '10rem',
                '8xl': '88rem',
                '9xl': '96rem'
            },
            inset: {
                '-2': '-0.5rem'
            },
            width: {
                'max-content': 'max-content'
            },
            boxShadow: {
                '3xl': '0 35px 60px -15px rgba(0, 0, 0, 0.3)',
            }
        },
    },

    plugins: [forms],
};

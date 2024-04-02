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
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                serif: ['Esteban', ...defaultTheme.fontFamily.serif],
            },
            animation: {
                'hi-there': 'hi-there 1s ease infinite',
                'bounce-custom': 'bounce-custom 2s ease infinite',
            },
            keyframes: {
                'bounce-custom': {
                    "0%, 20%, 50%, 80%, 100%": { transform: "translateY(0)" },
                    "40%": { transform: "translateY(-15px)" },
                    "60%": { transform: "translateY(-7.5px)" }
                },
                'hi-there': {
                    "30%": { transform: "scale(1.2)" },
                    "40%, 60%": { transform: "rotate(-20deg) scale(1.2)" },
                    "50%": { transform: "rotate(20deg) scale(1.2)" },
                    "70%": { transform: "rotate(0deg) scale(1.2)" },
                    "100%": { transform: "scale(1)" }
                }
            },
        },

        plugins: [forms],
    }
};

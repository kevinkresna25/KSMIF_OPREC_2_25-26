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
                // RetroTerm ByPass/Pixo Theme - Updated
                'bg-main': '#1a0f30',          // Deep purple background
                'bg-navbar': '#343a40',        // Dark gray navbar
                'bg-card': '#2b1b4a',          // Purple card background
                'text-default': '#E0E0E0',     // Light gray text
                'text-glow': '#00f6ff',        // Cyan glow for pixel text
                'btn-info': '#5b7290',         // Blue-gray for info buttons
                'btn-solved': '#37d63e',       // Green for solved challenges
                'btn-submit': '#007bff',       // Bright blue
                'btn-danger': '#dc3545',       // Red
                'btn-success': '#28a745',      // Green
                'input-focus': '#a3d39c',      // Green glow for inputs
                'input-invalid': '#d46767',    // Red for invalid
                'border-default': '#545454',   // Gray border
            },
            fontFamily: {
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
                'pixel': ['"Press Start 2P"', 'cursive'],
                'raleway': ['Raleway', 'sans-serif'],
                'lato': ['Lato', 'sans-serif'],
            },
            animation: {
                'flicker': 'flicker 0.15s infinite',
                'scanline': 'scanline 8s linear infinite',
                'glow': 'glow 2s ease-in-out infinite alternate',
            },
            keyframes: {
                flicker: {
                    '0%, 100%': { opacity: '1' },
                    '41.99%': { opacity: '1' },
                    '42%': { opacity: '0.98' },
                    '43%': { opacity: '0.98' },
                    '43.01%': { opacity: '1' },
                    '47.99%': { opacity: '1' },
                    '48%': { opacity: '0.98' },
                    '49%': { opacity: '0.98' },
                    '49.01%': { opacity: '1' },
                },
                scanline: {
                    '0%': { transform: 'translateY(0)' },
                    '100%': { transform: 'translateY(100vh)' },
                },
                glow: {
                    '0%': { textShadow: '0 0 5px #00ff41, 0 0 10px #00ff41' },
                    '100%': { textShadow: '0 0 10px #00ff41, 0 0 20px #00ff41, 0 0 30px #00ff41' },
                },
            },
        },
    },

    plugins: [forms],
};

import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // Giữ nguyên chế độ class
    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // Thêm font heading cho các tiêu đề lớn
                heading: ['Playfair Display', 'serif'], 
            },
            colors: {
                // 1. Ghi đè màu gray mặc định bằng màu Zinc (Đen sâu, sang trọng)
                gray: colors.zinc,
                
                // 2. Định nghĩa màu 'gold' (dùng thay cho yellow để sang hơn)
                yellow: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b', // Màu vàng chính (Gold)
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                    950: '#451a03',
                },
                
                // 3. Màu nền tối đặc biệt (Deep Dark) cho body
                dark: {
                    900: '#121212', // Đen lì (Matte Black)
                    950: '#050505', // Đen sâu thẳm
                }
            },
        },
    },

    plugins: [forms],
};
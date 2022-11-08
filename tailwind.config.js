const defaultTheme = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [ 'Montserrat' , ...defaultTheme.fontFamily.sans],
            },
            colors: {
             darkText:{
                100:"#49607e",
                200:"#1d3a5f"
             }
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'),require('flowbite/plugin')],
};

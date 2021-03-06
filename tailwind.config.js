const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                main: colors.indigo,
                gray: colors.blueGray,
                red: colors.red,
            },
            typography: {
                '3xl': {
                    css: {
                        fontSize: '3.9rem',
                    }
                }
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            textColor: ['group-focus'],
            textAlign: ['even']
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};

/** @type {import('tailwindcss').Config} */
module.exports = {
    experimental: {
        optimizeUniversalDefaults: true,
    },
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    daisyui: {
        themes: ["light"],
    },
    plugins: [require("daisyui")],
};

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // tailwind.config.js
        (module.exports = {
            // Other Tailwind CSS configuration...
            content: [
                "./index.html",
                "./src/**/*.{vue,js,ts,jsx,tsx}",
                "./src/*.{vue,js}",
            ],
        }),
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};

/** @type {import('tailwindcss').Config} */
module.exports={
    content: [
      './index.html',
      "./src/**/*.{vue,js,ts,jsx,tsx}",
      "./src/*.{vue,js}"
    ],
    theme: {
      extend: {},
    },
    plugins: [
      require('@tailwindcss/forms'),
    ],
};


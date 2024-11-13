/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php"],
  theme: {
    transitionDuration: {
      DEFAULT: "500ms",
    },
    transitionTimingFunction: {
      DEFAULT: "ease-in-out",
    },
    extend: {
      fontFamily: {
        montserrat: ["Montserrat", "sans-serif"],
      },
    },
  },
  plugins: [],
};

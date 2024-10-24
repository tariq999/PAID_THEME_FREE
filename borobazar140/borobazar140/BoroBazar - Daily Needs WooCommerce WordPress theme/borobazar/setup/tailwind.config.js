/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    "./*.php",
    "./Admin/*.js",
    "./Admin/*.php",
    "./Admin/views/*.php",
    "./Admin/views/*.js",
  ],
  darkMode: "class",
  theme: {
    screens: {
      xs: "500px",
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1440px",
      "3xl": "1780px",
      "4xl": "2160px", // only need to control product grid mode in ultra 4k device
    },
    extend: {
      colors: {},

      boxShadow: {
        "btn-hover":
          "rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px",
        "main-shadow": "0px 24px 48px 0px #0000000A",
        "card-shadow": "0px 2px 4px 0px #48546514",
      },
    },
  },
  plugins: [],
};

// require("@tailwindcss/typography"), require("@tailwindcss/forms")

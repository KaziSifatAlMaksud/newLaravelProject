/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#3490dc',
        'primary-20': '#abcdef',
      },
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}


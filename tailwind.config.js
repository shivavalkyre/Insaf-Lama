const colors = require('tailwindcss/colors');

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    textColor: theme => theme('colors'),
    colors: {
      transparent: colors.transparent,
      black: colors.black,
      white: colors.white,
      green: colors.green,
      blue: colors.blue,
      gray: colors.trueGray,
      indigo: colors.indigo,
      rose: colors.rose,
      yellow: colors.amber,
      lime: colors.lime,
      red: colors.red,
      warmGray: colors.warmGray,
    },
    zIndex: {
      '0': 0,
     '10': 10,
     '20': 20,
     '30': 30,
     '40': 40,
     '50': 50,
     '25': 25,
     '75': 75,
     '100': 100,
     '999': 999,
      'auto': 'auto',
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    // require('@tailwindcss/forms'),
    // require('@tailwindcss/custom-forms')
  ],
  // corePlugins: {
  //    outline: false,
  // }
}

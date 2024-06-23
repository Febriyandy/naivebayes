/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        body: ['Plus Jakarta Sans']
      },
  colors: {
    primary: '#062765', 
    secondary: '#FFFFFF', 
  },
  plugins: [],
    }
  }
}
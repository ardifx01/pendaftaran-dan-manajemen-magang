/** @type {import('tailwindcss').Config} */
export default {
  content: [

    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
         colors:{
          'primary': '#12A0B2',
          'myBg':' #181923',
          'light': '#93B1A6',

         },

         boxShadow: {
          '3xl': ' rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;'
         },

         fontFamily:{
             
          'poppins' :[ 'Poppins', 'sans-serif'],
          'alegreya': ['Alegreya Sans SC', 'sans-serif']
         },

         fontSize: {

          200:'200px'
         },

    width:{
      500:'500px',
      '45%':'45%'
     
    },

    height:{
      '45%':'45%',
      '90%' :'90%',
      '250' :'49rem',
    },

                         
    spacing: {
      '128': '32rem',
    },

  
  

    // -----------------
    // responsive brealpoint

    screens: {
      'phone': {'max':'640px'},

      'tablet': {'max':'770px'},
      
      'laptop': {'max':'1023px'},
     
      'desktop': {'max':'1280px'},

      'extra': {'max':'1500px'},


      'xxl': {'min':'1500px'},
    
    },
    // -------------------

   
     
    },
  },
  plugins:  [
    require('tailwind-scrollbar'),
    
    function ({ addUtilities }) {
      const newUtilities = {};
      
      // Slide Down Animation
      newUtilities['@keyframes slideDown'] = {
        from: { transform: 'translateY(-100%)' },
        to: { transform: 'translateY(0)' },
      };
      newUtilities['.slide-down'] = {
        animation: 'slideDown 0.5s ease-in-out',
      };

      // Slide Up Animation
      newUtilities['@keyframes slideUp'] = {
        from: { transform: 'translateY(0)' },
        to: { transform: 'translateY(-100%)' },
      };
      newUtilities['.slide-up'] = {
        animation: 'slideUp 0.5s ease-in-out',
      };

    // slide right
newUtilities['@keyframes slideright'] = {
  from: { transform: 'translateX(-50%)' },
  to: { transform: 'translateX(0)' },
};
newUtilities['.slide-right'] = {
  animation: 'slideright 0.5s ease-in-out',
};

// slide left
newUtilities['@keyframes slideleft'] = {
  from: { transform: 'translateX(0)' },
  to: { transform: 'translateX(-100%)' },
};
newUtilities['.slide-left'] = {
  animation: 'slideleft 0.5s ease-in-out',
};


      addUtilities(newUtilities, ['responsive', 'hover']);
    },
  ],
}


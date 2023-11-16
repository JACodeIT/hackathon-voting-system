import { extendTheme } from "@chakra-ui/react";

const colors = {
  primary: {
    100: "#E5FCF1",
    200: "#27EF96",
    300: "#10DE82",
    400: "#0EBE6F",
    500: "#0CA25F",
    600: "#0A864F",
    700: "#086F42",
    800: "#075C37",
    900: "#064C2E"
  }
};

const breakpoints = {
  base: '0em',
  sm: '30em',
  md: '48em',
  lg: '62em',
  xl: '80em',
  '2xl': '96em',
  '3xl': '120em',
  '4xl': '160em',
  '5xl': '200em',
  '6xl': '240em',
  '7xl': '280em',
}

const fonts = {
    heading: `'Roboto', sans-serif`,
    body: `'Inter', sans-serif`,
}


const customTheme = extendTheme({ colors, breakpoints, fonts });

export default customTheme;

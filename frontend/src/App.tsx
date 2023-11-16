import { Box, ChakraProvider } from '@chakra-ui/react'
import Router from './routers';
// import AuthContextProvider from './context/authContext';
import customTheme from './utility/theme';



function App() {
  return (
    <ChakraProvider theme={customTheme}>
      <Box justifyContent="center" w="100%">
      {/* <AuthContextProvider> */}
          <Router />
      {/* </AuthContextProvider> */}
      </Box>
    </ChakraProvider>
  )
}

export default App;
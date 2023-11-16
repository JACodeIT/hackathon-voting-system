import { useContext, useEffect, useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { ZodError, boolean } from "zod"
import { getLocalStorageItem } from "../../utility/helper";
import { Box, Button, Checkbox, Flex, FormControl, FormHelperText, FormLabel, Heading, Input, Stack, useColorModeValue, Text, InputRightElement, InputGroup, IconButton, FormErrorMessage } from "@chakra-ui/react";
import { ActionType, setLoginToken } from "../../actions/authActions";
import { AuthContext } from "../../context/authContext";
import { ErrorMessage, Formik, FormikHelpers, useFormik } from "formik";
import { ViewIcon, ViewOffIcon } from "@chakra-ui/icons";
import { signInSchema } from "../../schemas/signInSchema";
import request from "../../service/request";
import authAPI from "../../service/api";
import { API_DOMAIN, POST } from "../../utility/constants";
import { z } from "zod";
import { toFormikValidationSchema } from "zod-formik-adapter";

const initialValues = {
    email: '',
    password: '',
};

const SignIn = () => {
    const { dispatch } = useContext(AuthContext);
    const [ showPassword, setShowPassword ] = useState<boolean>(false);
    const navigate = useNavigate();

    useEffect(() => {
        if(getLocalStorageItem('token') !== null && location.pathname === '/sign-in') {
            dispatch({
                type: ActionType.LOGOUT,
            });
        }
    }, [])

    const handleSetShowPassword = () => {
        setShowPassword(!showPassword)
    };

    const handleMouseDownPassword = (event: React.MouseEvent<HTMLButtonElement>) => {
        event.preventDefault();
    }

    type FormValues = z.infer<typeof signInSchema>;

    return (
            <Flex
            minH={'100vh'}
            align={'center'}
            justify={'center'}
            bgColor={'#f6f8fb'}>
            <Stack spacing={8} mx={'auto'} maxW={'2xl'} w={600}>
                <Box
                rounded={'xl'}
                bg={useColorModeValue('white', 'gray.700')}
                boxShadow={'2xl'}
                p={8}>
                <Stack>
                    <Heading fontSize={'2xl'} pl={10} pt={10}>HackVote</Heading>
                </Stack>
                <Formik<FormValues>
                    initialValues={initialValues}
                    validationSchema={toFormikValidationSchema(signInSchema)}
                    onSubmit={(values, actions) => {
                        const { email, password } = values;
                        const { setSubmitting, setErrors } = actions;
                        request({
                            url: API_DOMAIN + authAPI.LOGIN,
                            method: POST,
                            data: {
                                email: email,
                                password: password
                            }
                        }).then(response => {
                            console.log('response : ', response);
                            const { data } = response;

                            dispatch(setLoginToken(data))

                            console.log('token:', token)
                            navigate('/dashboard');
                        }).catch(error => {
                            console.log('error : ', error);

                            setErrors({
                                email: ' ',
                                password: 'Invalid email or password'
                            });
                        }).finally(() => {
                            setSubmitting(false);
                        })
                    }}
                >
                    {
                        formik => (
                            <form onSubmit={formik.handleSubmit}>
                            <Stack spacing={4} p={10}>
                            <FormControl id="email" isInvalid={formik.touched.email && Boolean(formik.errors.email)}>
                            <FormLabel>Email</FormLabel>
                            <Input 
                                type="email" 
                                borderRadius={'full'}
                                name="email"
                                value={formik.values.email}
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                
                            />
                            <FormErrorMessage>{formik.errors.email}.</FormErrorMessage>
                            </FormControl>
                            <FormControl id="password" isInvalid={formik.touched.password && Boolean(formik.errors.password)}>
                            <FormLabel>Password</FormLabel>
                             <InputGroup>
                                <Input
                                    type= {showPassword ? 'text' : 'password'} 
                                    borderRadius={'full'}
                                    name="password"
                                    value={formik.values.password}
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                    
                                />
                                <InputRightElement children={
                                    <IconButton
                                        size={'xl'}
                                        onClick={handleSetShowPassword}
                                        onMouseDown={handleMouseDownPassword}
                                        aria-label="Toggle password visibility"
                                        icon={showPassword ? <ViewOffIcon></ViewOffIcon> : <ViewIcon></ViewIcon>}
                                        bg={'transparent'}
                                        borderRadius={'circle'}
                                    />
                                }>
                                </InputRightElement>
                             </InputGroup>
                             <FormErrorMessage>{formik.errors.password}.</FormErrorMessage>
                            </FormControl>
                            <Stack spacing={5}>
                            <Stack>
                                <Text color={'blue.400'}>Forgot password?</Text>
                            </Stack>
                            <Button
                                colorScheme="purple"
                                w={'30%'}
                                borderRadius={'full'}
                                type="submit">
                                {formik.isSubmitting ?
                                    'Logging In'
                                 : 'Login'
                                }
                            </Button>
                            </Stack>
                            <Stack direction={{ base: 'column', sm: 'row' }}>
                                <Text>Need a HackVote account?</Text>
                                <Text color={'blue.400'} onClick={() => navigate('/sign-up')}>Sign Up</Text>
                            </Stack>
                        </Stack>
                        </form>
                        )
                    }
                </Formik>
                </Box>
            </Stack>
            </Flex>
    )
}

export default SignIn;
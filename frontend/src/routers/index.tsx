import { BrowserRouter, Route, Routes } from "react-router-dom";
import { AuthContext } from "../context/authContext"
import { Suspense, lazy } from "react";
import { Heading } from "@chakra-ui/react";

const SignIn = lazy(() => import('../pages/sign-in'));
const SignUp = lazy(() => import('../pages/sign-up'));
const Home = lazy(() => import('../pages/home'));
const Dashboard = lazy(() => import('../pages/dashboard'));


const Router = () => {
    // const { state } = useContext(AuthContext);
    // const { token } = state;

    // console.log(token);

    return (
        <BrowserRouter>
            { "asdas" ? (
                <Routes>
                    <Route path="/sign-in" element = {
                        <Suspense fallback={<Heading justifyContent={"center"} alignItems={"center"}>Loading...</Heading>}>
                            <SignIn />
                        </Suspense>
                    } />
                    <Route path="/sign-up" element = {
                        <Suspense fallback={<Heading>Loading...</Heading>}>
                            <SignUp />
                        </Suspense>
                    } />
                    <Route path="/Dashboard" element = {
                        <Suspense fallback={<Heading>Loading...</Heading>}>
                            <Dashboard />
                        </Suspense>
                    } />
                    <Route path="/" element = {
                        <Suspense fallback={<Heading justifyContent={"center"} alignItems={"center"}>Loading...</Heading>}>
                            <Home />
                        </Suspense>
                    } />
                </Routes>
            ) : (
                <Routes>
                    <Route path="/sign-in" element = {
                        <Suspense fallback={<Heading>Loading...</Heading>}>
                            <SignIn />
                        </Suspense>
                    } />
                    <Route path="/sign-up" element = {
                        <Suspense fallback={<Heading>Loading...</Heading>}>
                            <SignUp />
                        </Suspense>
                    } />
                    <Route path="/Dashboard" element = {
                        <Suspense fallback={<Heading>Loading...</Heading>}>
                            <Dashboard />
                        </Suspense>
                    } />
                    <Route path="/" element = {
                        <Suspense fallback={<Heading>Loading...</Heading>}>
                            <Home />
                        </Suspense>
                    } />
                </Routes>
            )
        }
        </BrowserRouter>
    )
}

export default Router;
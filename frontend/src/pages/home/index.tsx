import LandingLayout from "../../components/landing";
import { useEffect } from "react";

const Home = () => {
    useEffect(() => {
        document.title = 'HackaVote'
    });

    return (
        <LandingLayout>
        </LandingLayout>
    );
}

export default Home;
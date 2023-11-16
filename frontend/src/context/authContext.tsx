import { Dispatch, createContext, useEffect, useReducer } from "react";
import { AuthActions } from "../actions/authActions";
import authReducer, { AuthState, initialState } from "../reducer/authReducer";
import { setLocalStorageItem } from "../utility/helper";

interface AuthContextInterface {
    state: AuthState;
    dispatch: Dispatch<AuthActions>;
}

export const AuthContext = createContext<AuthContextInterface>({
    state: initialState,
    dispatch: () => undefined
});


export interface LayoutProps {
    children: React.ReactNode;
}

const AuthContextProvider = (props: LayoutProps) => {
    const children = props.children;

    const [state, dispatch] = useReducer(authReducer, initialState);

    useEffect(() => {
        if(state.token){
            setLocalStorageItem('token', state.token);
        }else{
            localStorage.clear();
        }
    }, [state.token]);

    return (
        <AuthContext.Provider value={{state, dispatch}}>
            {
                children
            }
        </AuthContext.Provider>
    )
}

export default AuthContextProvider;
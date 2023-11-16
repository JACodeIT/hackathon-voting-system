import { ActionType, AuthActions } from "../actions/authActions";
import { getLocalStorageItem } from "../utility/helper";

export interface AuthState {
    token: string;
}

export const initialState: AuthState = {
    token: getLocalStorageItem('token')
};

const authReducer = (state: AuthState, action: AuthActions): AuthState => {
    switch(action.type) {
        case ActionType.LOGIN:
            return {
                ...state,
                token: action.payload
            };
        case ActionType.LOGOUT:
            return {
                ...state,
                token: '',
            };
        default:
            return state;
    }
};

export default authReducer;


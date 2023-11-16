import { AuthState } from "../reducer/authReducer";

export enum ActionType {
    LOGIN, 
    LOGOUT
}

export interface LOGIN {
    type: ActionType.LOGIN;
    payload: string;
}

export interface LOGOUT {
    type: ActionType.LOGOUT;
}

export const setLoginToken = (payload: AuthState): LOGIN => {
    return {
        type: ActionType.LOGIN,
        payload: payload.token
    }
}

export type AuthActions = LOGIN | LOGOUT
import { AxiosRequestConfig } from "axios";
import axiosInstance from "./axiosInstance";


export const controller = new AbortController();
// To cancel the request use:
// controller.abort()

const request = (axiosRequestConfig: AxiosRequestConfig) => {
    return axiosInstance.request(axiosRequestConfig);
}

export default request;
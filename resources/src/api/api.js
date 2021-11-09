import axios from 'axios'
import {resetUser, setUser} from "../composables/useUser";

const axiosParams = {
    //baseURL: process.env.NODE_ENV === 'development' ? 'http://localhost:8080' : '/',
    baseURL: '/',
    withCredentials: true,
    headers:{
        common:{
            'X-Requested-With':'XMLHttpRequest'
        }
    }
}

const axiosInstance = axios.create(axiosParams)

const didAbort = error => axios.isCancel(error)

const getCancelSource = () => axios.CancelToken.source()

const withAbort = fn => async (...args) => {
    const originalConfig = args[args.length - 1]
    let {abort, ...config} = originalConfig

    if (typeof abort === 'function') {
        const {cancel, token} = getCancelSource()
        config.cancelToken = token
        abort(cancel)
    }

    try {
        return await fn(...args.slice(0, args.length - 1), config)
    } catch (error) {
        didAbort(error) && (error.aborted = true)
        throw error
    }
}
const withLogger = async promise =>
    promise.catch(error => {
        if (!process.env.VUE_APP_DEBUG_API) throw error;
        if (error.response) {
            console.log(error.response.data);
            console.log(error.response.status);
            console.log(error.response.headers);
        } else if (error.request) {
            console.log(error.request);
        } else {
            console.log("Error", error.message);
        }
        console.log(error.config);
        throw error;
    });


const withResponseWrapper = fn => async (...args) => {
    const config = args[args.length - 1]

    if (config && config.ignoreResponseWrapper) {
        return fn(...args)
    }

    try {

        const {data} = await fn(...args)
        return {data: data, error: null}

    } catch (error) {

        if (error?.response?.status === 401) {
            resetUser()
        }

        if (error?.config?.silenceError) {

            let e = error?.response?.data?.errors
                || error?.response?.data
                || error.message

            if (e && !e.hasOwnProperty('message')) {
                e.message = error.response.statusText
            }

            return {data: null, error: e}
        }

        throw new Error(error)
    }
}


const api = axios => {
    return {
        get: (url, config = {}) => withResponseWrapper(axios.get)(url, config),
        post: (url, body, config = {}) => withResponseWrapper(axios.post)(url, body, config),
        patch: (url, body, config = {}) => withResponseWrapper(axios.patch)(url, body, config),
        put: (url, body, config = {}) => withResponseWrapper(axios.put)(url, body, config),
        delete: (url, config = {}) => withResponseWrapper(axios.delete)(url, config),
    }
}


export default api(axiosInstance)

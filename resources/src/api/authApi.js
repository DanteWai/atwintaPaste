import api from './api'



export const authToken = () => {
    return api.get('sanctum/csrf-cookie', {
        ignoreResponseWrapper: true
    })
}

export const authCheck = () => {
    return api.get('api/auth/check', {silenceError: true})
}

export const authLogin = async ({login, password}) => {
    await authToken()
    return api.post(
        'api/auth/login',
        {login, password},
        {silenceError: true}
    )
}

export const authRegistration = async ({login, email, password}) => {
    await authToken()
    return api.post(
        'api/auth/register',
        {login, email, password},
        {silenceError: true}
    )
}

export const authLogOut = () => {
    return api.get('api/auth/logout', {silenceError: true})
}




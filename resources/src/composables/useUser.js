import {ref, readonly, computed} from 'vue'
import {authCheck, authLogin, authLogOut, authRegistration} from "../api/authApi";

const userState = ref(null)

export const isLogged = computed(() => userState.value !== null)


export const getUser = () => readonly(userState)

export const setUser = data => (userState.value = {
    roles:['logged-in'],
    ...data
})

export const updateUser = (key, value) => {
    isLogged.value && (userState.value[key] = value)
}

export const resetUser = () => (userState.value = null)

export const userLogin = async ({login, password}) => {
    const {data, error} = await authLogin({login, password})

    if(!error) {
        setUser(data.data)
        return {data:data.data, error}
    }

    return {data, error}
}


export const userRegistration = async ({login, email, password}) => {
    const {data, error} = await authRegistration({login, email, password})

    if(!error) {
        setUser(data.data)
        return {data:data.data, error}
    }

    return {data, error}
}

export const userCheck = async () => {
    const {data, error} = await authCheck()

    if(!error) {
        setUser(data.data)
        return {data:data.data, error}
    }

    return {data, error}
}

export const userLogOut = async () => {
    const {data, error} = await authLogOut()

    if (!error) {
        resetUser()
    }

    return {data, error}
}


export const useUser = () => {
    return {
        user: getUser(),
        setUser,
        updateUser,
        isLogged
    }
}


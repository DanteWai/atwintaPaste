import {reactive, readonly, ref} from "vue";
import {pasteAdd, pasteMeta, pasteOne, pastePublic, pasteUser} from "../api/pasteApi";
import {isLogged} from "./useUser";




const metaState = ref({
    langs: [],
    accesses: []
})

export const getMetaState = () => readonly(metaState)
export const setMetaState = (data) => metaState.value = data
const metaStateIsNoEmpty = () => metaState.value.langs.length && metaState.value.accesses.length

export const getMeta = async () => {
    if (metaStateIsNoEmpty()){
        return getMetaState()
    }

    const {data, error} = await pasteMeta()

    if (!error) {
        setMetaState(data.data)
    }

    return {data, error}
}

const pasteState = reactive({
    publicPastes:[],
    privatePastes:[]
})

export const getPasteState = () => readonly(pasteState)

export const getPublicPastes = async (page) => {
    const {data, error} = await pastePublic(page)


    if (!error) {
        return {data:data, error}
    }

    return {data, error}
}

export const getUserPastes = async (page, local) => {
    const {data, error} = await pasteUser(page)

    if (!error) {
        return {data:data, error}
    }

    return {data, error}
}

export const refreshPastes = async () => {
    let {data, error} = await getPublicPastes(1, true)
    !error && (pasteState.publicPastes = data.data)

    if(isLogged.value){
        let {data, error} = await getUserPastes(1, true)
        !error && (pasteState.privatePastes = data.data)
    }
}

export const getPaste = async (slug) => {
    const {data, error} = await pasteOne(slug)

    if (!error) {
        return {data:data.data, error}
    }

    return {data, error}
}

export const addPaste = async (payload) => {

    const {data, error} = await pasteAdd(payload)

    if (!error) {
        return {data:data.data, error}
    }

    return {data, error}
}



export const usePaste = () => {
    return {
        meta: getMetaState(),
        getMeta,
        pastes: getPasteState()
    }
}

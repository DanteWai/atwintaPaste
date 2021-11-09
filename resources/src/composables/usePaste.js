import {readonly, ref} from "vue";
import {pasteAdd, pasteMeta, pasteOne, pastePublic, pasteUser} from "../api/pasteApi";



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

export const getPublicPastes = async (page) => {
    return pastePublic(page)
}

export const getUserPastes = async (page) => {
    return pasteUser(page)
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
        getMeta
    }
}

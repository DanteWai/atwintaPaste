import api from "./api";

export const pasteMeta = () => {
    return api.get('api/pastes/meta', {silenceError: true})
}

export const pastePublic = (page = 1) => {
    return api.get('api/pastes', {
        silenceError: true,
        params: {
            page
        }
    })
}

export const pasteUser = (page = 1) => {
    return api.get('api/pastes/my', {
        silenceError: true,
        params: {
            page
        }
    })
}

export const pasteAdd = (payload) => {
    return api.post(
        'api/pastes/',
        {...payload},
        {silenceError: true,}
    )
}

export const pasteOne = (slug) => {
    return api.get('api/pastes/' + slug, {silenceError: true})
}

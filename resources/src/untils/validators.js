import {validation} from "../config/messages";

export function required(value, name = 'field') {
    return Boolean(value) ? true : validation.required(name)
}

export function email(value, name = 'field') {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
        return true
    }
    return validation.email(name)
}

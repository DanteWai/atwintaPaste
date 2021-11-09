import {ref, readonly} from 'vue'

const alertsState = ref([])

let messagesAI = 0;

export const getAlerts = () => readonly(alertsState)

const remove = (id) => {
    alertsState.value = alertsState.value.filter(msg => msg?.id !== id);
}

export const addAlert = ({text, timeout = 6000, type = 'error'}) => {
    let id = ++messagesAI;
    alertsState.value.push({id, text, type})

    if (timeout && !Number.isNaN(Number(timeout))) {
        setTimeout(() => {
            remove(id)
        }, timeout);
    }
}

export const useAlert = () => ({
    alerts: getAlerts(),
    addAlert
})

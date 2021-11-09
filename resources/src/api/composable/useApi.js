import { ref, computed } from 'vue'
import { upperFirst } from 'lodash'
import { apiStatus } from '../constants/apiStatuses'

const { IDLE, SUCCESS, PENDING, ERROR } = apiStatus


const createNormalisedApiStatuses = (status, apiName) => {
    let normalisedApiStatuses = {}

    for (const [statusKey, statusValue] of Object.entries(apiStatus)) {
        let propertyName = ''

        if (apiName) {
            propertyName = `${apiName}Status${upperFirst(statusKey.toLowerCase())}`
        } else {
            propertyName = `status${statusKey.toLowerCase()}`
        }

        normalisedApiStatuses[propertyName] = computed(
            () => statusValue === status.value
        )
    }

    return normalisedApiStatuses
}


export const useApi = (apiName, fn, config = {}) => {
    const { initialData, responseAdapter } = config

    const data = ref(initialData)
    const status = ref(IDLE)
    const error = ref(null)


    const exec = async (...args) => {
        try {
            status.value = PENDING
            const response = await fn(...args)
            data.value =
                typeof responseAdapter === 'function'
                    ? responseAdapter(response)
                    : response
            status.value = SUCCESS
        } catch (error) {
            error.value = error
            status.value = ERROR
        }
    }

    const setStatus = nextStatus => (status.value = nextStatus)

    return {
        data,
        status,
        error,
        exec,
        setStatus,
        ...createNormalisedApiStatuses(status, apiName),
    }
}

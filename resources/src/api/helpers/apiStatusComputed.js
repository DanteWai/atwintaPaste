import { upperFirst } from 'lodash'
import { apiStatus } from '../constants/apiStatuses'


export const apiStatusComputed = (names = []) => {

    let computed = {}

    const properties = Array.isArray(names) ? names : [names]

    for (const name of properties) {

        for (const [statusKey, statusValue] of Object.entries(apiStatus)) {

            const normalisedStatus = upperFirst(statusKey.toLowerCase())

            computed[`${name}${normalisedStatus}`] = function() {
                return this[name] === statusValue
            }
        }
    }
    return computed
}

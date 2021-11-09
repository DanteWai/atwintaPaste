import {getUser} from "../../../composables/useUser";

const permissionCheckTypeMethods = {
    'one-of': roles => roles.some,
    'all-of': roles => roles.every,
}

export const checkPermission = (roles, config = {}) => {

    const { type = 'one-of', entityOwnerId, debug = false } = config

    const checkMethod =
        permissionCheckTypeMethods?.[type] || permissionCheckTypeMethods['one-of']

    const user = getUser()
    const userRoles = user.value?.roles || []

    const hasAccess = checkMethod(roles).bind(roles)(role => {

        if (role === 'owner' && entityOwnerId) {
            return user.value?.id == entityOwnerId
        }

        if (role === 'logged-in') {
            return Boolean(user.value?.id)
        }

        return userRoles.includes(role)
    })

    debug &&
    console.log('PERMISSION_DEBUG', {
        hasAccess,
        requiredRoles: roles,
        userRoles,
        type,
        entityOwnerId,
    })

    return hasAccess
}

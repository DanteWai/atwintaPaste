export const validation = {
    required: (field) => `${field} is required`,
    email: (field) => `${field} must be email`,
}

export const authMessages = {
    success: 'Login completed successfully',
    register: 'You have successfully registered',
    error: 'Authentication failed'
}

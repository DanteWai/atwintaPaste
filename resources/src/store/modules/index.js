import { camelCase } from 'lodash'

const requireModule = require.context(
    '.',
    true,
    /^(?!.*(Actions|Mutations|Getters|Types|helpers|index)).*\.js$/
)

const modules = {}

requireModule.keys().forEach(fileName => {
    // Ignore unit test files
    if (/\.unit\.js$/.test(fileName)) return

    // Remove the file extension and convert to camelcase
    modules[camelCase(fileName.split('/')[1].replace(/(\.\/|\.js)/g, ''))] = {
        namespaced: true,
        ...requireModule(fileName).default,
    }
})

export default modules

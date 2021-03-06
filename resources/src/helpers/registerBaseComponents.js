import {camelCase, upperFirst} from 'lodash'

export const registerBaseComponents = vm => {
    try {
        const requireComponent = require.context(
            '../components/base',
            true,
            /Base[\w-]+\.vue$/
        )

        requireComponent.keys().forEach(filePath => {
            const componentConfig = requireComponent(filePath)
            const fileName = filePath.split('/').slice(-1)[0]
            const componentName = upperFirst(
                camelCase(fileName.replace(/\.\w+$/, ''))
            )

            vm.component(componentName, componentConfig.default || componentConfig)
        })
    } catch (err) {
        console.log('Base component registration failed')
        console.error(err)
    }
}

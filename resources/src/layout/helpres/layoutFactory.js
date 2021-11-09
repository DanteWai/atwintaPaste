import { h } from 'vue'
import { useLayoutFactory } from './useLayoutFactory'

export const layoutFactory = ({
    LayoutComponent,
    layoutComponents,
    LAYOUTS,
    defaultLayout,
}) => {
    const { useLayout } = useLayoutFactory({
        layoutComponents,
        LAYOUTS,
        defaultLayout,
    })

    // Functional wrapper component
    const Component = (props, { attrs, slots }) => {
        // Add useLayout function as a prop to passed LayoutComponent
        const options = { useLayout, ...props, ...attrs }
        return h(LayoutComponent, options, slots)
    }

    return {
        LayoutComponent: Component,
        useLayout,
    }
}

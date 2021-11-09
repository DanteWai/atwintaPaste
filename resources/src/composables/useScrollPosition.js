import { ref } from 'vue'

const scrollY = ref(window.scrollY)

const onScroll = () => {
    scrollY.value = window.scrollY
}

window.addEventListener('scroll', onScroll, false)

const cleanup = () => {
    window.removeEventListener('scroll', onScroll, false)
}

export const useScrollPosition = () => {
    return { scrollY, cleanup }
}

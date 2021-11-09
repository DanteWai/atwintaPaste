import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import {registerBaseComponents, loadPlugins} from './helpers/'
import {userCheck} from "./composables/useUser";

let check = userCheck()


export const app = createApp(App)

loadPlugins(['highlightjs'])
registerBaseComponents(app)

app.config.performance = true

app.use(router)


check.finally(() => {
    app.mount('#app')
})


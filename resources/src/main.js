import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import {registerBaseComponents, loadPlugins} from './helpers/'
import {userCheck, isLogged} from "./composables/useUser";

let check = userCheck()


export const app = createApp(App)

loadPlugins(['highlightjs'])
registerBaseComponents(app)

app.config.performance = true



check.finally(()=>{
    app.use(router)
    app.mount('#app')
})

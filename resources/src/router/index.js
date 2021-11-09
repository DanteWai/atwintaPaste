import { createRouter, createWebHistory } from "vue-router";
import { loadView } from './routerUtils'

import Home from "../views/Home.vue";
import AuthRoutes from "../views/Auth/AuthRoutes";
import ProfileRoutes from "../views/Profile/ProfileRoutes";
import PastesRoutes from "../views/Pastes/PastesRoutes";
import {isLogged, useUser} from "../composables/useUser";

const {user} = useUser()


const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    ...AuthRoutes,
    ...ProfileRoutes,
    ...PastesRoutes,
    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: loadView('NotFound'),
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    if(to.meta.auth && !isLogged.value) return next('/login')
    if(to.meta.guest && isLogged.value) return next('/')

    return next()
})

export default router;

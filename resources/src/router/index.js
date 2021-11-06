import { createRouter, createWebHistory } from "vue-router";
import { loadView } from './routerUtils'

import Home from "../views/Home.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
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

export default router;

import { loadView } from '@/router/routerUtils'

const routes = [
    {
        path: "/login",
        name: "Login",
        component: loadView('Auth/Login'),
        meta: { guest:true }
    },
    {
        path: "/register",
        name: "Register",
        component: loadView('Auth/Register'),
        meta: { guest:true }
    },
];

export default routes

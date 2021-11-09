import { loadView } from '@/router/routerUtils'

const routes = [
    {
        path: "/profile",
        name: "Profile",
        component: loadView('Profile/Profile'),
        meta: { auth:true }
    },
];

export default routes

import { loadView } from '@/router/routerUtils'

const routes = [
    {
        path: "/paste/:slug",
        name: "PasteView",
        component: loadView('Pastes/PasteView'),
    },
    {
        path: "/pastes/public",
        name: "PublicPastes",
        component: loadView('Pastes/PublicPastes'),
    },
];

export default routes

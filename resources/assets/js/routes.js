/*  import vue components */
import Login from './components/auth/Login.vue'
import User from './components/views/User.vue';
import Dashboard from './components/views/pages/Dashboard.vue';
import Users from './components/views/pages/Users.vue';
/* end of import vue components */

export const routes = [

    {
        path: '/',
        alias: '/home',
        name: 'user',
        component: User,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: 'dashboard',
                component: Dashboard,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'users',
                name: 'users',
                component: Users,
                meta: {
                    requiresAuth: true
                },
            }
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresGuest: true
        },
    }

];
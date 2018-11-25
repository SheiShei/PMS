/*  import vue components */
import Error404 from './components/Error.vue'
import Login from './components/auth/Login.vue'
import User from './components/views/User.vue';
import Dashboard from './components/views/pages/Dashboard.vue';
import Users from './components/views/pages/Users.vue';
import Brands from './components/views/pages/Brands.vue';
import JobOrders from './components/views/pages/JobOrders.vue';
import StickyNotes from './components/views/pages/StickyNotes.vue';
import AddBrand from './components/views/pages/brands/AddBrand.vue';
import ViewJobOrder from './components/views/pages/joborders/ViewJobOrder.vue';
import ViewJoCrea from './components/views/pages/joborders/ViewJoCrea.vue';
import NewJobOrderWeb from './components/views/pages/joborders/NewJobOrderWeb.vue';
import NewJobOrderCreative from './components/views/pages/joborders/NewJobOrderCreative.vue';
import BrandProfile from './components/views/pages/brands/BrandProfile.vue';
import Messages from './components/views/pages/Messages.vue';
/* end of import vue components */

export const routes = [

    {
        path: '/',
        alias: '/home',
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
            },
            {
                path: 'brands',
                name: 'brands',
                component: Brands,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'brands/add',
                name: 'new_brand',
                component: AddBrand,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'brands/jo',
                name: 'all_jo_list',
                component: JobOrders,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'brands/:id/jo',
                name: 'brands_jo_list',
                component: JobOrders,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'stiky-notes',
                name: 'sticky_notes',
                component: StickyNotes,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'new-jo-web',
                name: 'new_jo_web',
                component: NewJobOrderWeb,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'new-jo-creative',
                name: 'new_jo_creative',
                component: NewJobOrderCreative,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'jo/:id',
                name: 'jo',
                component: ViewJobOrder,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'jo-creatives/',
                name: 'jo-creatives',
                component: ViewJoCrea,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'clients/add',
                name: 'new_client',
                component: Dashboard,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'brand-profile',
                name: 'brand_profile',
                component: BrandProfile,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'messages/:convo_id',
                name: 'messages',
                component: Messages,
                meta: {
                    requiresAuth: true
                },
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresGuest: true
        },
    },
    {
        path: '*',
        name:'error404', 
        component: Error404
    }

];
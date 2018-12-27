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
import UpdateBrand from './components/views/pages/brands/UpdateBrand.vue';
import BrandProfile from './components/views/pages/brands/BrandProfile.vue';
import ViewJobOrder from './components/views/pages/joborders/ViewJobOrder.vue';
import ViewJoCrea from './components/views/pages/joborders/ViewJoCrea.vue';
import NewJobOrderWeb from './components/views/pages/joborders/NewJobOrderWeb.vue';
import NewJobOrderCreative from './components/views/pages/joborders/NewJobOrderCreative.vue';
import Messages from './components/views/pages/Messages.vue';
import Boards from './components/views/pages/Boards.vue';
import BoardKanban from './components/views/pages/boards/Kanban.vue';
import Conversation from './components/views/pages/messages/Conversation.vue';
import Welcome from './components/views/pages/messages/Welcome.vue';
import KanbanAddTask from './components/views/pages/boards/kanban/AddTask.vue';
import KanbanViewTask from './components/views/pages/boards/kanban/ViewTask.vue';
import KanbanGallery from './components/views/pages/boards/kanban/Gallery.vue';
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
                path: 'brand-profile-:brandId',
                name: 'brand_profile',
                component: BrandProfile,
                props: true,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'brands/update/:brand_Id',
                name: 'update_brand',
                component: UpdateBrand,
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
                path: 'jo/web/:jo_id',
                name: 'viewjoweb',
                component: ViewJobOrder,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'jo/creative/:jo_id',
                name: 'viewjocreative',
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
                path: 'messages',
                component: Messages,
                meta: {
                    requiresAuth: true
                },
                
                children: [
                    {
                        path: '',
                        name: 'messages',
                        component: Welcome,
                        meta: {
                            requiresAuth: true
                        },

                    },
                    {
                        path: ':convo_id',
                        name: 'convo-view',
                        component: Conversation,
                        meta: {
                            requiresAuth: true
                        },
                        beforeEnter: (to, from, next) => {
                            let param = to.params.convo_id;
                            axios.post('/api/verifyConvoUsers', {
                                slug: param
                            })
                                .then((response) => {
                                    if(response.data.status === 'authenticated') {
                                        next();
                                    }
                                    else{
                                        next({ name: 'error404' });
                                    }
                                    
                                })
                        }

                    }
                ]
            },
            {
                path: 'boards',
                name: 'boards',
                component: Boards,
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'boards/kanban/:board_id',
                name: 'kanboard',
                component: BoardKanban,
                meta: {
                    requiresAuth: true
                },
                children: [
                    {
                        path: 'addtask/:list_id',
                        name: 'kanboard_addtask',
                        component: KanbanAddTask,
                        meta: {
                            requiresAuth: true
                        },
                    },
                    {
                        path: 'viewtask/:task_id',
                        name: 'kanboard_viewtask',
                        component: KanbanViewTask,
                        meta: {
                            requiresAuth: true
                        },
                    },
                    {
                        path: 'gallery/:task_id',
                        name: 'kanboard_gallery',
                        component: KanbanGallery,
                        meta: {
                            requiresAuth: true
                        },
                    },
                ]
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
    },
    {
        path: '*',
        name:'error404', 
        component: Error404
    }

];

export function verifyUser() {
    
}
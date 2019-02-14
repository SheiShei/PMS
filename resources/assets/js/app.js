require('./bootstrap');

import Vue from "vue";

/* import all vue libraries */
import VueRouter from "vue-router";
import Vuex from "vuex";
import VueMoment from "vue-moment";
import VueChatScroll from 'vue-chat-scroll';
import Toaster from 'v-toaster'
    // toaster css
    import 'v-toaster/dist/v-toaster.css'
/* end of import all vue libraries */
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
/* next import all modules */
import {routes} from './routes';
import StoreData from './store/store';
import {initialize} from './helpers/general';
/* end of import modules */

import MainApp from './components/MainApp.vue'

Vue.use(VueMoment);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueChatScroll);

// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})

const store = new Vuex.Store(StoreData);

// create a router
const router = new VueRouter({

    routes,
    mode: 'history',

});

router.beforeResolve((to, from, next) => {
    if (to.path) {
        NProgress.start()
    }
    next()
  });
  
  router.afterEach((to, from) => {
    NProgress.done()
  });
  
// Vue.component('user-datatable', require('./components/datatable/user/Main.vue'));

initialize(store, router);



const app = new Vue({
    el: '#app',
    router,
    store,
    components : {
        mainApp : MainApp
    }
});
import { __initializeUser } from "../helpers/general";
import { setAuthorization } from "../helpers/general";
import users from "./modules/users";
import brands from "./modules/brands";
import messages from "./modules/messages";
import joborder from "./modules/joborder";
import boards from "./modules/boards";
import workbook from "./modules/workbook";
import settings from "./modules/settings";
import dashboard from "./modules/dashboard";


const user = __initializeUser();
export default {
    state: {
        loggedUser: user,
        isLoggedIn: !!user
    },
    getters: {
        currentUser: state => {
            return state.loggedUser;
        }
    },
    mutations: {
        storeTokenLogin(state, payload) {
            state.isLoggedIn = true;
            state.loggedUser = Object.assign(payload.user, {token: payload.access_token} );
            localStorage.setItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f', JSON.stringify(state.loggedUser));
            setAuthorization(state.loggedUser.token);
        },
        updatemyself (state, payload) {
            const var_name = JSON.parse(localStorage.getItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f'));
          
            console.log(var_name);
            console.log(payload);
            var_name.bg_image = payload.bg_image;
            var_name.picture = payload.picture;
            var_name.name = payload.name;
            var_name.email = payload.email;
            // var_name.password = payload.password;
            state.loggedUser = Object.assign(var_name);
            localStorage.setItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f', JSON.stringify(var_name));

        },

        removeToken(state) {
            state.loggedUser = null;
            state.isLoggedIn = false;
            localStorage.removeItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f');
        }
    },
    actions: {
        storeTokenLogin({commit}, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/api/login', credentials)
                    .then(response => {
                        console.log(response.data);
                        commit('storeTokenLogin', response.data);
                        resolve(response);

                    })
                    .catch(error => {
                        // console.log(error);
                        reject(error);
                    });
            });
                
        },

        removeToken({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/api/logout')
                    .then(response => {
                        // console.log(response);
                        commit('removeToken');
                        resolve(response);

                    })
                    .catch(error => {
                        // console.log(error);
                        // localStorage.removeItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f')
                        reject(error);
                    });
            });
        }
    },

    modules: {
        users,
        brands,
        messages,
        joborder,
        boards,
        workbook,
        settings,
        dashboard
    }
}

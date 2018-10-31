import { __initializeUser } from "../helpers/general";
import { setAuthorization } from "../helpers/general";

const user = __initializeUser();
export default {
    state: {
        loggedUser: user,
        isLoggedIn: !!user
    },
    getters: {
    },
    mutations: {
        storeTokenLogin(state, payload) {
            state.isLoggedIn = true;
            state.loggedUser = Object.assign(payload.user, {token: payload.access_token} );
            localStorage.setItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f', JSON.stringify(state.loggedUser));
            setAuthorization(state.loggedUser.token);
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
                        commit('storeTokenLogin', response.data);
                        resolve(response);

                    })
                    .catch(error => {
                        console.log(error);
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
                        console.log(error);
                        // localStorage.removeItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f')
                        reject(error);
                    });
            });
        }
    }
}
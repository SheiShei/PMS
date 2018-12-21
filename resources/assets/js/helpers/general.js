import Echo from 'laravel-echo'
window.Pusher = require('pusher-js');

export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        if (to.matched.some(record => record.meta.requiresAuth)) {
            if (!store.state.isLoggedIn) {
                next({
                    name: 'login',
                })
            } 
            else {
                next()
            }
        } 
        else if (to.matched.some(record => record.meta.requiresGuest)) {
            if (store.state.isLoggedIn) {
                next({
                    name: 'dashboard',
                })
            } 
            else {
                next()
            }
        }
        else {
            next()
        }
    })

    if(store.state.isLoggedIn){
        setAuthorization(store.state.loggedUser.token);
    }

    
    if(store.state.loggedUser){
        checkToken(store.state.loggedUser.token)
            .then(response => {
                // router.push('/login');
                // console.log(response);
            })
            .catch(error => {
                // console.log(error);
                window.location.href = '/login';
                localStorage.removeItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f');
                
            })
    }
}

export function setAuthorization(token) {
    // console.log(token);
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    axios.defaults.headers.common["Accept"] = 'application/json';

    let bearerToken = JSON.parse(localStorage.getItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f'));
    if(bearerToken) {
        bearerToken = bearerToken.token;
    }
    else {
        bearerToken = 'Sheira The Great';
    }

    window.Echo = new Echo({
        // authEndpoint: '/broadcast',
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        encrypted: false,
        auth: {
            headers: {
                'Accept': 'application/json',
                Authorization: 'Bearer ' + bearerToken
            },
        },
    });
}

export function __initializeUser() {
    const _5f414e475f554c4f4c5f4e415f53495f4b57494e495f = localStorage.getItem('5f414e475f554c4f4c5f4e415f53495f4b57494e495f');

    if(!_5f414e475f554c4f4c5f4e415f53495f4b57494e495f){
        return null;
    }
    return JSON.parse(_5f414e475f554c4f4c5f4e415f53495f4b57494e495f);
}

export function checkToken(token) {
    return new Promise((resolve,reject) => {
        axios.post('/api/check', {token: token} )
            .then(response => {
                // console.log(response)
                resolve(response);

            })
            .catch(error => {
                // console.log(error);
                reject(error);
            });
    });
}
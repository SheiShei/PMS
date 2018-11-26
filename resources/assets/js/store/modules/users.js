const state = {
    users: []
};

const getters = {
    usersList: state => {
        return state.users;
    }
};

const mutations = {
    setUsers (state, users) {
        state.users = users;
    },

    addUser (state, user) {
        state.users.unshift(user);
    },

    updateUser (state, user) {
        var index = _.findIndex(state.users, {id: user[0].id});
        state.users[index] = user[0];
        
    },

    deleteUser (state, id) {
        var index = _.findIndex(state.users, {id: id});
        state.users.splice(index, 1);
    }
};

const actions = {
    setUsers({commit}, data) {
        // console.log(data);
        return new Promise((resolve, reject) => {
            axios.post(data.url, {
                filter: data.data.filter,
                search: data.data.search,
                notArchive: data.data.notArchive
            })
                .then((response) => {
                    // console.log(response.data);
                    commit('setUsers', response.data.data)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                    alert('Something went wrong, try reloading the page');
                });
        });
    },

    addUser({commit}, data) {
        let credentials = {
            name: data.name,
            email: data.email,
            password: data.password,
            team: data.team,
            role: data.role
        }
        // console.log(credentials);

            return new Promise((resolve, reject) => {
                axios.post('/api/addusers', credentials)
                    .then((response) => {
                        // console.log(response);
                        commit('addUser', response.data[0]);
                        resolve(response);
                    })

                    .catch((error) => {
                        if(error.response.status == 422){
                            // console.log(error.response.data);
                            reject(error.response.data.errors);
                        }
                    })
            });
    },

    updateUser({commit}, data) {
        let credentials = {
            id: data.id,
            name: data.name,
            email: data.email,
            password: data.password,
            team: data.team,
            role: data.role
        }
        // console.log(credentials);

            return new Promise((resolve, reject) => {
                axios.patch('/api/updateuser', credentials)
                    .then((response) => {
                        // console.log(response);
                        commit('updateUser', response.data);
                        resolve(response);
                    })

                    .catch((error) => {
                        if(error.response.status == 422){
                            // console.log(error.response.data);
                            reject(error.response.data.errors);
                        }
                    })
            });
    },

    deleteUser({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/deleteuser', { 
                data: { id: id}
            })
                .then((response) => {
                    console.log(response);
                    commit('deleteUser', id);
                    resolve(response);
                })

                .catch((error) => {
                    if(error.response.status == 422){
                        console.log(error);
                        reject(error);
                    }
                })
        });
    },

    restoreUser({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.post('/api/restoreuser', { 
                data: { id: id}
            })
                .then((response) => {
                    // console.log(response);
                    commit('deleteUser', id);
                    resolve(response);
                })

                .catch((error) => {
                    if(error.response.status == 422){
                        console.log(error);
                        reject(error);
                    }
                })
        });
    }
    
};

export default {
    state,
    getters,
    mutations,
    actions 
}
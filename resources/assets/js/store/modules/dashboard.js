const state = {
    dashboard_admin: [],
    date: '',
    dashboard_acma: [],
    display_joborders: [],
    dashboard_emp: [],
    reminder_tasks: [],
    dashboard_client: [],
    overdued_tasks: [],
    display_messages: [],
    display_notifs: '',
    display_urworkbooks: [],
    display_rworkbooks: [],

};

const getters = {
    dashboard_admin: state => {
        return state.dashboard_admin;
    },
    date: state => {
        return state.date;
    },
    dashboard_acma: state => {
        return state.dashboard_acma;
    },
    display_joborders: state => {
        return state.display_joborders;
    },
    dashboard_emp: state => {
        return state.dashboard_emp;
    },
    reminder_tasks: state => {
        return state.reminder_tasks;
    },
    dashboard_client: state => {
        return state.dashboard_client;
    },
    overdued_tasks: state => {
        return state.overdued_tasks;
    },
    display_messages: state => {
        return state.display_messages;
    },
    display_notifs: state => {
        return state.display_notifs;
    },
    display_urworkbooks: state => {
        return state.display_urworkbooks;
    },
    display_rworkbooks: state => {
        return state.display_rworkbooks;
    },


};

const mutations = {
    dashboard_admin(state, data) {
        state.dashboard_admin = data;
    },
    date(state, data) {
        state.date = data;
    },
    dashboard_acma(state, data) {
        state.dashboard_acma = data;
    },
    display_joborders(state, data) {
        state.display_joborders = data;
    },
    dashboard_emp(state, data) {
        state.dashboard_emp = data;
    },
    reminder_tasks(state, data) {
        state.reminder_tasks = data;
    },
    dashboard_client(state, data) {
        state.dashboard_client = data;
    },
    overdued_tasks(state, data) {
        state.overdued_tasks = data;
    },
    display_messages(state, data) {
        state.display_messages = data;
    },
    display_notifs(state, data) {
        state.display_notifs = data;
    },
    display_urworkbooks(state, data) {
        state.display_urworkbooks = data;
    }, 
    display_rworkbooks(state, data) {
        state.display_rworkbooks = data;
    },

   
};

const actions = {
   
    dashboard_admin ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/dashboard_admin')
                .then((response) => {
                    console.log('dashboard_admin',response.data);
                    commit('dashboard_admin', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    date ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/date')
                .then((response) => {
                    console.log('date',response.data);
                    commit('date', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    dashboard_acma ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/dashboard_acma')
                .then((response) => {
                    console.log('dashboard_acma',response.data);
                    commit('dashboard_acma', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    display_joborders ({commit},data) {
        console.log(data)
        return new Promise ((resolve, reject) => {
            axios.post('/api/display_joborders',{
                status: data.jo_status,
                search: data.search})
                .then((response) => {
                    console.log('display_joborders',response.data);
                    commit('display_joborders', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    dashboard_emp ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/dashboard_emp')
                .then((response) => {
                    console.log('dashboard_emp',response.data);
                    commit('dashboard_emp', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    reminder_tasks ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/reminder_tasks')
                .then((response) => {
                    console.log('reminder_tasks',response.data);
                    commit('reminder_tasks', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    dashboard_client ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/dashboard_client')
                .then((response) => {
                    console.log('dashboard_client',response.data);
                    commit('dashboard_client', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
   overdued_tasks ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/overdued_tasks')
                .then((response) => {
                    console.log('overdued_tasks',response.data);
                    commit('overdued_tasks', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    display_messages ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/display_messages')
                .then((response) => {
                    console.log('dismess',response.data);
                    commit('display_messages', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    display_notifs ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/display_notifs')
                .then((response) => {
                    console.log('disnotifs',response.data);
                    commit('display_notifs', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    display_urworkbooks ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/display_urworkbooks')
                .then((response) => {
                    console.log('ur',response.data);
                    commit('display_urworkbooks', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    display_rworkbooks ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/display_rworkbooks')
                .then((response) => {
                    console.log('r',response.data);
                    commit('display_rworkbooks', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
  

   

    
};

export default {
    state,
    getters,
    mutations,
    actions 
}
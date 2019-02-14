const state = {
    workbooks: []
};

const getters = {
    getWorkbookList: state => {
        return state.workbooks;
    }
};

const mutations = {
    newWorkbook(state, data) {
        state.workbooks.push(data);
    },
    setWorkbooks(state, data) {
        state.workbooks = data;
    }
};

const actions = {
    newWorkbook({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/newWorkbook', data)
                .then((response) => {
                    // console.log(response);
                    commit('newWorkbook', response.data);
                    resolve()
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },

    onCreateWorkbook({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/onCreateWorkbook')
                .then((response) => {
                    // console.log(response);
                    commit('setBrands', response.data.brands);
                    resolve();
                })
                .catch((error) => {
                    console.error(error);
                    reject();
                })
        })
    },

    getWorkbooks({commit}, data) {
        axios.post('/api/getAllWorkbooks', data)
            .then(response => {
                // console.log(response);
                commit('setWorkbooks', response.data)
            })
            .catch(error => {
                console.error(error);
                
            })
    }
};

export default {
    state,
    getters,
    mutations,
    actions 
}
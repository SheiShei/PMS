const state = {
    workbooks: [],
    cWorkbook: ''
};

const getters = {
    getWorkbookList: state => {
        return state.workbooks;
    },
    getCWorkbook: state => {
        return state.cWorkbook
    }
};

const mutations = {
    newWorkbook(state, data) {
        state.workbooks.push(data);
    },
    setWorkbooks(state, data) {
        state.workbooks = data;
    },
    setCWorkbook(state, id) {
        var index = _.findIndex(state.workbooks, {id: id});
        state.cWorkbook = state.workbooks[index]
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
        return new Promise ((resolve, reject) => {
            axios.post('/api/getAllWorkbooks', data)
                .then(response => {
                    console.log(response.data);
                    commit('setWorkbooks', response.data)
                    resolve()
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },

    getCWorkbook({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/getCWorkbook',{
                id: data})
            .then((response) => {
                console.log('workbook.js',response);
                resolve(response);
            })
            .catch((error) => {
                console.error(error);
                
            })
        })
    },

    reviewWB({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.patch('/api/reviewWB', data)
                .then(response => {
                    console.log(response);
                    resolve()
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },
    UpdateWorkbook({commit}, data) {
        const config = { headers : {'Content-Type': 'multipart/form-data'} }
        return new Promise ((resolve, reject) => {
            axios.post('/api/UpdateWorkbook', data)
                .then((response) => {
                    console.log(response);
                    // commit('newWorkbook', response.data);
                    resolve()
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },
};

export default {
    state,
    getters,
    mutations,
    actions 
}
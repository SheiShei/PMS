const state = {
    brands: '',
    cJO: null,
    jos: []
};

const getters = {
    getBrands: state => {
        return state.brands;
    },

    getCJO: state => {
        return state.cJO;
    },

    getJOs: state => {
        return state.jos;
    }
};

const mutations = {
    setOnCreate(state, data) {
        state.brands = data;
    },

    setCurrentJO(state, data) {
        state.cJO = data;
    },

    setJOs(state, data) {
        state.jos = data;
    },

    deletejo(state, id) {
        var index = _.findIndex(state.jos, {id: id});
        state.jos.splice(index, 1);
    }
};

const actions = {
    onCreate({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/onLoad')
                .then ((response) => {
                    // console.log(response);
                    commit('setOnCreate', response.data);
                    resolve();
                })
                .catch ((error) => {
                    console.log(error);
                    reject();
                })
        }) 
    },
    newJOC ({commit}, data) {
        const config = { headers : {'Content-Type': 'multipart/form-data'} }
        return new Promise ((resolve, reject) => {
            axios.post('/api/newJobOrderCreative', data, config)
            .then ((response) => {
                // console.log(response);
                resolve(response)
            })
            .catch ((error) => {
                console.log(error);
                reject(error)
            }) 
        })
    },
    newJOW ({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/newJobOrderWeb', data)
            .then ((response) => {
                // console.log(response);
                resolve(response)
            })
            .catch ((error) => {
                console.log(error);
                reject(error)
            }) 
        })
    },
    getJoDetails({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/getJoDetails', {id: id})
                .then ((response) => {
                    // console.log(response);
                    commit('setCurrentJO', response.data.jobor);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    
                })
        })
    },
    updateJOC ({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/updateJobOrderCreative', data)
                .then ((response) => {
                    // console.log(response);
                    resolve(response);
                })
                .catch ((error) => {
                    console.log(error);
                    if(error.response.status == 401){
                        reject(error);
                    }
                })
        }) 
    },
    updateJOW ({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/updateJobOrderWeb', data)
                .then ((response) => {
                    // console.log(response);
                    resolve(response)
                })
                .catch ((error) => {
                    console.log(error.response);
                    if(error.response.status == 401){
                        reject(error.response.data.type);
                    }
                }) 
        })
    },
    getJobOrders ({commit}, data) {
        // console.log(data)
        axios.get('/api/getJobOrders', {params: {
            search: data.search,
            sort: data.sort,
            notArchive: data.notArchive,
            brand: data.brand
        }})
            .then ((response) => {
                 console.log(response.data);
                commit('setJOs', response.data);
            })
            .catch ((error) => {
                console.log(error);
                
            }) 
    },

    deleteJO({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/deletejo', { 
                data: { id: id}
            })
                .then((response) => {
                    // console.log(response.data);
                     commit('deletejo', id);
                     resolve(response);
                })

                .catch((error) => {
                    console.log(error);
                    
                })
        });
    },

    restoreJO({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.post('/api/restorejo', { 
                data: { id: id}
            })
                .then((response) => {
                    // console.log(response.data);
                    commit('deletejo',id);
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

    creativeSignOff({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/finishJOC', data)
                .then ((response) => {
                    // console.log(response);
                    resolve(response)
                })
                .catch(error => {
                    console.log(error);
                    // reject(error)
                    // console.log(error.response);
                    if(error.response.status == 401){
                        reject(error.response.data.type);
                    }
                })
        })
    },

    webSignOff({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/finishJOW', data)
                .then ((response) => {
                    // console.log(response);
                    resolve(response)
                })
                .catch(error => {
                    console.log(error);
                    // reject(error)
                    // console.log(error.response);
                    if(error.response.status == 401){
                        // reject(error.response.data.type);
                        reject(error.response.data.type);
                        
                    }
                })
        })
    }
};

export default {
    state,
    getters,
    mutations,
    actions 
}
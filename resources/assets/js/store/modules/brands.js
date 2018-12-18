const state = {
    brands: [],
    tandems: [],
    brandJOs: []
};

const getters = {
    brandsList: state => {
        return state.brands;
       
    },

    getTandemsList: state => {
        return state.tandems;
    },

    getBrandJOs: state => {
        return state.brandJOs;
    }
    
};

const mutations = {
    setBrands (state, brands) {
        state.brands = brands;
    },

    addBrand (state, brand) {
        state.brands.unshift(brand);
    },

    deleteBrand (state, id) {
        var index = _.findIndex(state.brands, {id: id});
        state.brands.splice(index, 1);
    },

    getTandemsList (state, data) {
        state.tandems = data;
    },

    setBrandJOs (state, data) {
        state.brandJOs = data;
    },

    deleteBrandJo (state, id) {
        var index = _.findIndex(state.brandJOs, {id: id});
        state.brandJOs.splice(index, 1);
    }
};

const actions = {
    
    setBrands({commit}, databrands) {
        // console.log(databrands.data)
        return new Promise ((resolve, reject) => {
            axios.post(databrands.url, {
                filterposition: databrands.data.filter.position,
                filtercategory: databrands.data.filter.category,
                search: databrands.data.search,
                notArchive: databrands.data.notArchive,
                id: databrands.data.id
                
            })
            
                .then((response) => {
                    // console.log(response.data.data);
                    commit('setBrands', response.data.data)
                    resolve(response);
                })
                .catch((error) => {
                    //console.log(error);
                    alert('Something went wrong, try reloading the page');
                });
        })
    },

    getTandemsList({commit}) {
        axios.get('/api/getTandemsList')
            .then((response) => {
                // console.log(response);
                commit('getTandemsList', response.data);
            })
            .catch((error) => {
                console.log(error);
                
            })
    },

    addBrand({commit}, databrand) {
        let credentials = {
            name: databrand.name,
            contact_person: databrand.contact_person,
            telephone: databrand.telephone,
            mobile: databrand.mobile,
            tandem_id: databrand.tandem_id,
            logo: databrand.logo,
            about: databrand.about

        }
            // console.log(credentials);
            // console.log(databrand.logo);
            return new Promise((resolve, reject) => {
                axios.post('/api/addbrands', credentials)

                    .then((response) => {
                        //console.log(response);
                        commit('addBrand', response.data[0]);
                        resolve(response);
                    })

                    .catch((error) => {
                        if(error.response.status == 422){
                            //console.log(error.response.data);
                            reject(error.response.databrand.errors);
                        }
                    })
            });
    },
    deleteBrand({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/deletebrands', { 
                data: { id: id}
            })
                .then((response) => {
                    // console.log(response);
                    commit('deleteBrand', id);
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

    restoreBrand({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.post('/api/restorebrands', { 
                data: { id: id}
            })
                .then((response) => {
                    // console.log(response);
                    commit('deleteBrand', id);
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

    brandJos({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/getBrandJos', data)
                .then ((response) => {
                    // console.log(response);
                    commit('setBrandJOs', response.data)
                    resolve(response.data)
                })
                .catch ((error) => {
                    console.log(error);
                    
                })
        })
    },

    deleteBrandJo({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.delete('/api/deletejo', {
                data: { id: id}
            })
                .then (response => {
                    commit('deleteBrandJo', id);
                    resolve(response);
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
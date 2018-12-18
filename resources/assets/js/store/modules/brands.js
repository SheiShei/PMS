const state = {
    brands: [],
    tandems: [],
    brandJOs: [],
    Onebrand: ''
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
    },
    
    getOnebrand: state => {
        return state.Onebrand;
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
    },

    getOnebrand (state, data) {
        state.Onebrand = data;
    },
    
    UpdateBrand (state, brand) {
        var index = _.findIndex(state.brands, {id: brand.id});
        state.brands[index] = brand;
        
    },
};

const actions = {
    
    setBrands({commit}, databrands) {
        // console.log(databrands.data)
        axios.post(databrands.url, {
            filterposition: databrands.data.filter.position,
            filtercategory: databrands.data.filter.category,
            search: databrands.data.search,
            notArchive: databrands.data.notArchive
        })
        
            .then((response) => {
                // console.log(response.data.data);
                commit('setBrands', response.data.data)
                
            })
    },

    getOnebrand({commit}, id) {
        //console.log(id)
        return new Promise ((resolve, reject) => {
            axios.post('/api/getOnebrand', {
                id: id
            })
                .then((response) => {
                    // console.log(response);
                    commit('getOnebrand', response.data)
                    resolve(response.data)
                })
                .catch((error) => {
                   // console.log(error);
                    alert('Something went wrong, try reloading the page');
                    reject(error);
                });
        })
    },

    getTandemsList({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/getTandemsList')
                .then((response) => {
                    // console.log(response);
                    commit('getTandemsList', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },

    addBrand({commit}, databrand) {
        const config = { headers : {'Content-Type': 'multipart/form-data'} }
        return new Promise((resolve, reject) => {
            axios.post('/api/addbrands', databrand, config)

                .then((response) => {
                    // console.log(response);
                    commit('addBrand', response.data[0]);
                    resolve(response);
                })

                .catch((error) => {
                    if(error.response.status == 422){
                        console.log(error.response.data);
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
                        //console.log(error);
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
                    reject(error);
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
                .catch (error => {
                    console.log(error);
                    reject(error);
                })
        })
    },

    UpdateBrand({commit}, databrand) {
        const config = { headers : {'Content-Type': 'multipart/form-data'} }
        return new Promise((resolve, reject) => {
            axios.post('/api/UpdateBrand', databrand, config)
                .then((response) => {
                    // console.log(response);
                    commit('UpdateBrand', response.data[0]);
                    resolve(response);
                })
                .catch((error) => {
                    //if(error.response.status == 422){
                        console.log(error);
                        reject(error);
                    }
                )
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions 
}
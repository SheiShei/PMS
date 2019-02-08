const state = {
    getuser_info: ''
};

const getters = {
    getuser_info: state => {
        return state.getuser_info;
    },

};

const mutations = {
    getuser_info(state, data) {
        state.getuser_info = data;
    },
    updatemyself (state, user) {
        var index = _.findIndex(state.getuser_info, {id: user.id});
        state.getuser_info[index] = user;  
    },

   
};

const actions = {
   
    getuser_info ({commit}) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/getuser_info')
                .then((response) => {
                    console.log(response.data);
                    commit('getuser_info', response.data);
                    resolve(response.data)
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        })
    },
    updatemyself({commit}, data) {
        // let credentials = {
        //     id: data.id,
        //     name: data.name,
        //     email: data.email,
        //     password: data.password,
        // }
        //  console.log(data.values);
        //  console.log(data.data);
        const config = { headers : {'Content-Type': 'multipart/form-data'} }
            return new Promise((resolve, reject) => {
                axios.post('/api/updatemyself', data, config)
                    .then((response) => {
                         console.log(response.data);
                        commit('updatemyself', response.data);
                        resolve(response);
                    })

                    .catch((error) => {
                        // if(error.response.status == 422){
                             console.log(error);
                            reject(error);
                   //     }
                    })
            });
    },
  

   

    
};

export default {
    state,
    getters,
    mutations,
    actions 
}
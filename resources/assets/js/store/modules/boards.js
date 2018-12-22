const state = {
    
};

const getters = {
    
};

const mutations = {

};

const actions = {
    createBoard({commit}, data) {
        axios.post('/api/newBoard', data) 
            .then((response) => {
                console.log(response);
                
            })
            .catch((error) => {
                console.log(error);
                
            })
    }
};

export default {
    state,
    getters,
    mutations,
    actions 
}
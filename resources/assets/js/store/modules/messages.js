const state = {
    conversations: []
};

const getters = {
    conversationsList: state => {
        return state.conversations;
    }
};

const mutations = {
    setConvos(state, data) {
        state.conversations = data
    }
};

const actions = {
    getAllConvo({commit}, data) {
        // return new Promise ((resolve, reject) => {
            axios.post('/api/getConvoList', {search : data})
                .then((response) => {
                    commit('setConvos', response.data);
                })
                .catch((error) => {
                    console.log(error);
                })
        // })
    }
    
};

export default {
    state,
    getters,
    mutations,
    actions 
}
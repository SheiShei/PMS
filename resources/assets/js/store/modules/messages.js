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
    },

    addConvo(state, data) {
        state.conversations.push(data);
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
    },

    addConvo({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/addconversation', {
                name: data.name,
                ids: data.ids
            })
                .then ((response) => {
                    // console.log(response);
                    commit('addConvo', response.data);
                })
                .catch((error) => {
                    console.log(error);
                    
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
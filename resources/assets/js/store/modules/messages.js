const state = {
    conversations: [],
    convoUsers: [],
    selectedConvo: null,
    receiverData: null,
    notMembers:[],
    messages: []
};

const getters = {
    conversationsList: state => {
        return state.conversations;
    },

    getConvoUsers: state => {
        return state.convoUsers;
    },

    getSelectedConvo: state => {
        return state.selectedConvo;
    },

    getReceiverData: state => {
        return state.receiverData;
    },

    getNotMembers: state => {
        return state.notMembers;
    },

    getConvoMessages: state => {
        return state.messages;
    },
};

const mutations = {
    setConvos(state, data) {
        state.conversations = data
    },

    addConvo(state, data) {
        state.conversations.push(data);
    },

    getConvoUsers(state, data) {
        state.convoUsers = data.users;
        state.selectedConvo = data.convo;
        state.receiverData = data.receiver;
        
    },

    getNotMembers(state, data) {
        state.notMembers = data
    },

    setConvoMessages(state, data) {
        state.messages = data.data;
    },

    newMessage(state, data) {
        state.messages.push(data);
    },

    leaveConvo(state, data) {
        var index = _.findIndex(state.conversations, {id: data});
        state.conversations.splice(index, 1);
    },

    messageDestroy(state) {
        state.convoUsers = [];
        state.selectedConvo = null;
        state.receiverData = null;
        state.notMembers =[];
        state.messages = [];
    },

    insertLoadMessage(state, data) {
        state.messages.unshift(data);
    },

    sendFiles(state, data) {
        data.forEach(file => {
            state.messages.push(file)
        });
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
                    // commit('addConvo', response.data);
                })
                .catch((error) => {
                    alert('something went wrong, please reload and try again.')
                    console.log(error);
                })
        })
    },

    getConvoUsers({commit}, data) {
        axios.post('/api/getConvoUsers', {
            slug: data
        })
            .then ((response) => {
                // console.log(response);
                commit('getConvoUsers', response.data);
            })
            .catch ((error) => {
                console.log(error);
                
            })
    },

    getNotMembers({commit}, data) {
        axios.post('/api/getNotMembers', {
            slug: data.slug,
            search: data.search
        })
            .then( (response) => {
                // console.log(response);
                commit('getNotMembers', response.data);
            })
            .catch( (error) => {
                console.log(error);
                
            })
    },

    addConvoMember({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/addConvoMember', {
                slug: data.slug,
                ids: data.ids
            })
                .then( (response) => {
                    // console.log(response);
                    commit('sendFiles', response.data);
                    resolve(response);
                })
                .catch( (error) => {
                    console.log(error);
                    reject(error);
                })
        })
    },

    removeMember({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.delete('/api/removeMember', { 
                data: {
                    slug: data.slug,
                    ids: data.ids
                }
            })
                .then( (response) => {
                    // console.log(response);
                    commit('sendFiles', response.data);
                    resolve(response);
                })
                .catch( (error) => {
                    console.log(error);
                    reject(error);
                })
        })
    },

    getMessages({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.get('/api/getConvoMessages', { params: {
                slug: data
            }
            })
                .then((response) => {
                    // console.log(response);
                    commit('setConvoMessages', response.data);
                    resolve(response.data);
                })
                .catch((error) => {
                    console.log(error);
                    
                })
        })
    },

    sendMessage({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/newMessage', {
                text: data.text,
                convo: data.convo,
                receiver: data.receiver,
            })
                .then((response) => {
                    // console.log(response);
                    commit('newMessage', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                })
        })
    },

    sendFiles({commit}, data) {
        const config = { headers: { 'Content-Type': 'multipart/form-data' } };
        return new Promise ((resolve, reject) => {
            axios.post('/api/sendFiles', data, config)
                .then((response) => {
                    // console.log(response);
                    commit('sendFiles', response.data);
                    resolve(response);

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
const state = {
    boards: [],
    boardLists: []
};

const getters = {
    userBoards: state => {
        return state.boards;
    },
    boardLists: state => {
        return state.boardLists
    }
};

const mutations = {
    setUserBoards(state, data) {
        state.boards = data;
    },

    addBoard(state, data) {
        state.boards.unshift(data)
    },

    createList(state, data) {
        state.boardLists.push(data)
    },

    updateList(state, data) {
        var index = _.findIndex(state.boardLists, {id: data.id});
        state.boardLists[index].name = data.name;
    },

    setBoardLists(state, data) {
        state.boardLists = data
    },

    deleteList(state, id) {
        var index = _.findIndex(state.boardLists, {id: id});
        state.boardLists.splice(index, 1);
    },

    updateOrder(state, data) {
        data.map((list, index) => {
            list.order = index + 1;
        });
        state.boardLists = data
    }
};

const actions = {
    createBoard({commit}, data) {
        axios.post('/api/newBoard', data) 
            .then((response) => {
                // console.log(response);
                commit('addBoard', response.data)
                
            })
            .catch((error) => {
                console.log(error);
                
            })
    },

    getUserBoards({commit}, data) {
        axios.post('/api/getUserBoards', data)
            .then(response => {
                // console.log(response);
                commit('setUserBoards', response.data)
            })
            .catch(error => {
                console.log(error);
                
            })
    },

    deleteBoard({commit}, id) {
        axios.delete('/api/deleteBoard', {data: {
            id:id
        }})
            .then(() => {
                alert('success')
            })
    },

    createList({commit}, data) {
        axios.post('/api/createList', data)
            .then(response => {
                // console.log(response);
                commit('createList', response.data)
            })
            .catch(error => {
                console.error(error);
                
            })
    },

    updateList({commit}, credentials){
        return new Promise ((resolve) => {
            axios.patch('/api/updateList', credentials)
                .then(response => {
                    // console.log(response);
                    commit('updateList', response.data)
                    resolve()
                })
                .catch(error => {
                    console.error(error);
                    
                })
        })
    },

    getBoardLists({commit}, id) {
        axios.post('/api/getBoardLists', {id: id})
            .then(response => {
                // console.log(response);
                commit('setBoardLists', response.data)
            })
            .catch(error => {
                console.error(error);
                
            })
    },

    deleteList({commit}, id) {
        axios.delete('/api/deleteList', {data: {
            id: id
        }} )
            .then(() => {
                // console.log(response);
                commit('deleteList', id)
            })
    },

    updateListOrder({commit}, data) {
        axios.patch('/api/updateListOrder', data)
            .then(() => {
                // console.log(response);
            })
            .catch(error => {
                console.error(error);
            })
    }
}

export default {
    state,
    getters,
    mutations,
    actions 
}
import Vue from 'vue'
import scrum from "./boards/scrum";
const state = {
    boards: [],
    boardLists: [],
    boardMembers: [],
    gImg: null,
    comments: [],
    cBoard: null,
    tasks: []
};

const getters = {
    userBoards: state => {
        return state.boards;
    },
    boardLists: state => {
        return state.boardLists
    },
    boardMembers: state => {
        return state.boardMembers
    },
    getGImg: state => {
        return state.gImg;
    },
    getTCom: state => {
        return state.comments;
    },
    getCBoard: state => {
        return state.cBoard
    },
    getWorkload: state => {
        return state.tasks
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
    },

    setBoardMembers(state, data) {
        state.boardMembers = data;
    },

    addListTask(state, data) {
        var index = _.findIndex(state.boardLists, {id: Number(data.card_id)});
        state.boardLists[index].tasks.unshift(data);
    },

    updateTask(state, data) {
        var listIndex = _.findIndex(state.boardLists, {id: Number(data.card_id)});
        var taskIndex = _.findIndex(state.boardLists[listIndex].tasks, {id: data.id});
        // state.boardLists[listIndex].tasks[taskIndex] = data; ---> NOT REACTIVE
        //Vue.set(target, key, value)
        Vue.set(state.boardLists[listIndex].tasks, taskIndex, data); // ---> REACTIVE
    },

    deleteTask(state, data) {
        var listIndex = _.findIndex(state.boardLists, {id: Number(data.card_id)});
        var taskIndex = _.findIndex(state.boardLists[listIndex].tasks, {id: data.id});
        state.boardLists[listIndex].tasks.splice(taskIndex, 1);
    },

    mapListUpdateOrder(state, data) {
        state.boardLists[data.list_index].tasks.map((task, ind) => {
            task.order = ind+1;
            task.card_id = data.list_id
        })
    },

    setGImg(state, data) {
        state.gImg = data;
    },

    setTaskComments(state, data) {
        state.comments = data;
    },

    sendComment(state, data) {
        data.forEach(comment => {
            state.comments.push(comment)
        });
    },

    setCBoard(state, data) {
        state.cBoard = data
    },

    boardDestroyed(state) {
        state.boardLists = [];
        state.boardMembers = [];
        state.comments = [];
    },

    deleteBoard(state, data) {
        let index = _.findIndex(state.boards, {id: data})
        state.boards.splice(index, 1);
    },

    uBoard(state, data) {
        let index = _.findIndex(state.boards, {id: data.id})
        Vue.set(state.boards, index, data);
    }
};

const actions = {
    createBoard({commit}, data) {
        return new Promise((resolve, reject) => {
            axios.post('/api/newBoard', data) 
                .then((response) => {
                    // console.log(response);
                    commit('addBoard', response.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                    reject()
                })
        })
    },

    getUserBoards({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/getUserBoards', data)
            .then(response => {
                // console.log(response);
                commit('setUserBoards', response.data)
                resolve();
            })
            .catch(error => {
                console.log(error);
                reject();
            })
        })
    },

    deleteBoard({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/deleteBoard', {data: {
                id:id
            }})
                .then(() => {
                    commit('deleteBoard', id)
                    resolve()
                })
                .catch((error) => {
                    console.error(error);
                    reject()
                })
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
        return new Promise ((resolve, reject) => {
            axios.delete('/api/deleteList', {data: {
                id: id
            }} )
                .then(() => {
                    // console.log(response);
                    commit('deleteList', id)
                    resolve()
                })
                .catch(error => {
                    // console.error(error);
                    reject()
                    alert('No Internet')
                })
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
    },

    getBoardMembers({commit}, id) {
        axios.post('/api/getBoardMembers', {board_id: id})
            .then((response) => {
                // console.log(response);
                commit('setBoardMembers', response.data)
            })
            .catch((error) => {
                console.error(error);
                
            })
    },

    addTask({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/addTask', data) 
                .then((response) => {
                    // console.log(response);
                    commit('addListTask', response.data);
                    resolve();
                })
                .catch((error) => {
                    // console.error(error);
                    reject();
                    alert('No Internet')
                })
        })
    },

    updateTask({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.patch('/api/updateTask', data)
                .then(response => {
                    // console.log(response);
                    commit('updateTask', response.data);
                    resolve(response.data)
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },
    
    addAttachment({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/addAttachment', data)
                .then(response => {
                    // console.log(response);
                    resolve(response.data)
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },

    deleteTask({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.delete('/api/deleteTask', {data: id})
                .then(response => {
                    // console.log(response);
                    commit('deleteTask', response.data)
                    resolve()
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },

    updateTaskOrder({commit}, data) {
        axios.patch('/api/updateTaskOrder', data)
            .then(() => {
                // console.log(response);
                
            })
            .catch(error => {
                console.error(error);
                
            })
    },

    sendComment({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/sendComment', data)
                .then((response) => {
                    // console.log(response);
                    commit('sendComment', response.data)
                    resolve()
                })
                .catch(error => {
                    console.error(error);
                    
                })
        })
    },

    getComments({commit}, data) {
        axios.post('/api/getComments', {id: data})
            .then((response) => {
                // console.log(response);
                commit('setTaskComments', response.data)
            })
            .catch(error => {
                console.error(error);
                
            })
    },

    getCBoard({commit}, data) {
        axios.post('/api/getCBoard', {id: data})
            .then((response) => {
                // console.log(response);
                commit('setCBoard', response.data)
            })
            .catch(error => {
                console.error(error);
                
            })
    },

    uBoard({commit}, data) {
        return new Promise((resolve, reject) => {
            axios.patch('/api/uBoard', data)     
                .then((response) => {
                    // console.log(response);
                    commit('uBoard', response.data);
                    resolve();
                })
                .catch((error) => {
                    console.error(error);
                    reject();
                })
        })
    }
}

const modules = {
    scrum
}

export default {
    state,
    getters,
    mutations,
    actions,
    modules 
}
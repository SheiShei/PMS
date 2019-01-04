import Vue from 'vue'
const state = {
    scrumLists: null,
    sprintTasks: null,
    cSprint: null
};

const getters = {
    getScrumLists: state => {
        return state.scrumLists;
    },

    getSprintTasks: state => {
        return state.sprintTasks;
    },
    
    getSprint: state => {
        return state.cSprint;
    }
};

const mutations = {
    setScrumLists(state, data) {
        state.scrumLists = data
    },

    addsprint(state, data) {
        state.scrumLists.push(data);
    },

    updateSprint(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data.id});
        // Vue.set(state.scrumLists, index, data);
        state.scrumLists[index].name = data.name;
    },

    finishSprint(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data.id});
        // Vue.set(state.scrumLists, index, data);
        state.scrumLists[index].finished_at = data.finished_at;
    },

    deleteSprint(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data.id});
        state.scrumLists.splice(index, 1);
    },

    addSprintTask(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data.sprint_id});
        state.scrumLists[index].tasks.push(data);
    },

    mapSprintUpdateOrder(state, id) {
        let index = _.findIndex(state.scrumLists, {id: id});
        state.scrumLists[index].tasks.map((task, ind) => {
            task.order = ind+1;
            task.sprint_id = id
        })
    },

    deleteSprintTask(state, data) {
        var listIndex = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var taskIndex = _.findIndex(state.scrumLists[listIndex].tasks, {id: data.id});
        state.scrumLists[listIndex].tasks.splice(taskIndex, 1);
    },

    updateSprintTask(state, data) {
        var listIndex = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var taskIndex = _.findIndex(state.scrumLists[listIndex].tasks, {id: data.id});
        // state.boardLists[listIndex].tasks[taskIndex] = data; ---> NOT REACTIVE
        //Vue.set(target, key, value)
        Vue.set(state.scrumLists[listIndex].tasks, taskIndex, data); // ---> REACTIVE
    },
    
    getSprintTasks(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data});
        state.sprintTasks = state.scrumLists[index].tasks;
    },
    
    getSprint(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data});
        state.cSprint = state.scrumLists[index];
    },

    updateTaskStatusOrder(state, datas) {
        let data = datas.data;

        data.forEach((list, index) => {
            list.status_order = index + 1;
            list.status = datas.status;

            let i = _.findIndex(state.sprintTasks, {id: list.id})

            Vue.set(state.sprintTasks, i, list);
        });

        console.log(state.sprintTasks);
        
    },

    scrumBoardDestroyed() {
        state.sprintTasks = null;
        state.cSprint = null; 
    },
};

const actions = {
    getScrumLists({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/getScrumLists', {id: data})
                .then((response) => {
                    console.log(response);
                    commit('setScrumLists', response.data)
                    resolve()
                })
                .catch((error) => {
                    console.error(error);
                    
                })
        })
    },

    addsprint({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/addsprint', data)
                .then((response) => {
                    // console.log(response);
                    commit('addsprint', response.data);
                    resolve();
                })
                .catch((error) => {
                    console.error(error);
                    reject();
                })
        })
    },

    updateSprint({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.patch('/api/updateSprint', data) 
                .then(response => {
                    // console.log(response);
                    commit('updateSprint', response.data);
                    resolve();
                })
                .catch(error => {
                    console.error(error);
                    reject();
                })
        })
    },

    deleteSprint({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.delete('/api/deleteSprint', {data: {id: id}}) 
                .then(response => {
                    console.log(response);
                    commit('deleteSprint', response.data);
                    resolve();
                })
                .catch(error => {
                    console.error(error);
                    reject();
                })
        })
    },

    addSprintTask({commit}, data) {
        return new Promise((resolve, reject) => {
            axios.post('/api/addSprintTask', data) 
                .then(response => {
                    // console.log(response);
                    commit('addSprintTask', response.data);
                    resolve();
                })
                .catch(error => {
                    console.error(error);
                    reject();
                })
        })
    },

    updateSprintOrder({commit}, data) {
        axios.patch('/api/updateSprintOrder', data)
            .then((response) => {
                console.log(response);
                
            })
            .catch((error) => {
                console.error(error);
                
            })
    },

    deleteSprintTask({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.delete('/api/deleteTask', {data: id})
                .then(response => {
                    // console.log(response);
                    commit('deleteSprintTask', response.data);
                    resolve();
                })
                .catch(error => {
                    console.error(error);
                    reject();
                })
        })
    },

    updateSprintTask({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.patch('/api/updateTask', data)
                .then(response => {
                    // console.log(response);
                    commit('updateSprintTask', response.data);
                    resolve(response.data)
                })
                .catch(error => {
                    console.error(error);
                    reject()
                })
        })
    },

    getSprintTasks({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/getSprintTasks', {id: data})
                .then((response) => {
                    // console.log(response);
                    commit('setScrumLists', response.data)
                    resolve()
                })
                .catch((error) => {
                    console.error(error);
                    
                })
        })
    },

    updateSprintTaskOrder({commit}, data) {
        axios.patch('/api/updateSprintTaskOrder', data) 
            .then(() => {
                // console.log(response);
            })
            .catch(error => {
                console.error(error);
                
            })
    },

    finishSprint({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.patch('/api/finishSprint', {id: id})
                .then((response) => {
                    // console.log(response);
                    commit('setScrumLists', response.data);
                    resolve();
                })
                .catch((error) => {
                    console.error(error);
                    reject()
                })
        })
    },

};

export default {
    state,
    getters,
    mutations,
    actions 
}
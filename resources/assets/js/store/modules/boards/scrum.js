import Vue from 'vue'
const state = {
    scrumLists: null,
    sprintTasks: [],
    cSprint: null,
    cUSdata: null
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
    },

    getCusData: state => {
        return state.cUSdata;
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

    deleteSprint(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data.id});
        state.scrumLists.splice(index, 1);
    },

    addSprintTask(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data.sprint_id});
        state.scrumLists[index].tasks.push(data);
    },

    mapSprintUSOrder(state, id) {
        let index = _.findIndex(state.scrumLists, {id: id});
        state.scrumLists[index].us.map((us, ind) => {
            us.order = ind+1;
            us.sprint_id = id
        })
    },

    deleteSprintTask(state, data) {
        var listIndex = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var usIndex = _.findIndex(state.scrumLists[listIndex].us, {id: Number(data.us_id)});
        var taskIndex = _.findIndex(state.scrumLists[listIndex].us[usIndex].tasks, {id: data.id});
        state.scrumLists[listIndex].us[usIndex].tasks.splice(taskIndex, 1);
    },

    updateSprintTask(state, data) {
        var listIndex = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var usIndex = _.findIndex(state.scrumLists[listIndex].us, {id: Number(data.us_id)});
        var taskIndex = _.findIndex(state.scrumLists[listIndex].us[usIndex].tasks, {id: data.id});
        // state.boardLists[listIndex].tasks[taskIndex] = data; ---> NOT REACTIVE
        //Vue.set(target, key, value)
        Vue.set(state.scrumLists[listIndex].us[usIndex].tasks, taskIndex, data); // ---> REACTIVE
    },
    
    getSprintTasks(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data});
        // state.sprintTasks = state.scrumLists[index].tasks;
        state.scrumLists[index].us.forEach(ust => {
            ust.tasks.forEach(task => {
                state.sprintTasks.push(task);
            });
        });
    },
    
    getSprint(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data});
        state.cSprint = state.scrumLists[index];
    },

    updateTaskStatusOrder(state, datas) {
        // console.log(datas);
        
        let data = datas.data;

        data.forEach((list, index) => {
            list.order = index + 1;
            list.status = datas.status;
            list.us_id = datas.us

            let i = _.findIndex(state.sprintTasks, {id: list.id})

            Vue.set(state.sprintTasks, i, list);
        });

        // console.log(state.sprintTasks);
        
    },

    mapUSTOrder(state, data) {
        // state.boardLists[data.list_index].tasks.map((task, ind) => {
        //     task.order = ind+1;
        //     task.card_id = data.list_id
        // })
        // console.log(data);

        var sprintIndex = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var usIndex = _.findIndex(state.scrumLists[sprintIndex].us, {id: Number(data.us_id)});
        
        if(data.e.added) {
            // var newUSIndex = _.findIndex(state.scrumLists[sprintIndex].us, {id: Number(data.e.added.element.us_id)});
            // state.scrumLists[sprintIndex].us[usIndex].tasks.push(data.e.added.element);
            if(data.us_id == data.e.added.element.us_id)
                state.scrumLists[sprintIndex].us[usIndex].tasks.push(data.e.added.element);
            var taskIndex = _.findIndex(state.scrumLists[sprintIndex].us[usIndex].tasks, {id: data.e.added.element.id})
            // console.log(taskIndex);
            state.scrumLists[sprintIndex].us[usIndex].tasks[taskIndex].status = data.status
            state.scrumLists[sprintIndex].us[usIndex].tasks[taskIndex].us_id = data.us_id

        }
        
        state.scrumLists[sprintIndex].us[usIndex].tasks.forEach((task, i) => {
            task.order = i+1;
        });
        
    },

    scrumBoardDestroyed() {
        // state.sprintTasks = null;
        state.cSprint = null; 
    },

    addUS(state, data) {
        let index = _.findIndex(state.scrumLists, {id: data.sprint_id});
        state.scrumLists[index].us.push(data);
    },

    updateUS(state, data) {
        var listIndex = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var usIndex = _.findIndex(state.scrumLists[listIndex].us, {id: data.id});
        // state.boardLists[listIndex].tasks[taskIndex] = data; ---> NOT REACTIVE
        //Vue.set(target, key, value)
        Vue.set(state.scrumLists[listIndex].us, usIndex, data); // ---> REACTIVE
    },

    setCusData(state, data) {
        state.cUSdata = data;
    },

    addCusTask(state, data) {
        state.cUSdata.tasks.push(data);
    },

    deleteCusTask(state, data) {
        var taskIndex = _.findIndex(state.cUSdata.tasks, {id: data.id});
        state.cUSdata.tasks.splice(taskIndex,1)
    },

    updateCusTask(state, data) {
        var taskIndex = _.findIndex(state.cUSdata.tasks, {id: data.id});
        // state.cUSdata.tasks[]
        //Vue.set(target, key, value)
        Vue.set(state.cUSdata.tasks, taskIndex, data); // ---> REACTIVE
    },

    deleteUS(state, data) {
        var sprint_index = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var us_index = _.findIndex(state.scrumLists[sprint_index].us, {id: data.id});
        state.scrumLists[sprint_index].us.splice(us_index, 1);
    },

    addUSSprintTask(state,data) {
        var sprint_index = _.findIndex(state.scrumLists, {id: data.sprint_id});
        var us_index = _.findIndex(state.scrumLists[sprint_index].us, {id: Number(data.us_id)});
        // Vue.set(state.scrumLists[sprint_index].us, us_index, data);
        state.scrumLists[sprint_index].us[us_index].tasks.push(data);
    }
};

const actions = {
    getScrumLists({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/getScrumLists', {id: data})
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
                    // console.log(response);
                    commit('setScrumLists', response.data);
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
                    // commit('addSprintTask', response.data);
                    resolve(response.data);
                })
                .catch(error => {
                    console.error(error);
                    reject();
                })
        })
    },

    updateSprintOrder({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.patch('/api/updateSprintOrder', data)
            .then(() => {
                // console.log(response);
                resolve()
            })
            .catch((error) => {
                console.error(error);
                reject()
            })
        })
    },

    deleteSprintTask({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.delete('/api/deleteTask', {data: id})
                .then(response => {
                    // console.log(response);
                    // commit('deleteSprintTask', response.data);
                    resolve(response.data);
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
                    // commit('updateSprintTask', response.data);
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
        return new Promise ((resolve, reject) => {
            axios.patch('/api/updateSprintTaskOrder', data) 
            .then(() => {
                // console.log(response);
                resolve();
            })
            .catch(error => {
                console.error(error);
                reject()
            })
        })
    },

    newUS({commit}, data) {
        return new Promise ((resolve, reject) => {
            axios.post('/api/newUS', data)
                .then((response) => {
                    // console.log(response);
                    commit('addUS', response.data);
                    resolve(response.data);
                })
                .catch((error) => {
                    console.error(error);
                    reject();
                })
        })
    },

    deleteUS({commit}, id) {
        return new Promise ((resolve, reject) => {
            axios.delete('/api/deleteUS', {data: {id: id}})
                .then((response) => {
                    // console.log(response);
                    resolve(response.data);
                })
                .catch((error) => {
                    console.error(error);
                    reject(error)
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
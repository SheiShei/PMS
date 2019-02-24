<template>
    <div class="list-div" :style="ind == 0?'' : 'margin-top: 0px;'">
        <div class="list-head" v-if="ind == 0">
            <div class="list-title" title="Tasks List">
                <b>
                    <span v-if="status.id==1" class="fa fa-circle text-info"></span>
                    <span v-if="status.id==2" class="fa fa-circle text-success"></span> 
                    <span v-if="status.id==3" class="fa fa-circle text-warning"></span> 
                    <span v-if="status.id==4" class="fa fa-circle text-danger"></span> 
                    
                    {{ status.name }}</b>
            </div>
        </div>
        <!-- <div class="list-body"> -->
            <draggable class="list-body" v-model="uStory.tasks" :options="{animation:200, group:'status', disabled: false, draggable: '.not-finished'}" :element="'div'" @change="test($event, status.id, uStory.id)">
                <card-task v-for="(task, index) in uStory.tasks" v-if="task.status == status.id" :key="index" :task="task" :usPermission="usPermission" :taskPermission="taskPermission" :index="index"></card-task>
                <!-- <div class="" v-if="noCard" style="background-color: transparent; height: 5px"></div> -->
            </draggable>
        <!-- </div> -->
    </div>
</template>

<script>
import draggable from 'vuedraggable';
import Task from './Task.vue';
import {mapGetters} from 'vuex';
export default {
    components: {
        draggable,
        cardTask: Task
    },
    props: ['status', 'ind', 'uStory', 'usPermission', 'taskPermission'],
    data() {
        return {
            noCard: true,
            // tasks: [
            //     {name: 'asdad', image: ''},
            //     {name: 'asdad', image: '/images/nightsky3.jpg'}
            // ]
        }
    },
    computed: {
        ...mapGetters({
                alltasks: 'getSprintTasks'
            }),

        sTasks: {
            get() {
                let newTasks = [];
                let tasks = this.alltasks
                let _this = this;
                // console.log(tasks);
                

                if(tasks) {
                    tasks.forEach(task => {
                        if(task.status == _this.status.id && task.us_id == this.uStory.id) {
                            newTasks.push(task);
                        }
                    });
                }

                // console.log(newTasks);
                

                return newTasks;
            },

            set(value) {
                // console.log(value);
                return this.$store.commit('updateTaskStatusOrder', {data: value, status: this.status.id, us: this.us_id})
            }
        },
    },

    methods: {
        test(e, status, us) {
            // console.log(e);
            this.$store.commit('mapUSTOrder', {sprint_id: this.$route.params.sprint_id, us_id: us, status: status, e: e})
            this.$store.dispatch('updateSprintTaskOrder', {sprint_id: this.$route.params.sprint_id  ,tasks: this.uStory.tasks})
                .then(() => {
                    if(e.added){
                        this.monitorTask(e.added.element)
                    }
                })
            
        },

        monitorTask(e) {
            // console.log(e);
            // if(e.status == 4) {
                axios.post('/api/monitorTask', {task: e})
                    .then(response => {
                        console.log(response);
                        
                    })
                    .catch(error => {
                        console.error(error);
                        
                    })
            // }
        }
    }
}
</script>

<style lang="scss" scoped>
    
    .list-edit{
        padding: 5px 8px;
        background-color: whitesmoke;
        display: flex;
        .list-edit-input{
            display: inline-block;
            width: 70%;
            margin-right: 5px;
            input{
                border: 1px solid rgb(158, 158, 158);
                padding: 2px 3px;
                border-radius: 2px;
                border: 1px solid #4CAF50;
                font-size: 12px;
            }
        }
        .list-edit-save{
            display: inline-block;
            width: 20%;
            button.btn-save{
                width: 100%;
                box-shadow: none;
                border: none;
                border-radius: 2px;
                background-color: #4caf50;
                color: white;
                padding: 3px 5px;
                font-size: 11px;
            }
            button.btn-save:focus{
                background-color: #3e9140;
            }
            button.btn-close{
                padding: 3px 5px;
                font-size: 11px;
                margin: 0;
                border-radius: 2px;
            }
            button.btn-close:hover{
                color: rgb(235, 42, 42);
            }
        }
    }
    .list-head{
        background-color: #dcdcdc;
        position: relative;
    }
    .list-title{
        display:inline-block;
        padding: 5px 8px;
        color: rgb(38,38,38);
        width: 50%;
        font-size: 13px;
        font-style: bold;
        overflow-x: hidden;
    }
    .editListBtn{
        display:inline-block ;
        width: 50%;
        text-align: right;
        button{
            background: transparent;
            color: rgb(105, 105, 105);
            padding: 5px 9px;
            border: none;
            box-shadow: none;
            margin: 0;
            border-radius: 50%;
        }
        button:hover{
            background-color: rgb(199, 199, 199);
            color: rgb(92, 92, 92);
            transition: 0.5s;
        }
    }
    .list-body{
        background-color: rgb(234,234,234);
        height: 40vh; 
        overflow-y: auto !important;
        padding: 10px;
    }
    .list-footer{
        background-color: rgb(234,234,234);
    }
    .list-div{
        height: auto;
        width: 300px;
        overflow-y:visible;
        background-color:beige;
        padding: 0;
        
        display: inline-block;
        margin-right: 3px;
        vertical-align:text-top;
    }
    
</style>
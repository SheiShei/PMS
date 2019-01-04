<template>
    <div class="list-div">
        <div class="list-head">
            <div class="list-title" title="Tasks List">
                <b>{{ status.name }}</b>
            </div>
            <div class="editListBtn pull-right">
                <small>{{ statPoints }} pts</small>
                <!-- <button v-if="sprint.type == 2" class="" @click="revert"><span class="fa fa-edit"></span></button>
                <button @click="deleteSprint(sprint.id)" v-if="sprint.type == 2" class=""><span class="fa fa-trash-o"></span></button>
                <button v-if="sprint.type == 2" class=""><span class="fa fa-play fa-sm"></span></button> -->
            </div>
        </div>
        <div class="list-body">
            <draggable v-model="sTasks" :options="{animation:200, group:'status'}" :element="'div'" @change="test">
                <card-task v-for="(task, index) in sTasks" :key="task.id" v-if="task.status == status.id" :task="task" :i="index"></card-task>                
                <div class="" v-if="noCard" style="background-color: transparent; height: 5px"></div>
            </draggable>
        </div>
        <router-link :to="{name: 'sprint_addtask', params: {status_id: status.id}}" class="add-task-btn" href=""><span class="icon-sm icon-add"></span><span>Add task</span></router-link>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
import Task from './CardTask.vue';
import {mapGetters} from 'vuex';
export default {
    components: {
        draggable,
        cardTask : Task
    },
    props: ['status'],
    data() {
        return {
            noCard: true,
            openTaskOpt: false,
        }
    },
    mounted() {
        // let taskdiv = document.querySelector("#statusListDiv");
        // taskdiv.scrollLeft = taskdiv.scrollWidth;
    },
    computed: {
        ...mapGetters({
                tasks: 'getSprintTasks',
                cSprint: 'getSprint',
            }),

        sTasks: {
            get() {
                let newTasks = [];
                let tasks = this.$store.getters.getSprintTasks
                let _this = this;
                // console.log(tasks);
                

                if(tasks) {
                    tasks.forEach(task => {
                        if(task.status == _this.status.id) {
                            newTasks.push(task);
                        }
                    });
                }

                return newTasks;
            },

            set(value) {
                console.log(value);
                return this.$store.commit('updateTaskStatusOrder', {data: value, status: this.status.id})
            }
        },

        statPoints() {
            let tasks = this.$store.getters.getSprintTasks
            let points = 0;
            let _this = this;

            if(tasks) {
                tasks.forEach(task => {
                    if(task.status == _this.status.id) {
                        points = points+task.points
                    }
                });
            }

            return points;
        }
    },
    methods: {
        checkMove(event) {
            // console.log(event);
            var elmnt = document.querySelector('#statusListDiv');
            let pos = event.pageX - $('#statusListDiv').offset().left
            // console.log(`mouse position: ${pos}`);
            if(pos>1000) {
                elmnt.scrollBy(10, 0);
            }
            if(pos<200) {
                elmnt.scrollBy(-10, 0);
            }
        },

        test(e) {
            this.$store.dispatch('updateSprintTaskOrder', {sprint_id: this.$route.params.sprint_id, tasks: this.tasks})
            
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
        max-height: 63vh; 
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
        margin-top: 10px;
        display: inline-block;
        margin-right: 10px;
        vertical-align:text-top;
    }
    .add-task-btn {
        border-radius: 0 0 3px 3px;
        color: #6b808c;
        display: block;
        flex: 0 0 auto;
        padding: 8px;
        position: relative;
        text-decoration: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .add-task-btn:hover {
        background-color: #DCDCDC;
    }
    
</style>

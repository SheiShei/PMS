<template>
    <div class="list-div">
        <div class="list-head">
            <div class="list-title" title="Tasks List">
                <b>
                    <span v-if="status.name=='New'" class="fa fa-circle text-info"></span>
                    <span v-if="status.name=='In progress'" class="fa fa-circle text-success"></span> 
                    <span v-if="status.name=='Ready for Test'" class="fa fa-circle text-warning"></span> 
                    <span v-if="status.name=='Closed'" class="fa fa-circle text-danger"></span> 
                    
                    {{ status.name }}</b>
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
    props: ['status', 'tasks'],
    data() {
        return {
            noCard: true,
            openTaskOpt: false,
        }
    },
    computed: {
        ...mapGetters({
                // tasks: 'getSprintTasks',
                // cSprint: 'getSprint',
            }),

        sTasks: {
            get() {
                let newTasks = [];
                let tasks = this.tasks
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
                // console.log(value);
                return this.$store.commit('updateTaskStatusOrder', {data: value, status: this.status.id})
            }
        },

        statPoints() {
            let tasks = this.tasks
            let points = 0;
            let _this = this;

            if(tasks) {
                tasks.forEach(task => {
                    if(task.status == _this.status.id) {
                        points = points + Number(task.points)
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
            this.$store.dispatch('updateSprintTaskOrder', {sprint_id: this.$route.params.sprint_id, board_id: this.$route.params.board_id, tasks: this.tasks})
            
        },
        
    }
}
</script>

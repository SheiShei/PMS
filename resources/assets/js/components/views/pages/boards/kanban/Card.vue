<template>
    <div class="list-div" @drag="checkListMove">
        <div style="cursor: move;" class="list-head" :class="{ 'list-head-kanban-done' : list.isDone }">
            <div class="list-title" title="Tasks List">
                <b>
                    <span v-if="!list.isDone" class="fa fa-align-left text-default"></span>
                    <span v-if="list.isDone" class="fa fa-thumbs-o-up text-success"></span>&nbsp;
                    {{ list.name }}</b>
            </div>
            <div class="editListBtn pull-right">
                <small>{{ listPoints }} pts</small>
                <button class="" @click="revert"><span class="fa fa-edit"></span></button>
                <button @click="deleteList(list.id)"><span class="fa fa-trash-o"></span></button>
                <button v-if="!list.isDone" @click="setAsDoneList(list.id)" title="Set this list as 'Finished List'"><span class="fa fa-thumbs-o-up"></span></button>
            </div>
        </div>
        <div class="list-edit" v-if="showEditList">
            <form @submit.prevent="updateList(list.id)">
                <div class="list-edit-input">
                    <input required type="text" class="btn-block" v-model="list.name">
                </div>
                <div class="list-edit-save">
                    <button type="submit" class="btn-save">SAVE</button>
                    <button class="btn-close btn btn-simple btn-default btn-xs" @click="revert" title="Cancel"><span class="fa fa-times"></span></button>
                    <!-- <button class="btn-close btn btn-simple btn-default btn-xs" @click="setAsDoneList(list.id)" title="Cancel"><span class="fa fa-times"></span></button> -->
                </div>
            </form>
        </div>
        <!-- <div class="list-body"> -->
                            

            <draggable v-model="list.tasks" :options="{animation:200, group:'tasks'}" :element="'div'" @change="taskListUpdate($event, li, list.id)" class="list-body">
                <card-task v-for="(task, index) in list.tasks" :key="index" :list_id="list.id" :task="task" :i="index"></card-task>
                <div class="" v-if="noCard" style="background-color: transparent; height: 5px"></div>
            </draggable>
        <!-- </div> -->
        <router-link :to="{ name: 'kanboard_addtask', params: {list_id: list.id}}" @click.prevent class="text-center add-task-btn" href=""><span class="icon-sm icon-add"></span><span>+ Add Task</span></router-link>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
import CardTask from './CardTask.vue';
import {mapGetters} from 'vuex';
export default {
    components: {
        draggable,
        cardTask : CardTask,
    },
    props: ['list', 'li'],
    data() {
        return {
            showEditList: false,
            noCard: true,
            openTaskForm: false,
            openTaskOpt: false,
            openTaskView: false,
        }
    },
    mounted() {
        let taskdiv = document.querySelector("#testTaskDiv");
        taskdiv.scrollLeft = taskdiv.scrollWidth;
    },
    computed: {
        ...mapGetters({
                // boardLists: 'boardLists',
            }),
        listPoints() {
            let points = 0;
            this.list.tasks.forEach(task => {
                points = points + Number(task.points)
            });

            return points;
        }
    },
    methods: {
        delListDiv(index){
            console.log('deleted!');
            this.listDivs.splice(index,1);
        },
        revert(){
            this.showEditList = !this.showEditList;
        },

        checkListMove(event) {
            // console.log(event);
            var elmnt = document.querySelector('#testTaskDiv');
            let pos = event.pageX - $('#testTaskDiv').offset().left
            // console.log(`mouse position: ${pos}`);
            if(pos>1000) {
                elmnt.scrollBy(10, 0);
            }
            if(pos<200) {
                elmnt.scrollBy(-10, 0);
            }
        },
        updateList(id){
            this.$store.dispatch('updateList', {name: this.list.name, id: id})
                .then(() => {
                    this.showEditList = false
                })
        },
        deleteList(id) {
            this.$store.dispatch('deleteList', id)
                .then(() => {
                    this.$toaster.warning('List deleted succesfully!.')
                })
        },
        taskListUpdate(e, list_index, list_id) {
            // console.log({event: e, list_id: list_id});
            // console.log(this.list)
            this.$store.commit('mapListUpdateOrder', {event: e, list_index: list_index, list_id: list_id})
            // console.log(this.list);
            this.$store.dispatch('updateTaskOrder', this.list)
                .then(() => {
                    if(e.added) {
                        this.monitorAddTask(e.added.element)
                    }
                    if(e.removed) {
                        this.monitorRemovedTask(list_id)
                    }
                })

        },
        setAsDoneList(id) {
            axios.patch('/api/setAsDoneList', {card_id: id, board_id: this.$route.params.board_id})
                .then((response) => {
                    // console.log(response);
                    this.$store.commit('setBoardLists', response.data);
                })
                .catch((error) => {
                    console.error(error);
                    
                })
        },
        monitorAddTask(e) {
            axios.post('/api/monitorAddTask', {task: e})
                .then((response) => {
                    // console.log(response);
                    
                })
                .catch((error) => {
                    console.error(error);
                    
                })
        },
        monitorRemovedTask(e) {
            axios.post('/api/monitorRemovedTask', {list_id: e})
                .then((response) => {
                    // console.log(response);
                    
                })
                .catch((error) => {
                    console.error(error);
                    
                })
        },
    }

}
</script>
<template>
    <div class="list-div">
        <div class="list-head">
            <div class="list-title" >
                <b>
                    <span v-if="sprint.finished_at" class="fa fa-circle text-gray"></span>
                    <span v-else class="fa fa-circle text-success"></span>

                    <span v-if="sprint.finished_at">
                        <router-link title="Click to open sprint backlog" v-if="sprint.type == 2" :to="{name: 'sprint', params: {board_id: $route.params.board_id, sprint_id: sprint.id}}" class="text-gray" style="">{{ sprint.name }}</router-link>
                    </span>
                    <span v-else>
                        <router-link title="Click to open sprint backlog" v-if="sprint.type == 2" :to="{name: 'sprint', params: {board_id: $route.params.board_id, sprint_id: sprint.id}}" style="color: #262626">{{ sprint.name }}</router-link>
                    </span>

                    <span v-if="sprint.type == 1">{{ sprint.name }} </span>
                </b>
            </div>
            <div class="editListBtn pull-right">
                <small>{{ sprintPoints }} pts</small>
                <button v-if="sprint.type == 2" class="" @click="revert" title="Edit Sprint"><span class="fa fa-edit"></span></button>
                <button @click="deleteSprint(sprint.id)" v-if="sprint.type == 2" class="" title="Delete Sprint"><span class="fa fa-trash-o"></span></button>
                <button @click="showFinishSprintModal" v-if="sprint.type == 2 && sprint.finished_at == null" class="" title="Close Sprint?"><span class="fa fa-compress"></span></button>
            </div>
        </div>
        <div class="list-edit" v-if="showEditList">
            <form>
            <div class="list-edit-input">
                <input @keyup.enter="updateSprint(sprint.id)" type="text" v-model="sprint.name" class="btn-block">
            </div>
            <div class="list-edit-save">
                <button @click="updateSprint(sprint.id)" class="btn-save">SAVE</button>
                <button class="btn-close btn btn-simple btn-default btn-xs" @click="revert" title="Cancel"><span class="fa fa-times"></span></button>
            </div>
            </form>
        </div>
        <div class="list-body">
            <draggable v-model="sprint.tasks" :options="{animation:200, group:'status'}" :element="'div'" @change="sprintTaskUpdate($event, sprint.id)">
                <card-task v-for="(task, index) in sprint.tasks" :key="task.id" :task="task" :i="index"></card-task>                
                <div class="" v-if="noCard" style="background-color: transparent; height: 5px"></div>
            </draggable>
        </div>
        <router-link :to="{name: 'scrumboard_addtask', params: {sprint_id: sprint.id}}" class="add-task-btn" href=""><span class="icon-sm icon-add"></span><span>Add task</span></router-link>
        
        <div class="modal fade" :id="'sprint-finish-'+sprint.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-small ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                         <h3>Close Sprint?</h3>
                    </div>
                    <div class="modal-body" style="margin-top: 0px; padding-top: 0;">
                        <h6 style="white-space: pre-wrap; overflow-wrap: break-word">All unfinished task will be move to backlog.</h6>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-simple" data-dismiss="modal">Go Back</button>
                        <button @click="finishSprint(sprint.id)" type="button" class="btn btn-success btn-simple">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
import Task from './CardTask.vue';
export default {
    components: {
        draggable,
        cardTask : Task
    },
    props: ['sprint'],
    data() {
        return {
            showEditList: false,
            noCard: true,
            openTaskOpt: false,
        }
    },
    mounted() {
        let taskdiv = document.querySelector("#scrumListDiv");
        taskdiv.scrollLeft = taskdiv.scrollWidth;
    },
    computed: {
        sprintPoints() {
            let points = 0;
            this.sprint.tasks.forEach(task => {
                points = points + Number(task.points)
            });

            return points;
        }
    },
    methods: {
        revert(){
            this.showEditList = !this.showEditList;
        },

        checkMove(event) {
            // console.log(event);
            var elmnt = document.querySelector('#scrumListDiv');
            let pos = event.pageX - $('#scrumListDiv').offset().left
            // console.log(`mouse position: ${pos}`);
            if(pos>1000) {
                elmnt.scrollBy(10, 0);
            }
            if(pos<200) {
                elmnt.scrollBy(-10, 0);
            }
        },

        updateSprint(id) {
            this.$store.dispatch('updateSprint', {id: id, name: this.sprint.name})
                .then(() => {
                    this.showEditList = false;
                })
        },

        deleteSprint(id) {
            this.$store.dispatch('deleteSprint', id)
                .then(() => {
                    this.$toaster.warning('Sprint deleted succesfully!.')
                })
        },

        sprintTaskUpdate(e, id) {
            this.$store.commit('mapSprintUpdateOrder', id);
            this.$store.dispatch('updateSprintOrder', this.sprint)
        },

        showFinishSprintModal(id) {
            $('#sprint-finish-'+this.sprint.id).modal('show');
        },

        finishSprint(id) {
            $('#sprint-finish-'+this.sprint.id).modal('hide');
            this.$store.dispatch('finishSprint', id)
                .then(() => {
                    
                })
        }
    }
}
</script>

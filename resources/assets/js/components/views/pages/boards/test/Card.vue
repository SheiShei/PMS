<template>
    <div class="list-div">
        <div class="list-head">
            <div class="list-title" >
                <b>
                    <span v-if="sprint.finished_at" class="fa fa-circle text-gray"></span>
                    <span v-else-if="sprint.type != 1" class="fa fa-circle text-success"></span>

                    <span v-if="sprint.finished_at">
                        <router-link title="Click to open sprint backlog" v-if="sprint.type == 2" :to="{name: 'test_sprint', params: {board_id: $route.params.board_id, sprint_id: sprint.id}}" class="text-gray" style="">{{ sprint.name }}</router-link>
                    </span>
                    <span v-else>
                        <router-link title="Click to open sprint backlog" v-if="sprint.type == 2" :to="{name: 'test_sprint', params: {board_id: $route.params.board_id, sprint_id: sprint.id}}" style="color: #262626">{{ sprint.name }}</router-link>
                    </span>

                    <span v-if="sprint.type == 1">{{ sprint.name }} </span>
                </b>
            </div>
            <div class="editListBtn pull-right">
                <small>{{ sprintPoints }} pts</small>
                <button v-if="sprint.type == 2" class="" @click="revert" title="Edit Sprint"><span class="fa fa-edit"></span></button>
                <button v-if="sprint.type == 2" @click="$router.push({name: 'dsprint_conf', params: {sprint_id: sprint.id}})" class="" title="Delete Sprint"><span class="fa fa-trash-o"></span></button>
                <!-- <button class="" title="Close Sprint?"><span class="fa fa-stop"></span></button> -->
            </div>
        </div>
        <div class="list-edit" v-if="showEditList">
            <form @submit.prevent="updateUSname(sprint.id)">
                <div class="list-edit-input">
                    <input required v-model="sprint_name" type="text" class="btn-block">
                </div>
                <div class="list-edit-save">
                    <button type="submit" class="btn-save">SAVE</button>
                    <button class="btn-close btn btn-simple btn-default btn-xs" @click="revert" title="Cancel"><span class="fa fa-times"></span></button>
                </div>
            </form>
        </div>
        <div class="list-body">
            <draggable v-model="sprint.us" :options="{animation:200, group:'status'}" :element="'div'" @change="usChange($event, sprint.id, sprint.type)">
                <card-task v-for="(us, index) in sprint.us" :key="us.id" :us="us" :i="index" :sname="sprint.name"></card-task>                
                <div class="" v-if="noCard" style="background-color: transparent; height: 5px"></div>
            </draggable>
        </div>
        <router-link v-if="sprint.type == 1" :to="{name: 'snt', params: {sprint_id: sprint.id}}" class="add-task-btn" href=""><span class="icon-sm icon-add"></span><span>Add User Story</span></router-link>
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
            sprint_name: this.sprint.name
        }
    },
    mounted() {
    },
    computed: {
        sprintPoints() {
            let points = 0;
            this.sprint.us.forEach(task => {
                points = points + Number(task.points)
            });

            return points;
        }
    },
    methods: {
        revert(){
            this.showEditList = !this.showEditList;
        },
        usChange(e, sid, type) {
            this.$store.commit('mapSprintUSOrder', sid);
            this.$store.dispatch('updateSprintOrder', this.sprint)
                .then(() => {
                    if(e.added){
                        if(type == 2){
                            this.monitorUS(e.added.element)
                        }
                    }
                    if(e.removed){
                        if(type == 2){
                            this.monitorRemovedUS(sid)
                        }
                    }
                })
        },
        updateUSname(id) {
            this.$store.dispatch('updateSprint', {id: id, name: this.sprint_name})
                .then(() => {
                    this.showEditList = false;
                })
        },
        monitorUS(e) {
            axios.post('/api/monitorUS', {us: e})
                .then(response => {
                    console.log(response);
                    
                })
                .catch(error => {
                    console.error(error);
                    
                })
        },
        monitorRemovedUS(e) {
            axios.post('/api/monitorRemovedUS', {sprint_id: e})
                .then(response => {
                    console.log(response);
                    
                })
                .catch(error => {
                    console.error(error);
                    
                })
        }
    }
}
</script>

<style lang="scss" scoped>
    
    
</style>
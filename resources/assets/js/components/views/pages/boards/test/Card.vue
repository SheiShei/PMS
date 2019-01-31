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
            <draggable v-model="sprint.us" :options="{animation:200, group:'status'}" :element="'div'" @change="usChange($event, sprint.id)">
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
        usChange(e, sid) {
            this.$store.commit('mapSprintUSOrder', sid);
            this.$store.dispatch('updateSprintOrder', this.sprint)
        },
        updateUSname(id) {
            this.$store.dispatch('updateSprint', {id: id, name: this.sprint_name})
                .then(() => {
                    this.showEditList = false;
                })
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
        border: 2px dashed #bfbaba;
        background-color: gainsboro;
        text-align: center;
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
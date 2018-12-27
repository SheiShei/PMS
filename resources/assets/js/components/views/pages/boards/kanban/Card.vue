<template>
    <div class="list-div" @drag="checkListMove">
        <div style="cursor: move;" class="list-head">
            <div class="list-title" title="Tasks List">
                <b>{{ list.name }}</b>
            </div>
            <div class="editListBtn pull-right">
                <small>21213 pts</small>
                <button class="" @click="revert"><span class="fa fa-edit"></span></button>
                <button @click="deleteList(list.id)"><span class="fa fa-trash-o"></span></button>
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
                </div>
            </form>
        </div>
        <div class="list-body">
                            

            <draggable v-model="list.tasks" :options="{animation:200, group:'tasks'}" :element="'div'" @change="upd">
                <card-task v-for="(task, index) in list.tasks" :key="index" :li="li" :list_id="list.id" :task="task" :i="index"></card-task>
                <div class="" v-if="noCard" style="background-color: transparent; height: 5px"></div>
            </draggable>
        </div>
        <router-link :to="{ name: 'kanboard_addtask', params: {list_id: list.id}}" @click.prevent class="add-task-btn" href=""><span class="icon-sm icon-add"></span><span>Add task</span></router-link>
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
        upd() {
            // console.log(this.list.tasks);
            
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

<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" :style="'background-image: url('+board.board_image+');'" v-if="board">
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper">
                <router-view :per="task"></router-view>
                <kanban-settings v-if="viewBSettings" @close="viewBSettings = false" :boardData="board" :permissions="permissions" :role_permissions="role_permissions" :not_members="not_members"></kanban-settings>
                <div class="board-header">
                    <div class="board-name">
                        <h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;{{ board.name }}</h4>
                    </div>
                    <div class="board-info">
                        <button @click="viewBAbout = !viewBAbout" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-info-circle"></span> 
                            <span class="hidden-sm hidden-xs"> Details</span>
                        </button>
                    </div>
                    <div class="board-info">
                        <button @click="viewBSettings = true" class="btn btn-white btn-simple btn-round btn-xs" title="Board Settings"><span class="fa fa-gears"></span> Board Settings</button>
                    </div>
                    <div class="board-info">
                        <a @click="$router.push({name: 'kanboard_stats'})" class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                    </div>
                </div>


                <div>
                    <button v-if="addList" class="btn btn-success btn-sm" @click="addNewList"> + Add New List</button>          
                    <div id="testTaskDiv" class="board-body">
                        <draggable v-model="boardLists" :options="{animation:200, group:'status'}" @change="updateListOrder" :element="'div'">
                            <list-card v-for="(list , index) in boardLists" :key="index" :li="index" :list="list" :modifyList="modifyList" :delList="deleteList" :taskPerm="task"></list-card>
                        </draggable>
                    </div>
                </div>
                
                <kanban-about v-if="viewBAbout" @close="viewBAbout = !viewBAbout" :board="board"></kanban-about>

            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import KanbanSettings from './kanban/KanbanSettings.vue';
import KanbanAbout from './kanban/About.vue';
import Card from './kanban/Card.vue';
import {mapGetters} from 'vuex';
export default {
    components: {
        draggable,
        listCard: Card,
        kanbanSettings: KanbanSettings,
        kanbanAbout: KanbanAbout
    },
    data() {
        return {
            viewBSettings: false,
            viewBAbout: false,
            viewMemmod: false, 
            userPermit: null,
            addList: false,
            modifyList: false,
            deleteList: false,
            task: {
                modify: false,
                view: false,
                add: false,
                delete: false,
                comment: false
            }
        }
    },
    created() {
        this.$store.dispatch('getBoardLists', this.$route.params.board_id);
        this.getCuBoard();
        this.getBoardNotMembers();
    },
    mounted() {
        this.stopListen();
        this.listenList();
    },
    destroyed() {
        this.$store.commit('boardDestroyed');
        this.stopListen();
    },
    computed: {
        ...mapGetters({
                boardLists: 'boardLists',
                board: 'getCBoard',
                permissions: 'getPermissionsList',
                role_permissions: 'getRolePermissions',
                not_members: 'getBoardNotMembers',
            }),
        boardLists: {
            get () {
                return this.$store.getters.boardLists
            },
            set (newValue) {
                return this.$store.commit('updateOrder', newValue)
                // return this.$store.dispatch('updateListOrder', {board_id: this.$route.params.board_id, lists: this.boardLists})
            }
        },
        computeTaskLength() {
            let totalTask = 0
            this.boardLists.forEach(list => {
                totalTask += list.tasks.length
            });
            return totalTask;
        },
    },
    methods: {
        addNewList(){
            let listLength = this.boardLists.length + 1;
            let boardData = {
                board_id : this.$route.params.board_id,
                order :  listLength
            }
            this.$store.dispatch('createList', boardData)
        },

        updateListOrder() {
            this.$store.dispatch('updateListOrder', {board_id: this.$route.params.board_id, lists: this.boardLists})
        },

        getBoardNotMembers() {
            this.$store.dispatch('getBoardNotMembers', {board_id: this.$route.params.board_id})
        },

        getCuBoard() {
            this.$store.dispatch('getCBoard', this.$route.params.board_id)
                .then((response) => {
                    this.userPermit = response;
                    this.checkListPerm();
                })
        },
        
        checkListPerm() {
            // console.log(this.userPermit);
            
            if(this.userPermit) {
                this.userPermit.forEach(permit => {
                    if(permit.type == "list" && permit.name == "Add" && permit.isAuthenticated) {
                        this.addList = true
                    }
                    else if(permit.type == "list" && permit.name == "Modify" && permit.isAuthenticated) {
                        this.modifyList = true
                    }
                    else if(permit.type == "list" && permit.name == "Delete" && permit.isAuthenticated) {
                        this.deleteList = true
                    }
                    else if(permit.type == "list" && permit.name == "Delete" && permit.isAuthenticated) {
                        this.deleteList = true
                    }
                    else if(permit.type == "task" && permit.name == "Add" && permit.isAuthenticated) {
                        this.task.add = true
                    }
                    else if(permit.type == "task" && permit.name == "Modify" && permit.isAuthenticated) {
                        this.task.modify = true
                    }
                    else if(permit.type == "task" && permit.name == "Delete" && permit.isAuthenticated) {
                        this.task.delete = true
                    }
                    else if(permit.type == "task" && permit.name == "View" && permit.isAuthenticated) {
                        this.task.view = true
                    }
                    else if(permit.type == "task" && permit.name == "Comment" && permit.isAuthenticated) {
                        this.task.comment = true
                    }
                });
                // this.addList = false;
                // return false;
            }
        },

        listenList() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('AddListEvent', (e) => {
                    // console.log(e.newList);
                    this.$store.commit('createList', e.newList)
                })
                .listen('DeleteListEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteList', e.list_id)
                })
                .listen('UpdateListEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateList', e.list)
                })
                .listen('UpdateListOrderEvent', (e) => {
                    // console.log(JSON.parse(e.lists));
                    this.$store.commit('setBoardLists', JSON.parse(e.lists))
                })
                .listen('AddListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addListTask', e.task);
                })
                .listen('UpdateListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateTask', e.task);
                })
                .listen('DeleteListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteTask', e.task_id)
                })
        },

        stopListen() {
            Echo.leave('list.'+this.$route.params.board_id);
        }
    }
}
</script>

<style lang="scss" scoped>
.taskchart{
    p, h6, h4{
        margin:0;
    }
}
.overlay{
    position: absolute;
    top:0;
    left:0;
}
</style>


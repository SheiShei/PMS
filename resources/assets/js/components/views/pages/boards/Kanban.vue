<template>

    <section class="main-main-container" id="kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-wrapper" v-if="board">
            <router-view></router-view>
            <div class="board-header">
                <div class="board-name">
                    <h4 class="" style="">{{ board.name }}</h4>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;{{ computeTaskLength }}</p>
                </div>
                <div class="board-info">
                    <p title="Members"><span class="fa fa-user-o"></span>&nbsp;{{ boardMembers.length }}</p>
                </div>
                <div class="board-info">
                    <a class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                </div>
            </div>
            <button class="btn btn-success btn-sm" @click="addNewList"> + Add New List</button>
            <!-- <router-link :to="{ name: 'kanboard_addtask'}" class="btn btn-success btn-sm"> + Add Task</router-link>
            <router-link :to="{ name: 'kanboard_viewtask', params: {task_id: 'asdasd123'} }" class="btn btn-warning btn-sm"> View Task</router-link>
            <router-link :to="{ name: 'kanboard_gallery', params: {task_id: '123asd'} }" class="btn btn-danger btn-sm"> Open Gallery</router-link> -->
            
            <div id="testTaskDiv" class="board-body">
                <draggable v-model="boardLists" :options="{animation:200, group:'status'}" @change="updateListOrder" :element="'div'">
                    <list-card v-for="(list , index) in boardLists" :key="index" :li="index" :list="list"></list-card>
                </draggable>
            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import Card from './kanban/Card.vue';
import {mapGetters} from 'vuex';
export default {
    components: {
        draggable,
        listCard: Card
    },
    data() {
        return {

        }
    },
    created() {
        this.$store.dispatch('getBoardLists', this.$route.params.board_id);
        this.getCuBoard();
        this.getBoardMembers();
    },
    mounted() {
        this.listenList();
    },
    computed: {
        ...mapGetters({
                boardLists: 'boardLists',
                boardMembers: 'boardMembers',
                board: 'getCBoard',
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
        }
    },
    destroyed() {
        this.$store.commit('boardDestroyed')
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

        getBoardMembers() {
            this.$store.dispatch('getBoardMembers', this.$route.params.board_id)
        },

        getCuBoard() {
            this.$store.dispatch('getCBoard', this.$route.params.board_id)
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
        }
    }
}
</script>




<template>

    <section class="main-main-container" id="kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-wrapper">
            <router-view></router-view>
            <div class="board-header">
                <div class="board-name">
                    <h4 class="" style="">Web Boards</h4>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;12</p>
                </div>
                <div class="board-info">
                    <p title="Members"><span class="fa fa-user-o"></span>&nbsp;7</p>
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
                    <list-card v-for="(list , index) in boardLists" :key="index" :list="list"></list-card>
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
        this.$store.dispatch('getBoardLists', this.$route.params.board_id)
    },
    computed: {
        // ...mapGetters({
        //         boardLists: 'boardLists',
        //     }),
        boardLists: {
            get () {
                return this.$store.getters.boardLists
            },
            set (newValue) {
                return this.$store.commit('updateOrder', newValue)
                // return this.$store.dispatch('updateListOrder', {board_id: this.$route.params.board_id, lists: this.boardLists})
            }
        }
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
        }
    }
}
</script>




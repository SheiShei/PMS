<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" style="background-image: url('/images/above-art2.jpg');">
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper" v-if="board">
                <router-view></router-view>

                <div class="board-header">
                    <div class="board-name">
                        <h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;{{ board.name }}</h4>
                    </div>
                    <div class="board-info">
                        <button v-if="viewBAbout==false" @click="viewBAbout = !viewBAbout" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-info-circle"></span> 
                            About <span class="fa fa-angle-down"></span>
                        </button>
                        <button v-else @click="viewBAbout = !viewBAbout" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-info-circle"></span> About <span class="fa fa-angle-up"></span>
                        </button>
                    </div>
                    <div class="board-info">
                        <router-link :to="{name: 'kanboard_settings'}" class="btn btn-white btn-simple btn-round btn-xs" title="Board Settings"><span class="fa fa-gears"></span> Board Settings</router-link>
                    </div>
                </div>

                <div class="row" v-if="viewBAbout">
                    <div class="col-md-8 col-sm-12 text-white" style="white-space: pre-line">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem explicabo sint nisi accusantium excepturi libero temporibus adipisci fugiat ipsum magni.</p>
                        <hr/>
                        <p>Admin: 
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                        </p>
                        <br/>
                        <p>Members: 
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                        </p>  
                    </div>
                </div>


                <div v-if="!viewBAbout">
                    <button class="btn btn-success btn-sm" @click="addNewList"> + Add New List</button>          
                    <div id="testTaskDiv" class="board-body">
                        <draggable v-model="boardLists" :options="{animation:200, group:'status'}" @change="updateListOrder" :element="'div'">
                            <list-card v-for="(list , index) in boardLists" :key="index" :li="index" :list="list"></list-card>
                        </draggable>
                    </div>
                </div>
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
            viewBSettings: false,
            viewBAbout: false,
            viewMemmod: false
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
    destroyed() {
        this.$store.commit('boardDestroyed');
        this.stopListen();
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
        },

        stopListen() {
            Echo.leave('list.'+this.$route.params.board_id);
        }
    }
}
</script>

<style lang="scss" scoped>


.overlay{
    position: absolute;
    top:0;
    left:0;
}
</style>


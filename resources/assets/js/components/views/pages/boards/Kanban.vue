<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" style="background-image: url('/images/bts.jpg');">
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper" v-if="board">
                <router-view></router-view>
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
                        <router-link :to="{name: 'kanboard_settings'}" class="btn btn-white btn-simple btn-round btn-xs" title="Board Settings"><span class="fa fa-gears"></span> Board Settings</router-link>
                    </div>
                    <div class="board-info">
                        <a @click="$router.push({name: 'kanboard_stats'})" class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
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


                <div>
                    <button class="btn btn-success btn-sm" @click="addNewList"> + Add New List</button>          
                    <div id="testTaskDiv" class="board-body">
                        <draggable v-model="boardLists" :options="{animation:200, group:'status'}" @change="updateListOrder" :element="'div'">
                            <list-card v-for="(list , index) in boardLists" :key="index" :li="index" :list="list"></list-card>
                        </draggable>
                    </div>
                </div>
                
                <transition name="fade">
                    <div class="overlay" v-if="viewBAbout">
                        <div class="aboutmod">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="taskchart shadow bl-gray">
                                        <h4><span class="fa fa-trello"></span> Kanban Board Name Here - Details <span class="pull-right"><button @click="viewBAbout=!viewBAbout" class="btn btn-xs btn-danger btn-simple"><span class="fa fa-times"></span></button></span> </h4>
                                        <p class="note">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore accusamus officia placeat, qui dolorum quis aspernatur fugit laudantium perferendis similique, minima tempore nesciunt amet enim inventore delectus dolorem possimus a.</p>
                                    </div>
                                </div>
                            </div> 
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="taskchart shadow">
                                        <h6 class="txt-bold"><span class="fa fa-history"></span> Activities</h6>
                                        <hr/>
                                        <div class="actlist">
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-success">
                                                        <i class="fa fa-trello medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam created the board: Board Name</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-success">
                                                        <i class="fa fa-user-o medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam added Jenjen to the board</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-warning">
                                                        <i class="fa fa-star medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam assgined Jenjen as admin</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-success">
                                                        <i class="fa fa-align-left medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam created new list: TaskList</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-danger">
                                                        <i class="fa fa-align-left medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam deleted the list: TaskList</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-info">
                                                        <i class="fa fa-align-left medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam renamed the list Tasklist to: Tasklist2</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-success">
                                                        <i class="fa fa-tasks medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam created new task: TaskTitleHere</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-info">
                                                        <i class="fa fa-tasks medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam updated the details of task: TaskTitleHere</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-danger">
                                                        <i class="fa fa-tasks medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam deleted the task: TaskTitleHere</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-info">
                                                        <i class="fa fa-gears medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Admin Sam updated board settings</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-info">
                                                        <i class="fa fa-tasks medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam changed the status of task TaskTitle to In Progress</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-warning">
                                                        <i class="fa fa-star-o medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam removed Jenjen as admin</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="actdiv">
                                                <div class="act-left">
                                                    <div class="act-icon bg-danger">
                                                        <i class="fa fa-user-o medium-avatar" alt=""></i>
                                                    </div>
                                                </div>
                                                <div class="act-right">
                                                    <p>Sam removed Jenjen from the board</p>
                                                    <p class="acttime"><small>
                                                        <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="taskchart shadow">
                                        <h6 class="txt-bold"><span class="fa fa-user-o"></span> Members</h6>
                                        <hr/>
                                        <div class="membbb">
                                            <div class="membdiv">
                                                <div class="memb-left">
                                                    <img src="/images/default.png" class="medium-avatar" alt="">
                                                </div>
                                                <div class="memb-right">
                                                    <p class="text-default membsender"><span class="txt-bold">Samantha Millos</span></p>
                                                    <p class="mainmemb">Admin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="membbb">
                                            <div class="membdiv">
                                                <div class="memb-left">
                                                    <img src="/images/default.png" class="medium-avatar" alt="">
                                                </div>
                                                <div class="memb-right">
                                                    <p class="text-default membsender"><span class="txt-bold">Samantha Millos</span></p>
                                                    <p class="mainmemb">Member</p>
                                                </div>
                                            </div>
                                            <div class="membdiv">
                                                <div class="memb-left">
                                                    <img src="/images/default.png" class="medium-avatar" alt="">
                                                </div>
                                                <div class="memb-right">
                                                    <p class="text-default membsender"><span class="txt-bold">Samantha Millos</span></p>
                                                    <p class="mainmemb">Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>

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


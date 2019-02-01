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
                        <button @click="viewMemmod = !viewMemmod" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-user-plus"></span>
                            <span class="hidden-xs hidden-sm"> New Member </span>
                        </button>
                    </div>
                    <div class="board-info">
                        <a @click="viewBSettings = !viewBSettings" class="btn btn-white btn-simple btn-xs" title="Board Settings">
                            <span class="fa fa-gears"></span>
                            <span class="hidden-xs hidden-sm"> Board Settings</span>
                        </a>
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
                    <div class="overlay" v-show="viewBSettings">   
                        <div class="boardsettings">
                            <form>
                                <div class="row">
                                    <div class="col-md-11">
                                        <h4><span class="fa fa-gears"></span> Settings - Kanban Board 1</h4>
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <a class="btn btn-danger btn-simple btn-round btn-xs" @click="viewBSettings = !viewBSettings"><span class="fa fa-times-circle"></span></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="control-label text-grey"><span class="fa fa-trello"></span> Name:</label>
                                                <input type="text" value="Sample Scrum Board" class="my-input my-inp-blk">
                                                <label class="control-label text-grey"><span class="fa fa-align-left"></span> Description:</label>
                                                <textarea rows="4" class="my-text-area my-inp-blk">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae earum, natus culpa recusandae ipsa fugit nisi? Facilis, nihil dignissimos! Voluptatibus magni blanditiis placeat doloribus autem voluptate beatae earum iste tempore.
                                                </textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label text-grey"><span class="fa fa-image"></span> Background Image:</label>
                                                <div data-provides="fileinput" class="fileinput fileinput-new text-left">
                                                    <div>
                                                        <span class="btn btn-raised btn-block btn-xs btn-round btn-default btn-file">
                                                            <span class="fileinput-new">Change</span> 
                                                            <span class="fileinput-exists">Change</span> 
                                                            <input type="file" name="...">
                                                            <div class="ripple-container"></div>
                                                        </span>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised text-center" style="max-height: 100px; width: auto;"></div> 
                                                    <div class="fileinput-new thumbnail img-raised text-center">
                                                        <img src="/images/above-art1.jpg" alt="..." style="height: 100px; width: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label text-grey">
                                                    <span class="fa fa-unlock-alt"></span> Permissions:
                                                </label>
                                                <p class="note">Set here the actions members can do in this board.</p>
                                                <p>Members can:</p>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    View Tasks
				            	                    </label>
				                                </div>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    Add Tasks
				            	                    </label>
				                                </div>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    Modify Tasks
				            	                    </label>
				                                </div>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    Comment Tasks
				            	                    </label>
				                                </div>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    Delete Tasks
				            	                    </label>
				                                </div>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    Add Lists
				            	                    </label>
				                                </div>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    Modify Lists
				            	                    </label>
				                                </div>
                                                <div class="togglebutton">
				            	                    <label>
				                	                    <input type="checkbox" checked>
									                    Delete Lists
				            	                    </label>
				                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border-left: 1px solid #f8f8f8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-striped">
		                                            <thead style="position: sticky; top:0">
		                                                <tr>
		                                                    <th><span class="fa fa-user-o"></span> Member</th>
		                                                    <th>Role</th>
		                                                    <th></th>
		                                                    <th class="text-right">Actions</th>
		                                                </tr>
		                                            </thead>
		                                            <tbody>
		                                                <tr>
		                                                    <td><span class="fa fa-star text-warning" rel="tooltip" title="Board Admin"></span>&nbsp;Andrew Mike</td>
		                                                    <td>Admin</td>
                                                            <td>
                                                                <button class="btn btn-xs btn-info btn-simple">Set as Admin</button>
                                                            </td>
                                                            <td class="td-actions text-right">
		                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-xs btn-just-icon btn-simple btn-round" data-original-title="Remove Member" title="Remove Member">
		                                                            <i class="fa fa-times"></i>
		                                                        </button>
		                                                    </td>
		                                                </tr>
                                                        <tr>
		                                                    <td>Catriona Gray</td>
		                                                    <td>Member</td>
                                                            <td>
                                                                <button class="btn btn-xs btn-danger btn-simple">Remove as Admin</button>
                                                            </td>
		                                                    <td class="td-actions text-right">
		                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-xs btn-just-icon btn-simple btn-round" data-original-title="Remove Member" title="Remove Member">
		                                                            <i class="fa fa-times"></i>
		                                                        </button>
		                                                    </td>
		                                                </tr>
		                                            </tbody>
		                                        </table>
                                            </div>
                                            <div class="col-md-11">
                                                <hr/>
                                                <div class="form-group text-right">
                                                    <label class="control-label text-grey">
                                                        <span class="fa fa-user-plus text-left"></span> New Member:</label>
                                                    <input type="search" style="height: 28px; margin-top: 7px" placeholder="Search..." class="my-input">
                                                    <span><button class="btn btn-info btn-sm">
                                                    ADD SELECTED
                                                    </button></span>
                                                </div>
                                                <div class="choose-mem" style="max-height: 100px; overflow:auto">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="optionsCheckboxes">
                                                            <span class="check"></span>
                                                            <img src="/images/default.png" class="small-avatar"/> Not member 1
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="optionsCheckboxes">
                                                            <span class="check"></span>
                                                            <img src="/images/default.png" class="small-avatar"/> Not member 1
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="optionsCheckboxes">
                                                            <span class="check"></span>
                                                            <img src="/images/default.png" class="small-avatar"/> Not member 1
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>        
                </transition>
                <transition name="fade" v-if="viewMemmod">
                    <div class="overlay">
                        <div class="membersmod">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>New Member</h4>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <label class="control-label text-grey">
                                            <span class="fa fa-user-plus text-left"></span> New Member:</label>
                                        <input type="search" style="height: 28px; margin-top: 7px" placeholder="Search..." class="my-input">
                                        <span><button class="btn btn-info btn-sm">
                                            ADD SELECTED
                                        </button></span>
                                    </div>
                                    <div class="choose-mem" style="">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                <img src="/images/default.png" class="small-avatar"/> Not member 1
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                <img src="/images/default.png" class="small-avatar"/> Not member 2
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                <img src="/images/default.png" class="small-avatar"/> Not member 3
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <p class="text-success"><span class="fa fa-check"></span> A new member has been successfully added.</p>
                                    <!--<p class="text-danger"><span class="fa fa-times"></span> There's a problem adding the member.</p>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button @click="viewMemmod=!viewMemmod" class="btn btn-xs btn-danger btn-simple">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
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


<template>
    <section class="main-main-container">
         <div class="title-head">
            <h2><span class="fa fa-trello"></span> Boards</h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="taskchart shadow">
                            <h6 class="no-margin"><span class="txt-bold"><span class="fa fa-trello"></span> Board List</span>&nbsp;
                                <span class="">
                                    <select @change="getUserBoards" v-model="boarddata.type" class="my-thin-select text-default">
                                        <option value="" selected>All Boards</option> 
                                        <option value="1">Kanban</option>
                                        <option value="2">Scrum</option> 
                                    </select>
                                </span>
                                <!-- <span class="">
                                    <select @change="getUserBoards" v-model="boarddata.privacy" class="my-thin-select text-default">
                                        <option value="">Team & Personal</option> 
                                        <option value="1">Personal</option> 
                                        <option value="2">Team</option> 
                                    </select>
                                </span> -->
                                <span class="pull-right">
                                    <p class="no-margin"><small>Found:</small> {{ userBoards.length }}</p>
                                </span>
                            </h6>
                            <hr/>
                            <div class="boardlist" style="max-height: 70vh; overflow-y:auto" is="transition-group" name="list-complete">
                                <div v-for="board in userBoards" :key="board.id" class="list-complete-item">
                                    <router-link v-if="board.type == 1" :to="{ name: 'kanboard', params: {board_id: board.id} }" class="boarddiv">
                                        <div class="boardname">{{ board.name }}</div>
                                        <div class="boardoptions">
                                            <p><span class="pull-right">
                                                <!-- <a href="" @click.stop="updateBoard(board)" class="text-success" title="Edit Board"><i class="fa fa-edit"></i></a> -->
                                                <a href="" @click.stop="deleteBoard(board.id)" class="text-danger" title="Delete Board"><i class="fa fa-trash-o"></i></a>
                                            </span></p>
                                        </div>
                                    </router-link>
                                    <router-link v-if="board.type == 2" :to="{ name: 'test', params: {board_id: board.id} }" class="boarddiv">
                                        <div class="boardname">{{ board.name }}</div>
                                        <div class="boardoptions">
                                            <p><span class="pull-right">
                                                <!-- <a href="" @click.stop.prevent="updateBoard(board)" class="text-success" title="Edit Board"><i class="fa fa-edit"></i></a> -->
                                                <a href="" @click.stop.prevent="deleteBoard(board.id)" class="text-danger" title="Delete Board"><i class="fa fa-trash-o"></i></a>
                                            </span></p>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-4 profilesec">
                        <transition name="slide">
                            <div class="taskchart shadow">
                                <p class="no-margin txt-bold"><span class="fa fa-plus-square-o text-info"></span> Create New Board</p>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group is-empty">
                                            <label class="control-label">Board Type:</label>
                                            <div class="radio">
                                                <span>
                                                    <label>
									                    <input v-model="board.type" value="1" type="radio" name="optionsRadios"><span class="circle"></span><span class="check"></span>
									                    Kanban
								                    </label>
                                                </span>
                                                <span>
                                                    <label>
									                    <input v-model="board.type" value="2" type="radio" name="optionsRadios"><span class="circle"></span><span class="check"></span>
									                    Scrum
								                    </label>                                
                                                </span>
						                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group is-empty">
                                            <label class="control-label">Board Name:</label>
                                            <input v-model="board.name" required type="text" class="form-control">
                                            <span class="material-input"></span>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group is-empty">
                                            <label class="control-label">Board Description:</label>
                                            <textarea v-model="board.desc" required type="text" class="form-control"></textarea>
                                            <span class="material-input"></span>
                                        </div> 
                                    </div>
                                </div>
                                <br/>
                                <div class="row form-group text-center">
                                    <div class="col-md-6">
                                        <button @click="cancel" class="btn btn-default btn-md btn-block" type="button">Cancel</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button @click="createBoard" class="btn btn-info btn-md btn-block" type="button" value="">CREATE</button>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>        
                </div>
            </div>
        </div> 
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    data() {
        return {
            board: {
                type: 1,
                name: '',
                desc: '',
            },
            boarddata: {
                type: '',
                privacy: '',
                id: this.$store.state.loggedUser.id
            },
        }
    },

    created() {
        this.getUserBoards();
    },

    mounted() {
        this.stopBoardEvents();
        this.listenBoardEvents();
    },

    destroyed() {
        this.stopBoardEvents();
    },

    computed: {
        ...mapGetters({
                userBoards: 'userBoards'
            }),
    },

    methods: {
        getUserBoards() {
            this.$store.dispatch('getUserBoards', this.boarddata)
        },

        cancel() {
            this.board.type = 1
            this.board.name = '';
            this.board.desc = '';
        },

        createBoard() {
            this.$store.dispatch('createBoard', this.board)
                .then(() => {
                    this.board.type = 1;
                    this.board.name = '';
                    this.board.desc = '';
                })
        },

        deleteBoard(id) {
            this.$store.dispatch('deleteBoard', id)
                .then(() => {
                    this.$toaster.warning('Board deleted succesfully!.')
                })
            
        },

        listenBoardEvents() {
            Echo.private('boards')
                .listen('CreateBoardEvent', (e) => {
                    // console.log(e);
                    var _this = this;
                    let found = e.boards.board_users.find(function(element) {
                        return element.id == _this.currentUser.id
                    });
                    if(found) {
                        // console.log(e);
                        this.$store.commit('addBoard', e.boards);
                    }
                })
                .listen('UpdateBoardEvent', (e) => {
                    // console.log(e);
                    var _this = this;
                    let found = e.boards.board_users.find(function(element) {
                        return element.id == _this.currentUser.id
                    });
                    if(found) {
                        // console.log(e);
                        this.$store.commit('uBoard', e.boards);
                    }
                })
                .listen('DeleteBoardEvent', (e) => {
                    // console.log(e);
                    var _this = this;
                    let found = e.boards.board_users.find(function(element) {
                        return element.id == _this.currentUser.id
                    });
                    if(found) {
                        // console.log(e);
                        this.$store.commit('deleteBoard', e.boards.id);
                    }
                })
        },

        stopBoardEvents() {
            Echo.leave('boards')
        }
    }
}
</script>

<style lang="scss" scoped>
    .boarddiv{
        position: relative;
        display: block;
        padding: 10px 15px;
    }
    .boarddiv:hover{
        background-color: #fafafa;
        .boardname{
            color: #09aec3;
            font-weight: bold;
        }
    }
    .boarddiv:hover .boardoptions{
        display: inline-block;
        position: absolute;
        right:0;
        transition-delay: opacity 0.3s;
    }
    .boardoptions{
        display: none;
        margin-left: 7px;
        font-size: 15px;
        color:unset;
        p{
            margin-bottom: 0;
        }
        a{
            padding: 4px 3px;
        }
    }
    .boardname{
        display: inline-block;
        color: gray;
    }
</style>



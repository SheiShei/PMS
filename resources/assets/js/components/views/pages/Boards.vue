<template>
    <section class="main-main-container" style="background-color: ;">
         <div class="title-head">
            <h2><span class="fa fa-trello"></span> Boards</h2>
        </div>
        <!-- <br/> -->
        <!-- <div class="col-md-1"></div>  -->
        <div class="first-column col-md-6">
            <!-- <h4 class="">Board List</h4> -->
            <p class="note" style="margin-top: 10px">Filter boards by type and access below.</p>
            
            <select @change="getUserBoards" v-model="boarddata.type" class="my-input">
                <option value="" selected>All Boards</option> 
                <option value="1">Kanban</option>
                <option value="2">Scrum</option> 
            </select>
            &nbsp;&nbsp;&nbsp;
            <select @change="getUserBoards" v-model="boarddata.privacy" class="my-input">
                <option value="">Team & Personal</option> 
                <option value="1">Personal</option> 
                <option value="2">Team</option> 
            </select>
            <p class="pull-right">Found: {{ userBoards.length }} board</p>
            <hr />
            <div class="boardlist" style="max-height: 70vh; overflow-y:auto">
                <div class="boarddiv" v-for="board in userBoards" :key="board.id">
                    <div class="boardname"><router-link :to="{ name: 'kanboard', params: {board_id: board.id} }" style="color: gray;">{{ board.name }}</router-link></div>
                    <div class="boardoptions">
                        <p><span class="">
                            <router-link v-if="board.type == 1" :to="{ name: 'kanboard', params: {board_id: board.id} }" class="text-primary"><i class="fa fa-eye"></i></router-link>
                            <router-link v-if="board.type == 2" :to="{ name: 'test', params: {board_id: board.id} }" class="text-primary"><i class="fa fa-eye"></i></router-link>
                            <a href="" @click.prevent="deleteBoard(board.id)" class="text-danger" title="Delete Board"><i class="fa fa-trash-o"></i></a>
                        </span></p>
                    </div>
                </div>             
            </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4 profilesec">
            <br/>
            <transition name="slide">
                <div class="mybox">
                    <div class="mybox-head">
                        <h6><strong>NEW BOARD</strong></h6>
                    </div>
                    <div class="mybox-body white-white-bg">
                        <div class="radio">
                            <p for="">Type:
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
                            </p>
						</div>
                        <p for="">Name: 
                            <span>
                                <input v-model="board.name" type="text" class="my-input my-inp-blk">
                            </span>
                        </p>
                        <p for="">Description: 
                            <span>
                                <!-- <input v-model="board.name" type="text" class="my-input my-inp-blk"> -->
                                <textarea v-model="board.desc" class="my-input my-inp-blk" rows="3"></textarea>
                            </span>
                        </p>
                    </div>
                    <div class="mybox-footer">
                        <div class="row form-group text-center">
                            <div class="col-md-6">
                                <button @click="cancel" class="btn btn-danger btn-sm btn-block" type="button">CANCEL</button>
                            </div>
                            <div class="col-md-6">
                                <button @click="createBoard" class="btn btn-success btn-sm btn-block" type="button" value="">CREATE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <div class="col-md-1"></div>
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
        padding: 7px 10px;
    }
    .boarddiv:hover{
        background-color: white;
    }
    .boarddiv:hover .boardoptions{
        display: inline-block;
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



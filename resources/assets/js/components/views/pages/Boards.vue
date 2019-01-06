<template>
    <section class="main-main-container" style="background-color: whitesmoke;">
        <div class="col-md-1"></div> 
        <div class="first-column col-md-6">
            <h3 class=""><span class="fa fa-trello"></span> Boards</h3>
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
                <div href="/boards/kanban" class="boarddiv" v-for="board in userBoards" :key="board.id">
                    <div class="boardname"><router-link :to="{ name: 'kanboard', params: {board_id: board.id} }" style="color: gray;">{{ board.name }}</router-link></div>
                    <div class="boardoptions">
                        <p><span class="">
                            <router-link v-if="board.type == 1" :to="{ name: 'kanboard', params: {board_id: board.id} }" class="text-primary"><i class="fa fa-eye"></i></router-link>
                            <router-link v-if="board.type == 2" :to="{ name: 'scrumboard', params: {board_id: board.id} }" class="text-primary"><i class="fa fa-eye"></i></router-link>
                            <a href="" @click.prevent="updateBoard(board)" class="text-success" title="Edit Board"><i class="fa fa-edit"></i></a>
                            <a href="" @click.prevent="deleteBoard(board.id)" class="text-danger" title="Delete Board"><i class="fa fa-trash-o"></i></a>
                        </span></p>
                    </div>
                </div>             
            </div>
        </div>
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
									    <input v-model="board.type" value="1" type="radio" name="optionsRadios" :disabled="add ? false : true" checked="true"><span class="circle"></span><span class="check"></span>
									    Kanban
								    </label>
                                </span>
                                <span>
                                    <label>
									    <input v-model="board.type" value="2" type="radio" name="optionsRadios" :disabled="add ? false : true" checked="true"><span class="circle"></span><span class="check"></span>
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
                        <p for="">Share: 
                            <span>
                                <select @change="checkBox" v-model="board.share" class="my-input my-inp-blk">
                                    <option value="" selected>Only Me</option> 
                                    <option value="all">All</option> 
                                    <option value="web">Web</option> 
                                    <option value="creative">Creatives</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </span>
                        </p>
                        <div v-show="board.share">
                            <div class="form-group">
                                <input v-model="userdata.search" @input="search()" type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                            </div>
                            <div class="choose-mem" style="max-height: 130px; overflow:auto">
                                <div class="checkbox" v-for="user in users" :key="user.id"  >
                                    <label>
                                        <input type="checkbox" v-model="board.checkedNames" :value="user.department ? user.department.name+'_'+user.id : user.role.name+'_'+user.id">
                                        <span class="check"></span>
                                        {{ user.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mybox-footer">
                        <div class="row form-group text-center">
                            <div class="col-md-6">
                                <button @click="cancel" class="btn btn-danger btn-sm btn-block" type="button">CANCEL</button>
                            </div>
                            <div class="col-md-6">
                                <button v-if="add" @click="createBoard" class="btn btn-success btn-sm btn-block" type="button" value="">CREATE</button>
                                <button v-else @click="uBoard" class="btn btn-success btn-sm btn-block" type="button" value="">UPDATE</button>
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
                share: '',
                ids: [],
                checkedNames: []
            },
            userdata: {
                filter: '',
                search: '',
                notArchive: true
            },
            boarddata: {
                type: '',
                privacy: '',
                id: this.$store.state.loggedUser.id
            },
            add: true,
            pB: null
        }
    },

    created() {
        this.getUsersData();
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
                users: 'usersList',
                currentUser: 'currentUser',
                userBoards: 'userBoards'
            }),
            checkedUser() {
                let cuser = this.currentUser;
                let _this = this;
                this.users.forEach(function(user,index){ 
                    if(user.id == cuser.id) {
                        _this.users.splice(index,1);
                    } 
                }) 
                return this.users.map(
                    user => user.department ? user.department.name+'_'+user.id : user.role.name+'_'+user.id
                );
            }
    },

    methods: {
        getUsersData() {
            let data = this.userdata;
            this.$store.dispatch('setUsers', data)
                .then((response) => {
                    this.checkBox();
                })
        },

        getUserBoards() {
            this.$store.dispatch('getUserBoards', this.boarddata)
        },

        checkBox() {
            this.board.checkedNames = this.checkedUser;
            if(this.board.share == 'all'){
                this.board.checkedNames = this.checkedUser;
            }
            else if(this.board.share == 'web'){
                this.board.checkedNames = [];
                this.checkedUser.forEach(user => {
                    if(user.includes('Web')){
                        this.board.checkedNames.push(user);
                    }
                });
            }
            else if(this.board.share == 'creative'){
                this.board.checkedNames = [];  
                this.checkedUser.forEach(user => {
                    if(user.includes('Creatives')){
                        this.board.checkedNames.push(user);
                    }
                });          
            }
            else {
                this.board.checkedNames = [];
            }
            // console.log(this.credentials.checkedNames);
            
        },

        search: _.debounce(function (e) {
            this.getUsersData();
        }, 500),

        cancel() {
            this.board.type = 1
            this.board.name = '';
            this.board.share = '';
            this.board.checkedNames = [];
            this.userdata.search = '';
            this.add = true
        },

        createBoard() {
            let newId = this.board.checkedNames.map(
                    val => val.split('_')[1]
                );
            this.board.ids = newId;
            this.$store.dispatch('createBoard', this.board)
                .then(() => {
                    this.board.type = 1;
                    this.board.name = '';
                    this.board.share = '';
                    this.board.ids = [];
                    this.board.checkedNames = [];
                })
        },

        deleteBoard(id) {
            this.$store.dispatch('deleteBoard', id)
                .then(() => {
                    this.$toaster.warning('Board deleted succesfully!.')
                })
            
        },

        updateBoard(board) {
            if(this.pB != board) {
                this.board.checkedNames = []
                this.add = false;
                this.board.type = board.type;
                this.board.name = board.name;

                if(board.privacy == 2) {
                    this.board.share = 'custom'
                    board.board_users.forEach(user => {
                        this.board.checkedNames.push(user.department ? user.department.name+'_'+user.id : user.role.name+'_'+user.id)
                    });
                }
                else {
                    this.board.share = ''
                }
                
                this.board.id = board.id
                this.pB = board;
            }
            else {
                this.board.type = '';
                this.board.name = '';
                this.board.share = '';
                this.board.checkedNames = []
                this.pB = null;
                this.add = true;
            }

            
        },

        uBoard() {
            let newId = this.board.checkedNames.map(
                val => val.split('_')[1]
            );
            this.board.newId = newId;
            this.$store.dispatch('uBoard', this.board)
                .then(() => {
                    this.$toaster.success('Board Updated Successfully');
                    this.board.type = '';
                    this.board.name = '';
                    this.board.share = '';
                    this.board.checkedNames = []
                    this.pB = null;
                    this.add = true;
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



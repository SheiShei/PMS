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
                <router-link :to="{ name: 'kanboard', params: {board_id: board.id} }" href="/boards/kanban" class="boarddiv" v-for="board in userBoards" :key="board.id">
                    <div class="boardname">{{ board.name }}</div>
                    <div class="boardoptions">
                        <p><span class="">
                            <a class="text-success" title="Delete Board"><i class="fa fa-edit"></i></a>
                            <a @click="deleteBoard(board.id)" class="text-danger" title="Close"><i class="fa fa-trash-o"></i></a>
                        </span></p>
                    </div>
                </router-link>             
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
									    <input v-model="board.type" value="1" type="radio" name="optionsRadios" checked="true"><span class="circle"></span><span class="check"></span>
									    Kanban
								    </label>
                                </span>
                                <span>
                                    <label>
									    <input v-model="board.type" value="2" type="radio" name="optionsRadios" checked="true"><span class="circle"></span><span class="check"></span>
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
            }
        }
    },

    created() {
        this.getUsersData();
        this.getUserBoards();
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
        },

        createBoard() {
            let newId = this.board.checkedNames.map(
                    val => val.split('_')[1]
                );
            this.board.ids = newId;
            this.$store.dispatch('createBoard', this.board);
        },

        deleteBoard(id) {
            this.$store.dispatch('deleteBoard', id)
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



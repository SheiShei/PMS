<template>
        <section class="main-main-container" id="message-component" v-if="currentUser">
            <div class="title-head">
                <h2><span class="fa fa-commenting-o"></span> Messages <small></small></h2>
            </div>
            <div class="col-md-9">
                <div class="mybox" style="margin: 20px 10px">
                    <div class="mybox-body msg-main-body white-white-bg">

                        <div class="contacts-cont">
                            <div class="cont-head" style="background-color: rgba(200, 200, 200, 0.2);">
                                <ul class="nav nav-pills nav-pills-primary">
                                    <li class="active">
                                        <a href="#pill1" class="btn-block" data-toggle="tab">
                                            <span class="hidden-md hidden-lg fa fa-user-o"></span>
                                            <span class="hidden-sm hidden-xs">Person</span>
                                        </a>
                                    </li>
                                    <li><a href="#pill2" class="btn-block" data-toggle="tab">
                                        <span class="hidden-md hidden-lg fa fa-users"></span>
                                        <span class="hidden-sm hidden-xs">Group</span></a>
                                    </li>
	                            </ul>
                            </div>

                            <div class="cont-body">
                                <div class="tab-content">

	                    	        <div class="tab-pane active" id="pill1">

                                        <div class="cont-search">
                                            <form action="">
                                                <div class="input-group">
	        									    <div class="form-group is-empty">
                                                        <input v-model="data.search" @input="search()" type="search" value="" placeholder="Search people..." class="form-control">
                                                        <span class="material-input"></span>
                                                    </div>
                                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- <router-link ref="you_convo" :to="{ name: 'convo-view', params: {convo_id: currentUser.slug} }" href="" class="cont-name">
                                            <div class="media">
		        					            <a @click.prevent class="pull-left" href="">
		        						            <div class="avatar">
		        							            <img class="media-object" :alt="currentUser.name+'profile picture'" :src="currentUser.picture">
		        						            </div>
		        					            </a>
		        					            <div class="media-body">
		        						            <h4 class="media-head">You <small class=""><span class="label label-success unread-label">2</span></small></h4>
		        						            <p class="prev-msg"> Don't forget, You're Aweso...</p>
                                                </div>
		        					        </div>
                                        </router-link> -->

                                        <router-link ref="dm_convo1"  v-for="user in users" :key="user.id" v-if="currentUser.id != user.id" :to="{ name: 'convo-view', params: {convo_id: user.slug} }"  href="" class="cont-name">
                                            <div class="media">
		        					            <a @click.prevent class="pull-left" href="">
		        						            <div class="avatar">
		        							            <img class="media-object" :alt="user.name+'profile picture'" :src="user.picture">
		        						            </div>
		        					            </a>
		        					            <div class="media-body">
		        						            <h4 class="media-head">{{ user.name }}</h4>
                                                </div>
		        					        </div>
                                        </router-link>

	                    	        </div>

	                    	        <div class="tab-pane" id="pill2">
                                        <div class="cont-search">
                                            <form action="">
                                                <div class="input-group">
	        									    <div class="form-group is-empty"><input v-model="searchGroup" @input="searchGroupM()" type="search" value="" placeholder="Search group..." class="form-control"><span class="material-input"></span></div>
                                                    <span class="input-group-addon">
	        									        <i class="fa fa-search"></i>
	        									    </span>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- <div > -->
                                            <router-link v-for="convo in conversations" :key="convo.id" :to="{ name: 'convo-view', params: {convo_id: convo.id} }" href="" class="cont-name">
                                                <div class="media">
                                                    <div class="media-body thread-head">
                                                        <h4 class="media-head">{{ convo.name }}<small></small></h4>
                                                    </div>
                                                </div>
                                            </router-link >
                                        <!-- </div> -->

                                        <div class="cont-footer">
                                            <button @click="showThreadForm = !showThreadForm" class="btn btn-xs btn-block btn-info">
                                                <span class="fa fa-plus fa-sm"></span>&nbsp;New Group Chat
                                            </button>
                                        </div>
                                    </div>
	                    	    </div>
                            </div>
	                    </div>
                        <router-view></router-view>

                    </div>
                       
                </div>
            </div>
            <div class="col-md-3">
                <transition name="fade">
                    <div class="taskchart shadow mt-4" v-show="showThreadForm">
                        <p class="nm-top txt-bold"><span class="fa fa-plus-square-o text-info"></span> Create New Group Chat</p>
                        <hr/>
                        <form @submit.prevent="addConvo" >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group is-empty">
                                        <label class="control-label">Group Name</label> 
                                        <input v-model="credentials.name" type="text" class="form-control" required> 
                                        <span class="material-input"></span>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Share with</label> 
                                    <div class="btn-group bootstrap-select">
                                        <select @change="checkBox" class="selectpicker" v-model="privacy" data-style="btn btn-sm btn-info btn-simple" type="text">
                                        <!-- <option selected disabled="">Privacy</option> -->
                                            <option value="all">All</option>
                                            <option value="web">Web Team</option>
                                            <option value="creative">Creatives Team</option>
                                            <option value="custom">Custom</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <input v-model="data.search" @input="search()" type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                                </div>
                                <div class="choose-mem" style="max-height: 130px; overflow:auto">
                                    <div class="checkbox" v-for="user in users" :key="user.id"  >
                                        <label>
                                            <input type="checkbox" v-model="credentials.checkedNames" :value="user.department ? user.department.name+'_'+user.id : user.role.name+'_'+user.id">
                                            <span class="check"></span>
                                            {{ user.name }}
                                        </label>
                                    </div>
                                </div>
                                <div>
                            </div>
                                </div>
                             </div>
                             <div class="row form-group text-center">
                                <div class="col-md-6">
                                    <button @click="showThreadForm = !showThreadForm" class="btn btn-block btn-default btn-sm" type="button">Close</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info btn-sm btn-block" type="submit" value="">OK!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </transition>
            </div>
        </section>
</template>

<script>
import {mapGetters} from 'vuex';
import Conversation from "./messages/Conversation.vue";
export default {
    components: {
        messageConversation: Conversation
    },
    data () {
        return {
            privacy: 'all',
            showThreadForm: false,
            showFileChoser: false,
            data: {
                filter: '',
                search: '',
                notArchive: true
            },
            credentials: {
                name: '',
                checkedNames: [],
            },
            searchGroup: ''
        }
    },
    created() {
        this.getConversationsList();
        this.getUsersData();

    },
    mounted () {
        this.listenEcho();
    },
    destroyed() {
        this.$store.commit('messageDestroy');
    },
    computed: {
        ...mapGetters({
                users: 'usersList',
                currentUser: 'currentUser',
                conversations: 'conversationsList'
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
            let data = this.data
            this.$store.dispatch('setUsers', data)
                .then((response) => {
                    this.checkBox();
                })
        },
        getConversationsList() {
            this.$store.dispatch('getAllConvo', this.searchGroup)
        },
        checkBox() {
            this.credentials.checkedNames = this.checkedUser;
            if(this.privacy == 'all'){
                this.credentials.checkedNames = this.checkedUser;
            }
            else if(this.privacy == 'web'){
                this.credentials.checkedNames = [];
                this.checkedUser.forEach(user => {
                    if(user.includes('Web')){
                        this.credentials.checkedNames.push(user);
                    }
                });
            }
            else if(this.privacy == 'creative'){
                this.credentials.checkedNames = [];  
                this.checkedUser.forEach(user => {
                    if(user.includes('Creatives')){
                        this.credentials.checkedNames.push(user);
                    }
                });          
            }
            else if(this.privacy == 'custom'){
                this.credentials.checkedNames = [];
            }
            // console.log(this.credentials.checkedNames);
            
        },

        setFocus() {
            // this.$refs.dm_convo.$el.focus();

        },

        addConvo() {
            let newId = this.credentials.checkedNames.map(
                    val => val.split('_')[1]
                );
            let data = {
                name: this.credentials.name,
                ids: newId
            }
            this.$store.dispatch('addConvo', data);
            // this.credentials.checkedNames = [];
            this.credentials.name = '';
        },

        listenEcho() {
            var _this = this
            Echo.private('addconvo')
                .listen('AddConversationEvent', (e) => {
                    let found = e.newConversation.users.find(function(element) {
                        return element.slug == _this.currentUser.slug
                    });
                    if(found) {
                        // console.log(e);
                        this.$store.commit('addConvo', e.newConversation.newConvo);
                    }
                })
                .listen('AddConvoMemberEvent', (e) => {
                    let found = e.newConversation.users.find(function(element) {
                        return element.slug == _this.currentUser.slug
                    });
                    if(found) {
                        // console.log(e);
                        this.$store.commit('addConvo', e.newConversation.newConvo);
                    }
                })
        },

        search: _.debounce(function (e) {
            this.getUsersData();
        }, 500),

        searchGroupM: _.debounce(function (e) {
            this.getConversationsList();
        }, 500),
    }
}
</script>

<style scoped>
    .slide-enter-active, .slide-leave-active {
        transition: transform .5s ease-out, opacity .5s ease-out;
    }

    .slide-enter, .slide-leave-to {
        transform: scale(0);
        opacity: 0;
    }
</style>

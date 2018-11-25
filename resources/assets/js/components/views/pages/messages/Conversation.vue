<template>
    <div class="main-msg-body">
        <div class="msg-head" style="background-color:rgb(13, 181, 202)">
            <div class="msg-head-1">
                <div class="dropdown">
                    <h4 v-if="selectedConvo || receiverData" class="media-head head-name">{{ selectedConvo ? selectedConvo.name : receiverData.name }}</h4>
                </div>
            </div>

            <div class="msg-head-2" v-if="selectedConvo">
                <div class="dropdown pull-right">
	                <button href="#" class="dropdown-toggle btn btn-simple btn-info btn-white btn-xs" data-toggle="dropdown" aria-expanded="true">
                        <span class="fa fa-gears fa-xs"></span>
                        <b class="caret"></b>
                        <div class="ripple-container"></div>
                    </button>
	                <ul class="dropdown-menu dropdown-menu-right ">
	                    <li><a href="#" data-toggle="modal" data-target="#membersAddModal" >New Member</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#membersEditModal" >Edit Members</a></li>
	                    <li class="divider"></li>
	                    <li><a href="#" data-toggle="modal" data-target="#confirmLeaveModal">Leave</a></li>
	                </ul>
			    </div>

                <div class="dropdown pull-right"  >
                    <button href="#pablo" class="dropdown-toggle btn btn-simple btn-info btn-white btn-xs" data-toggle="dropdown" aria-expanded="true">
                        <span class="fa fa-user-o fa-xs"></span>
                        <div class="ripple-container"></div>
                    </button>
	                <ul id="membersDrop" class="dropdown-menu dropdown-menu-left">
	                    <router-link style="color:white" :to="{ name: 'convo-view', params: {convo_id: selectedConvo.created_by.slug} }"><li><p class="memDrop"><span class="fa fa-star-o"></span> {{ selectedConvo.created_by.name }}</p></li></router-link>
	                    <li class="divider"></li>
	                    <router-link style="color:white" v-for="user in convoUsers" :key="user.id" v-if="selectedConvo.created_by.id != user.id" :to="{ name: 'convo-view', params: {convo_id: user.slug} }"><li><p class="memDrop">{{ user.name }}</p></li></router-link>
	                </ul>
                </div>
            </div>
        </div>
            
        <div class="msg-display">
            <div v-for="message in messages" :key="message.id">
                <div v-if="message.action == 1">
                    <!-- if my message -->
                    <div v-if="message.sender_id == cUser.id">
                        <!-- normal -->
                        <div class="msg-wrap" v-if="message.sender_id == cUser.id && message.text">
                            <div class="media">
                                <div class="pull-right">
                                    <div class="avatar ">
                                        <img class="media-object" alt="Tim Picture" :src="message.sender.picture">
                                    </div>
                                </div>
                                <div class="media-body my-msg">
                                    <p class="msg-text text-right">{{ message.text }}</p>
                                </div>
                                <div class="my-time-sent-div">
                                    <p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
                                </div>
                            </div>
                        </div>

                        <!-- pic -->
                        <div class="msg-wrap" v-if="message.sender_id == cUser.id && (message.extension === 'jpg' || message.extension === 'png' || message.extension === 'gif' || message.extension === 'jpeg')">
                            <div class="media">
                                <div class="pull-right">
                                    <div class="avatar ">
                                        <img class="media-object" alt="Tim Picture" :src="message.sender.picture">
                                    </div>
                                </div>
                                <div class="media-body my-msg">
                                    <a :href="'/storage/messages/'+message.new_filename" title="Click to download" download>
                                        <img :src="'/storage/messages/'+message.new_filename" class="msg-img" alt="" sizes="" srcset="">
                                    </a>
                                </div>
                                <div class="my-time-sent-div">
                                    <p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
                                </div>
                            </div>
                        </div>

                        <!-- file -->
                        <div class="msg-wrap" v-if="message.sender_id == cUser.id && message.original_filename && !(message.extension == 'jpg' || message.extension == 'png' || message.extension == 'gif' || message.extension == 'jpeg')">
                            <div class="media">
                                <div class="pull-right">
                                    <div class="avatar ">
                                        <img class="media-object" alt="Tim Picture" :src="message.sender.picture">
                                    </div>
                                </div>
                                <div class="media-body my-msg">
                                    <a :href="message.new_filename" class="text-gray filedisp" download>
                                        <span class="fa fa-file-text-o"></span>&nbsp;{{ message.original_filename }}
                                    </a>
                                </div>
                                <div class="my-time-sent-div">
                                    <p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="message.sender_id != cUser.id">
                        <!-- normal -->
                        <div class="msg-wrap" v-if="message.sender_id != cUser.id && message.text">
                            <div class="media">

                                <div class="pull-left">
                                    <div class="avatar ">
                                        <img class="media-object" alt="Tim Picture" :src="message.sender.picture">
                                    </div>
                                </div>

                                <div class="media-body their-msg">
                                    <p class="msg-text">{{ message.text }}</p>
                                </div>

                                <div class="their-time-sent-div">
                                    <p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
                                </div>

                            </div>
                        </div>

                        <!-- picture -->
                        <div class="msg-wrap" v-if="message.sender_id != cUser.id && (message.extension === 'jpg' || message.extension === 'png' || message.extension === 'gif' || message.extension === 'jpeg')">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="avatar ">
                                        <img class="media-object" alt="Tim Picture" :src="message.sender.picture">
                                    </div>
                                </div>
                                <div class="media-body their-msg">
                                    <a :href="'/storage/messages/'+message.new_filename" title="Click to download" download>
                                        <img :src="'/storage/messages/'+message.new_filename" class="msg-img" alt="" sizes="" srcset="">
                                    </a>
                                </div>
                                <div class="their-time-sent-div">
                                    <p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
                                </div>
                            </div>
                        </div>

                        <!-- file -->
                        <div class="msg-wrap" v-if="message.sender_id != cUser.id && message.original_filename && !(message.extension == 'jpg' || message.extension == 'png' || message.extension == 'gif' || message.extension == 'jpeg')">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="avatar ">
                                        <img class="media-object" alt="Tim Picture" :src="message.sender.picture">
                                    </div>
                                </div>
                                <div class="media-body their-msg">
                                    <a :href="message.new_filename" class="text-gray filedisp" download>
                                        <span class="fa fa-file-text-o"></span>&nbsp;{{ message.original_filename }}
                                    </a>
                                </div>
                                <div class="their-time-sent-div">
                                    <p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="msg-input">

            <!-- <div v-if="showFileChoser" class="form-group is-empty msg-input-wrap">
                <div class="input-group btn-block">
                    <div class="form-group form-file-upload is-fileinput" style="background-color: #EAF3F2; padding: 6px;"> -->
			            <input ref="files" v-show="false" @change="onFileChange" type="file" id="inputFile3" multiple class="form-control">
			            <!-- <div class="input-group">
				            <input type="text" readonly="" class="form-control" placeholder="Chosen files will be displayed here...">
				            <span class="input-group-btn input-group-s">
					            <button type="button" class="btn btn-xs btn-round btn-info">
					                Choose file(s)
					            </button>
				            </span>
			            </div>
                    </div>
                </div>
            </div> -->

            <div class="form-group is-empty msg-input-wrap">
                <button @click="chooseFile" type="button" class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center">
                    <i class="fa fa-paperclip"></i>
                </button>
                <textarea @keyup.ctrl.enter="messageSend()" v-model="messageTxt" class="form-control" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                <button @click="messageSend()" class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
            </div>

            <!--Leave Confirmation Modal -->
            <convo-leave-confirmation-modal></convo-leave-confirmation-modal>
            
            <!-- Edit Members Modal-->
            <convo-edit-member-modal></convo-edit-member-modal>

            <!-- New Member Modal-->
            <convo-new-member-modal></convo-new-member-modal>

        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
import NewMemberModal from "./NewMemberModal.vue";
import EditMemberModal from "./EditMemberModal.vue";
import LeaveConfirmationModal from "./LeaveConfirmationModal.vue";
export default {
    components: {
        convoNewMemberModal: NewMemberModal,
        convoEditMemberModal: EditMemberModal,
        convoLeaveConfirmationModal: LeaveConfirmationModal,
    },
    data() {
        return {
            messageTxt: '',
            attachments:[],
            form: new FormData
        }
    },
    created() {
        this.getConvoUsers();
        this.getMessages();
    },
    watch: {
        '$route' (to, from) {
            this.getConvoUsers();
            this.getMessages();
        }
    },
    computed: {
        ...mapGetters({
                convoUsers: 'getConvoUsers',
                selectedConvo: 'getSelectedConvo',
                receiverData: 'getReceiverData',
                users: 'usersList',
                messages: 'getConvoMessages',
                cUser: 'currentUser',
            }),
    },
    methods: {
        getConvoUsers() {
            // console.log();
            let slug = this.$route.params.convo_id;
            this.$store.dispatch('getConvoUsers', slug);
        },
        chooseFile() {
            $("#inputFile3").click();
        },

        onFileChange(e) {
            this.attachments = [];
            let selectedFiles=e.target.files;
            let form = new FormData;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                this.attachments.push(selectedFiles[i]);
            }

            // console.log(this.attachments);
            for(let i=0; i<this.attachments.length;i++){
                    form.append('files[]',this.attachments[i]);
            }
            
            if(this.selectedConvo){
                form.append('convo', this.selectedConvo.id)
                form.append('receiver', null)
            }
            else {
                form.append('receiver', this.receiverData.id)
                form.append('convo', null)
            }
                
            this.$store.dispatch('sendFiles', form)
                .then((response) => {
                    document.getElementById('inputFile3').value=[];
                })
        },

        getMessages() {
            let slug = this.$route.params.convo_id;
            this.$store.dispatch('getMessages', slug);
        },

        messageSend() {
            let data;
            if(this.selectedConvo){
                data = {
                    text: this.messageTxt,
                    convo: this.selectedConvo.id,
                    receiver: null
                }
            } 
            else{
                data = {
                    text: this.messageTxt,
                    convo: null,
                    receiver: this.receiverData.id
                }
            }

            this.$store.dispatch('sendMessage', data);
        }
    }
}
</script>
<template>
    <div class="main-msg-body">
        <div class="msg-head" style="background-color:rgb(13, 181, 202)">
            <div class="msg-head-1">
                <div class="dropdown">
                    <h4 class="media-head head-name">GO Team</h4>
                </div>
            </div>

            <div class="msg-head-2">
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

                <div class="dropdown pull-right">
                    <button href="#pablo" class="dropdown-toggle btn btn-simple btn-info btn-white btn-xs" data-toggle="dropdown" aria-expanded="true">
                        <span class="fa fa-user-o fa-xs"></span>
                        <div class="ripple-container"></div>
                    </button>
	                <ul id="membersDrop" class="dropdown-menu dropdown-menu-left">
	                    <li><p class="memDrop"><span class="fa fa-star-o"></span> Yanna</p></li>
	                    <li class="divider"></li>
	                    <li><p class="memDrop">Yanna</p></li>
	                    <li><p class="memDrop">Bebex</p></li>
	                    <li><p class="memDrop">Hux</p></li>
	                    <li><p class="memDrop">Ken</p></li>
	                    <li><p class="memDrop">Ching</p></li>
	                </ul>
                </div>
            </div>
        </div>
            
        <div class="msg-display">
            <div class="msg-wrap">
                <div class="media">

                    <div class="pull-left">
					    <div class="avatar ">
						    <img class="media-object" alt="Tim Picture" src="/images/pp.jpg">
					    </div>
                    </div>

				    <div class="media-body their-msg">
					    <p class="msg-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia eligendi magni, doloribus explicabo consectetur quibusdam eos facere ipsa amet debitis totam aliquid eius, eveniet sed mollitia dolore ratione possimus reiciendis.</p>
                    </div>

                    <div class="their-time-sent-div">
						<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
				    </div>

				</div>
            </div>

            <div class="msg-wrap">
                <div class="media">
				    <div class="pull-left">
					    <div class="avatar ">
						    <img class="media-object" alt="Tim Picture" src="/images/pp.jpg">
					    </div>
                    </div>
                    <div class="media-body their-msg">
                        <a href="/images/sample.jpg" title="Click to download" download>
                            <img src="/images/sample.jpg" class="msg-img" alt="" sizes="" srcset="">
                        </a>
				    </div>
                    <div class="their-time-sent-div">
						<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
				    </div>
				</div>
            </div>
               
            <div class="msg-wrap">
                <div class="media">
                    <div class="pull-right">
					    <div class="avatar ">
						    <img class="media-object" alt="Tim Picture" src="/images/pp.jpg">
					    </div>
                    </div>
				    <div class="media-body my-msg my-msg-file">
                        <a href="/images/sample.docx" class="text-white filedisp" download>
                            <span class="fa fa-file-text-o"></span>&nbsp;filename.docx
                        </a>
                    </div>
                    <div class="my-time-sent-div">
						<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
				    </div>
				</div>
            </div>

            <div class="msg-wrap">
                <div class="media">
                    <div class="pull-right">
					    <div class="avatar ">
						    <img class="media-object" alt="Tim Picture" src="/images/pp.jpg">
					    </div>
                    </div>
				    <div class="media-body my-msg">
					    <p class="msg-text text-right">Okiee!</p>
				    </div>
                    <div class="my-time-sent-div">
						<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
				    </div>
				</div>
            </div>

            <div class="msg-wrap">
                <div class="media">
				    <div class="pull-left">
					    <div class="avatar ">
						    <img class="media-object" alt="Tim Picture" src="/images/pp.jpg">
					    </div>
                    </div>
                    <div class="media-body their-msg">
					    <p class="msg-text">Lorem ipsum dolor sit</p>
                    </div>
                    <div class="their-time-sent-div">
						<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
				    </div>
                </div>
            </div>

            <div class="msg-wrap">
                <div class="date-sent mr-auto ml-auto">
                    September 7, 2018
                </div>
            </div>

            <div class="msg-wrap">
                <div class="media">
                    <div class="pull-left">
					    <div class="avatar ">
						    <img class="media-object" alt="Tim Picture" src="/images/pp.jpg">
					    </div>
                    </div>
				    <div class="media-body their-msg">
					    <p class="msg-text">Lorem ipsum dolor sitlorem Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus optio eum rerum fugit a consequuntur sapiente quam dignissimos</p>
                    </div>
                    <div class="their-time-sent-div">
						<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
				    </div>
				</div>
            </div>

            <div class="msg-wrap">
                <div class="media">
                    <div class="pull-left">
					    <div class="avatar ">
						    <img class="media-object" alt="Tim Picture" src="/images/pp.jpg">
					    </div>
                    </div>
				    <div class="media-body their-msg">
					    <a href="/images/sample.docx" class="text-gray filedisp" download>
                            <span class="fa fa-file-text-o"></span>&nbsp;filename.docx
                        </a>
				    </div>
                    <div class="their-time-sent-div">
						<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
				    </div>
				</div>
            </div>
        </div>

        <div class="msg-input">

            <!-- <div v-if="showFileChoser" class="form-group is-empty msg-input-wrap">
                <div class="input-group btn-block">
                    <div class="form-group form-file-upload is-fileinput" style="background-color: #EAF3F2; padding: 6px;"> -->
			            <input v-show="false" @change="onFileChange" type="file" id="inputFile3" multiple="" class="form-control">
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
                <textarea class="form-control" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                <button  class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
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
import NewMemberModal from "./NewMemberModal.vue";
import EditMemberModal from "./EditMemberModal.vue";
import LeaveConfirmationModal from "./LeaveConfirmationModal.vue";
export default {
    components: {
        convoNewMemberModal: NewMemberModal,
        convoEditMemberModal: EditMemberModal,
        convoLeaveConfirmationModal: LeaveConfirmationModal,
    },
    methods: {
        chooseFile() {
            $("#inputFile3").click();
        },

        onFileChange(file) {
            let files = file.target.files || file.dataTransfer.files;
            let data = new FormData();
            if(files.length > 0) {
                console.log(files);
                // let file = files[0];
                // let filename = file.name;
                // let filesize = file.size;
                // let extension = this.findExtension(filename);
                // if(extension == 'pdf') {
                //     this.type = 2;
                // } else if(extension == 'zip') {
                //     this.type = 3;
                // }

                // // if uploaded file is valid with validation rules
                // if(this.validateFile(filesize,extension)) {
                //     data.append('file',files[0]);
                //     data.append('type',this.type);
                //     axios.post(this.url+'/fileUpload/'+this.userId,data).then( response=> {
                //         this.emitMessage(response);
                         
                //     });
                // }
            }
                
        }
    }
}
</script>
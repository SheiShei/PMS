<template>
    <!--VIEW TASK-->
    <transition name="fade">
        <div class="overlay" v-if="data">
            <div class="close-mod-btn">
                <button @click="$router.go(-1)" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="taskView" style="">

                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="taskchart shadow"> -->
                            <div class="row">
                                <div class="col-md-9 col-xs-9 col-sm-9">
                                    <h4 class="nm-bottom"><span class="fa fa-tasks"></span><span> {{ data.name }}</span></h4>
                                </div>
                                <div class="col-md-3 col-xs-3 col-sm-3 text-right">
                                    <h4 class="nm-bottom">
                                        <span v-if="!editTaskDet && taskPermission.modify"><a href="" @click.prevent="editTaskDet=!editTaskDet" class="btn btn-simple btn-close" title="Edit Details"><span class="fa fa-pencil"></span></a></span>
                                        <span v-if="editTaskDet"><a href="" @click.prevent="editTaskDet=!editTaskDet" class="btn btn-simple btn-close" title="Save and Close"><span class="fa fa-check text-success"></span></a></span>
                                        <!-- <span class="pull-right"><router-link :to="{name: 'us_view', params: {us_id: this.$route.params.us_id, sprint_id: this.$route.params.sprint_id}}" class="btn btn-simple btn-close" title="Close"><i class="fa fa-close"></i></router-link></span> -->
                                        <span v-if="taskPermission.delete" class=""><button @click="dT()" class="btn btn-simple btn-close" title="Delete This Task"><i class="fa fa-trash-o"></i></button></span>
                                    </h4>
                                </div>
                            </div>

                            <div class="row" v-if="editTaskDet">
                                <div class="col-md-12">
                                    <p class="text-success no-margin"><small>You're on EDIT MODE</small></p>
                                </div>
                            </div>
                            <div class="row" v-if="editTaskDet">
                                <div class="col-md-12">
                                    <div class="">
                                        <label for="" class="control-label">Task Name:</label>
                                        <input @input="debounceWait" v-model="data.name" type="text" class="my-input my-inp-blk">
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="editTaskDet">
                                <div class="col-md-12">
                                    <div class="">
                                        <label for="" class="control-label">Description:</label>
                                        <textarea @input="debounceWait" v-model="data.description" class="my-text-area my-inp-blk"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="editTaskDet">
                                <div class="col-md-6">
                                    <label for="" class="control-label"><span class="fa fa-user-o"></span> Assign To:</label>
                                    <select @change="updateSprintTask" required v-model="updateData.assign_to" class="my-input my-inp-blk" >
                                        <option value="">Unassign</option>
                                        <option v-for="user in boardMembers" :key="user.id" :value="user.id">{{ user.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6" v-if="editTaskDet">
                                    <label for="" class="control-label"><span class="fa fa-clock-o"></span> Due:</label>
                                    <date-picker class="my-inp-blk" @change="changeDateFormat" v-model="updateData.due" format="YYYY-MM-DD" :not-before="new Date().setDate(new Date().getDate()+1)" lang="en"></date-picker>
                                </div>
                            </div>

                            <hr/>
                           <div class="row" v-if="!editTaskDet">
                                <div class="col-md-12">
                                    <p v-if="data.jo_id"><small>Task from JO '{{ data.joborder.name }}'</small></p>
                                    <p class="text-gray"><small>{{ data.description }}</small></p>
                                    
                                </div>
                            </div>
                            

                            <div class="row" v-if="!editTaskDet">
                                <div class="col-md-6 text-center">
                                    <p class="no-margin"><small><span title="click to edit" class="fa fa-user-o"></span>
                                    Assigned to:</small></p>
                                    <p>
                                    <span>{{ data.assigned_to.name }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <p class="no-margin"><small><span class="fa fa-clock-o"></span>
                                    Due Date:</small></p> 
                                    <p><span>{{ data.due | moment("MMM D, YYYY") }}
                                    </span>
                                    </p>
                                </div>
                            </div>

                            <hr/>

                            
                            <!-- <div class="row" v-if="!editTaskDet">
                                <div class="col-md-12">
                                    <p v-if="data.jo_id"><small>Task from JO no. 237874910</small></p>
                                    <p class="text-gray"><small>{{ data.description }}</small></p>
                                    
                                </div>
                            </div>
                            <hr/> -->

                        <!-- </div> -->
                        <div class="row">
                            <div class="col-md-12">
                                <p class="txt-bold"><span class="fa fa-files-o"></span> Attachments</p>
                            </div>
                        </div>

                        <div class="row" v-if="data.files.length">
                            <div class="col-md-12">
                                <div id="ataskment-wrapper">
                                    <div v-for="attachment in data.files" :key="attachment.id">
                                        <div class="ataskment" v-if="attachment.extension == 'jpg' || attachment.extension == 'jpeg' || attachment.extension == 'png' || attachment.extension == 'gif'">
                                            <div class="media">
                                                <div class="media-left media-top">
                                                    <a href="" @click.prevent="openGallery(attachment.new_filename, attachment.original_filename)" :style="'background-image: url(\'/storage/task/'+ attachment.new_filename +'\')'" class="ataskment-thumb">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><b>{{ attachment.original_filename }}</b></p>
                                                    <p ><span>{{ attachment.created_at | moment('calendar') }}</span> - <a v-if="taskPermission.modify" @click.prevent="setRemoveTaskPhoto(attachment.new_filename)" href=""><span v-if="data.task_cover != attachment.new_filename">Set</span><span v-else>Remove</span><!-- (di ko alam tawag) --></a></p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="ataskment" v-else>
                                            <div class="media">
                                                <div class="media-left media-top">
                                                    <a class="ataskment-thumb" :href="'/storage/task/'+attachment.new_filename" download>
                                                        <span><b>{{ attachment.extension }}</b></span>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><b>{{ attachment.original_filename }}</b></p>
                                                    <p><span>{{ attachment.created_at | moment('calendar') }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="taskPermission.modify">
                            <div class="col-md-12">
                                <input ref="files" v-show="false" @change="onFileChange" type="file" id="addAttachmentInput" multiple class="form-control">
                                <p style="cursor: pointer"><a @click.prevent="chooseFile" class="btn-default btn-simple btn-sm"><span class="fa fa-plus"></span> Add an Attachment</a></p>
                            </div>
                        </div>

                    </div>

                    <!--Second Column-->
                    <div class="col-md-6" style="height: 100%">
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="txt-bold">
                                     COMMENTS
                                     <span class="fa fa-comments-o"></span>
                                     </p>
                            </div>
                        </div>
                                <!-- <hr /> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="comments" v-if="comments">
                                    <div class="comment-box" style="" v-chat-scroll>
                                        <!-- simple -->
                                        <div class="comment-msg" v-for="comment in comments" :key="comment.id">
                                            <div class="comment-sender">
                                                <h6 class="txt-bold">
                                                    <span><img :src="comment.user.picture" class="comment-icon"></span>
                                                    {{ comment.user.name }} <small>{{ comment.created_at | moment('calendar') }}</small>
                                                </h6>
                                            </div>
                                            <div class="comment-comment">
                                                <p v-if="comment.text">{{ comment.text }}</p>
                                                <p v-if="comment.extension && !(comment.extension == 'jpg' || comment.extension == 'jpeg' || comment.extension == 'png' || comment.extension == 'gif')"><a class="btn btn-default btn-simple btn-xs" :href="'/storage/task/comment/'+comment.new_filename" download><span class="fa fa-file-o"></span> {{ comment.original_filename }}</a></p>
                                                <img @click="openComG(comment.new_filename, comment.original_filename)" v-if="comment.extension && (comment.extension == 'jpg' || comment.extension == 'jpeg' || comment.extension == 'png' || comment.extension == 'gif')" :src="'/storage/task/comment/'+comment.new_filename" :title="comment.original_filename" style="max-height: 100px; max-width: 100%; cursor: pointer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group is-empty comment-input-wrap" v-if="taskPermission.comment">
                                        <input ref="files" v-show="false" @change="cFile" type="file" id="cFile" multiple class="form-control">
                                        <button @click="openCFile" type="button" class="btn btn-md btn-info btn-simple">
                                            <i class="fa fa-paperclip"></i>
                                        </button>
                                        <textarea @keyup.ctrl.enter="cTxtSend" v-model="cTxt" class="form-control" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                                        <button @click="cTxtSend" class="btn btn-md btn-info btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-2">
                                            <input ref="files" v-show="false" @change="cFile" type="file" id="cFile" multiple class="form-control">
                                            <button @click="openCFile" type="button" class="btn btn-md btn-info btn-sm text-center">
                                                <i class="fa fa-paperclip"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea @keyup.ctrl.enter="cTxtSend" v-model="cTxt" class="my-text-area" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                                        </div>
                                        <div class="col-md-2">
                                            <button @click="cTxtSend" class="btn btn-md btn-info btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>




                </div>





















                <!-- <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <h4><span class="fa fa-tasks"></span> Make a new banner for the ganito & ganyan ang make it more beautiful</h4> -->
                        <!-- <h4><span class="fa fa-tasks"></span> <span @input="debounceWait" :id="'name_'+data.id" :contenteditable="taskPermission.modify">{{ data.name }}</span></h4> -->
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <!-- <h4 class="">
                            <span class="pull-right"><button @click="$router.go(-1)" class="btn btn-simple btn-close" title="Close"><i class="fa fa-close"></i></button></span>
                            <span v-if="taskPermission.modify" class="pull-right"><a @click="dT" class="btn btn-simple btn-close" title="Delete This Task"><i class="fa fa-trash-o"></i></a></span>
                        </h4> -->
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <h6><b>ABOUT</b></h6>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <p><span @click="taskPermission.modify ? clickAssigned = !clickAssigned : ''" title="click to edit" class="fa fa-user-o text-info"></span> <span @click="taskPermission.modify ? clickAssigned = !clickAssigned : ''" v-if="!clickAssigned">{{ data.assigned_to.name }}</span>
                                <select @change="updateSprintTask" style="width: 80%" v-if="clickAssigned" required v-model="updateData.assign_to" class="my-input my-inp-blk" >
                                    <option value="">Unassign</option>
                                    <option v-for="user in boardMembers" :key="user.id" :value="user.id">{{ user.name }}</option>
                                </select>
                                
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><span @click="taskPermission.modify ? isDueClicked = !isDueClicked : ''" class="fa fa-clock-o text-danger"></span> 
                                    <span v-if="!isDueClicked" @click="taskPermission.modify ? isDueClicked = !isDueClicked : ''">{{ data.due | moment("MMM D, YYYY") }}
                                    </span>
                                    <date-picker style="width:80%" v-if="isDueClicked" @change="changeDateFormat" v-model="updateData.due" :not-before="new Date().setDate(new Date().getDate()+1)" lang="en"></date-picker>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p v-if="data.jo_id"><small>Task from JO no. 237874910</small></p>
                                <div :class="taskPermission.modify ? 'testcntnt' : ''" @input="debounceWait" :id="'desc_'+data.id" :contenteditable="taskPermission.modify" placeholder="Empty space is boring... go on be descriptive...">{{ data.description }}</div>
                            </div>
                        </div>
                        <br>
                        <h6><b>ATTACHMENTS</b></h6>
                        <hr /> -->
                        <!-- <p><a class="btn-default btn-simple btn-sm" href="/images/sample.docx" download><span class="fa fa-file-o"></span> dsjdisdiasnd.txt</a></p>
                        <p style="cursor: pointer"><a @click="openGallery" class="btn-default btn-simple btn-sm"><span class="fa fa-photo"></span> View attached images</a></p> -->
                        <!-- <div class="row" v-if="data.files.length">
                            <div class="col-md-12">
                                <div id="ataskment-wrapper">
                                    <div v-for="attachment in data.files" :key="attachment.id">
                                        <div class="ataskment" v-if="attachment.extension == 'jpg' || attachment.extension == 'jpeg' || attachment.extension == 'png' || attachment.extension == 'gif'">
                                            <div class="media">
                                                <div class="media-left media-top">
                                                    <a href="" @click.prevent="openGallery(attachment.new_filename, attachment.original_filename)" :style="'background-image: url(\'/storage/task/'+ attachment.new_filename +'\')'" class="ataskment-thumb">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><b>{{ attachment.original_filename }}</b></p>
                                                    <p ><span>{{ attachment.created_at | moment('calendar') }}</span> - <a v-if="taskPermission.modify" @click.prevent="setRemoveTaskPhoto(attachment.new_filename)" href=""><span v-if="data.task_cover != attachment.new_filename">Set</span><span v-else>Remove</span></a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ataskment" v-else>
                                            <div class="media">
                                                <div class="media-left media-top">
                                                    <a class="ataskment-thumb" :href="'/storage/task/'+attachment.new_filename" download>
                                                        <span><b>{{ attachment.extension }}</b></span>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><b>{{ attachment.original_filename }}</b></p>
                                                    <p><span>{{ attachment.created_at | moment('calendar') }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="taskPermission.modify">
                            <div class="col-md-12">
                                <input ref="files" v-show="false" @change="onFileChange" type="file" id="addAttachmentInput" multiple class="form-control">
                                <p style="cursor: pointer"><a @click.prevent="chooseFile" class="btn-default btn-simple btn-sm"><span class="fa fa-plus"></span> Add an Attachment</a></p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="row">

            </div>
        </div>
    </transition>
</template>

<script>
import DatePicker from 'vue2-datepicker'
import {mapGetters} from 'vuex';
export default {
    components: {
        DatePicker 
    },
    props: ['usPermission', 'taskPermission'],
    data() {
        return {
            data: null,
            isError: false,
            updateData: {
                name: '',
                desc: '',
                id: '',
                assign_to: '',
                due: ''
            },
            clickAssigned: false,
            attachments: [],
            comFiles: [],
            cTxt: '',
            isDueClicked: false,
            editTaskDet: false
        }
    },

    created() {
        this.getTaskData();
        this.getComments();
    },

    mounted() {
        this.stopEventListeners();
        this.listenUpdates()
        $(".testcntnt").focusout(function(){
            var element = $(this);        
            if (!element.text().replace(" ", "").length) {
                element.empty();
            }
        });
    },

    destroyed() {
        this.stopEventListeners();
    },

    computed: {
        ...mapGetters({
                boardMembers: 'boardMembers',
                comments: 'getTCom',
            }),
    },

    methods: {
        chooseFile() {
            $("#inputFile3").click();
        },

        getTaskData() {
            axios.post('/api/getTaskData', {id: this.$route.params.task_id})
                .then((response) => {
                    this.data = response.data
                    this.updateData.assign_to = this.data.assigned_to.id;
                    this.updateData.due = this.data.due;
                })
        },

        debounceWait: _.debounce(function (e) {
            this.updateSprintTask();
        }, 1000),

        updateSprintTask() {
            // let contenteditableName = document.querySelector('#name_'+this.data.id).textContent;
            // let contenteditableDesc = document.querySelector('#desc_'+this.data.id).textContent;
            // this.updateData.name = contenteditableName;
            // this.updateData.desc = contenteditableDesc;
            this.updateData.name = this.data.name;
            this.updateData.desc = this.data.description;
            this.updateData.id = this.$route.params.task_id;
            this.updateData.board_id = this.$route.params.board_id;
            // console.log(this.updateData);
            this.$store.dispatch('updateSprintTask', this.updateData)
                .then(response => {
                    // console.log(response);
                    this.$store.commit('updateSprintTask', response);
                    this.data.assigned_to.name = response.assigned_to.name;
                    this.data.due = response.due;
                })
        },

        chooseFile() {
            $("#addAttachmentInput").click();
        },

        openCFile() {
            $("#cFile").click();
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

            form.append('task_id', this.$route.params.task_id);

            this.$store.dispatch('addAttachment', form)
                .then(response => {
                    response.forEach(attachment => {
                        // console.log(attachment);
                        this.data.files.push(attachment)
                    });
                })
        },

        setRemoveTaskPhoto(filename) {
            axios.patch('/api/taskPhoto', {filename: filename, id: this.$route.params.task_id, board_id: this.$route.params.board_id})
                .then(response => {
                    // console.log(response);
                    this.data.task_cover = response.data.task_cover
                    this.$store.commit('updateSprintTask', response.data);
                })
                .catch(error => {
                    console.log(error);
                })
        },

        openGallery(ff, name) {
            let gimg = [];
            gimg.push({name: name, src: '/storage/task/'+ff});
            this.data.files.forEach(attachment => {
                if(attachment.new_filename !== ff && (attachment.extension == 'jpg' || attachment.extension == 'jpeg' || attachment.extension == 'png' || attachment.extension == 'gif')) {
                    // gimg.push(attachment.new_filename)
                    gimg.push({name: attachment.original_filename, src: '/storage/task/'+attachment.new_filename})
                }
            });
            this.$store.commit('setGImg', gimg);
            this.$router.push({ name: 'sprint_gallery', params: {task_id: this.data.id} })
        },

        cFile(e) {
            this.comFiles = [];
            let selectedFiles=e.target.files;
            let form = new FormData;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                this.comFiles.push(selectedFiles[i]);
            }

            // console.log(this.comFiles);
            for(let i=0; i<this.comFiles.length;i++){
                form.append('files[]',this.comFiles[i]);
            }

            form.append('task_id', this.$route.params.task_id);
            // form.append('text', '');

            this.$store.dispatch('sendComment', form)
                .then(() => {
                    this.comFiles = [];
                    document.getElementById('cFile').value=[];
                    
                })
        },

        cTxtSend() {
            let form = new FormData;
            form.append('task_id', this.$route.params.task_id);
            form.append('text', this.cTxt);
            this.$store.dispatch('sendComment', form)
                .then(() => {
                    this.cTxt = ''
                })
        },

        getComments() {
            this.$store.dispatch('getComments', this.$route.params.task_id)
                
        },

        openComG(ff, name) {
            let gimg = [];
            gimg.push({name: name, src: '/storage/task/comment/'+ff});
            this.$store.commit('setGImg', gimg);

            this.$router.push({ name: 'sprint_gallery', params: {task_id: this.data.id} })

        },

        dT() {
            // this.$store.dispatch('deleteSprintTask', {id:this.data.id, board_id: this.$route.params.board_id})
            //     .then((response) => {
            //         this.$store.commit('deleteSprintTask', response)
            //         // if(this.$route.params.sprint_id) {
                    //     this.$router.push({name: 'sprint', params: {board_id: this.$route.params.board_id, sprint_id: this.$route.params.sprint_id}})
                    // }
                    // else {
                        // this.$router.push({name: 'test_sprint', params: {board_id: this.$route.params.board_id, sprint_id: this.$route.params.sprint_id}})
                        this.$router.push({ name: 'deletesprint', params: {cardid: this.data.id}});
                    // }
                    // this.$toaster.warning('Task deleted succesfully!.')
                // })
        },

        changeDateFormat() {
            this.updateData.due = moment(this.updateData.due).format('YYYY-MM-DD')
            this.updateSprintTask();
        },

        listenUpdates() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('UpdateListTaskEvent', (e) => {
                    this.data.task_cover = e.task.task_cover
                    this.data.description = e.task.description
                    this.data.name = e.task.name
                    this.data.due = e.task.due
                    this.data.assigned_to.name = e.task.assigned_to.name
                    this.updateData.assign_to = e.task.assigned_to.id
                    // console.log(e);
                    this.$store.commit('updateSprintTask', e.task);
                })
                .listen('DeleteListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteSprintTask', e.task_id);
                })
            Echo.private('task.'+this.$route.params.task_id)
                .listen('AddTaskAttachmentEvent', (e) => {
                    // console.log(e);
                    e.attachments.forEach(attachment => {
                        // console.log(attachment);
                        this.data.files.push(attachment)
                    });
                })
                .listen('SendTaskCommentEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('sendComment', e.comments)
                })
        },

        stopEventListeners() {
            Echo.leave('list.'+this.$route.params.board_id);
            Echo.leave('task.'+this.$route.params.task_id);
        }

    }
}
</script>

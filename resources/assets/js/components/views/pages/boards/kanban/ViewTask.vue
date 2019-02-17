<template>
    <!--VIEW TASK-->
    <transition name="fade">
        <div class="overlay" v-if="data">
             <div class="close-mod-btn">
                 <router-link :to="{ name: 'kanboard', params: {board_id: $route.params.board_id}}" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></router-link>
                <!-- <button @click="$router.go(-1)" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button> -->
            </div>
            <div class="taskView" style="">

                <div class="row">
                    <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="nm-bottom"><span class="fa fa-tasks"></span><span> {{ data.name }}</span></h4>
                                </div>
                                <div class="col-md-3 text-right">
                                    <h4 class="nm-bottom">
                                        <span v-if="per.modify"><a href="" v-if="!editTaskDet" @click.prevent="editTaskDet=!editTaskDet" class="btn btn-simple btn-close" title="Edit Details"><span class="fa fa-pencil"></span></a></span>
                                        <span v-if="per.modify"><a href="" v-if="editTaskDet" @click.prevent="editTaskDet=!editTaskDet" class="btn btn-simple btn-close" title="Save and Close"><span class="fa fa-check text-success"></span></a></span>
                                        <!-- <span class="pull-right"><router-link :to="{name: 'us_view', params: {us_id: this.$route.params.us_id, sprint_id: this.$route.params.sprint_id}}" class="btn btn-simple btn-close" title="Close"><i class="fa fa-close"></i></router-link></span> -->
                                        <span v-if="per.delete" class=""><a @click="dT" class="btn btn-simple btn-close" title="Delete This Task"><i class="fa fa-trash-o"></i></a></span>
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
                                    <select @change="updateTask" required v-model="updateData.assign_to" class="my-input my-inp-blk" >
                                        <option value="">Unassign</option>
                                        <option v-for="user in board.bu" :key="user.id" :value="user.id">{{ user.name }}</option>
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
                                    <p v-if="data.jo_id"><small>Task from JO no. 237874910</small></p>
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

        
                        <div class="row">
                            <div class="col-md-12">
                                <p class="txt-bold"><span class="fa fa-files-o"></span> Attachments</p>
                            </div>
                        </div>

                        <div class="row" v-if="data.files.length">
                            <div class="col-md-12">
                                <div id="ataskment-wrapper">
                                    <div v-for="attachment in data.files" :key="attachment.id">
                                        <div class="ataskment" v-if="attachment.extension == 'jpg' || 
                                                                    attachment.extension == 'JPG' || 
                                                                    attachment.extension == 'jpeg' || 
                                                                    attachment.extension == 'JPEG' || 
                                                                    attachment.extension == 'png' || 
                                                                    attachment.extension == 'PNG' || 
                                                                    attachment.extension == 'GIF' || 
                                                                    attachment.extension == 'gif'">
                                            <div class="media">
                                                <div class="media-left media-top">
                                                    <a href="" @click.exact="openGallery(attachment.new_filename, attachment.original_filename)" :style="'background-image: url(\'/storage/task/'+ attachment.new_filename +'\')'" class="ataskment-thumb" @click.prevent="openGallery = !openGallery">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><b>{{ attachment.original_filename }}</b></p>
                                                    <p ><span>{{ attachment.created_at | moment('calendar') }}</span> - <a v-if="per.modify" @click.prevent="setRemoveTaskPhoto(attachment.new_filename)" href=""><span v-if="data.task_cover != attachment.new_filename">Set</span><span v-else>Remove</span><!-- (di ko alam tawag) --></a></p>
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
                        <div class="row">
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
                                    <div class="form-group is-empty comment-input-wrap">
                                        <input ref="files" v-show="false" @change="cFile" type="file" id="cFile" multiple class="form-control">
                                        <button @click="openCFile" type="button" class="btn btn-md btn-info btn-simple">
                                            <i class="fa fa-paperclip"></i>
                                        </button>
                                        <textarea @keyup.ctrl.enter="cTxtSend" v-model="cTxt" class="form-control" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                                        <button @click="cTxtSend" class="btn btn-md btn-info btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    props: ['per'],
    data() {
        return {
            data: null,
            isError: false,
            // pointsEditable: 0,
            updateData: {
                name: '',
                points: '',
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
        this.listenTask();
    },
    
    destroyed() {
        this.stopEventListeners();
    },

    computed: {
        ...mapGetters({
                board: 'getCBoard',
                comments: 'getTCom',
                board: 'getCBoard'
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

        changeDateFormat() {
            // this.data.due = new Date(this.data.due).toISOString().slice(0, 10).replace('T', ' ');
            this.updateData.due = moment(this.updateData.due).format('YYYY-MM-DD')
            this.updateTask();
        },

        debounceWait: _.debounce(function (e) {
            this.updateTask();
        }, 1000),

        updateTask() {
            // var contenteditable = document.querySelector('#points_'+this.data.id).textContent;
            // if(contenteditable) {
                // let contenteditablePoints = document.querySelector('#points_'+this.data.id).textContent;
                // let contenteditableName = document.querySelector('#name_'+this.data.id).textContent;
                // let contenteditableDesc = document.querySelector('#desc_'+this.data.id).textContent;
                // this.updateData.name = contenteditableName;
                // this.updateData.points = contenteditablePoints;
                // this.updateData.desc = contenteditableDesc;
                // this.updateData.id = this.$route.params.task_id;
                // this.updateData.board_id = this.$route.params.board_id;
                this.updateData.name = this.data.name;
                this.updateData.desc = this.data.description;
                this.updateData.id = this.$route.params.task_id;
                this.updateData.board_id = this.$route.params.board_id;
                // console.log(this.updateData);
                this.$store.dispatch('updateTask', this.updateData)
                    .then(response => {
                        // console.log(response);
                        this.data.assigned_to.name = response.assigned_to.name
                        this.data.due = response.due
                    })
            // }
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
                    this.$store.commit('updateTask', response.data);
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
            this.$router.push({ name: 'kanboard_gallery', params: {task_id: this.data.id} })
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

            this.$router.push({ name: 'kanboard_gallery', params: {task_id: this.data.id} })

        },

        dT() {
            this.$store.dispatch('deleteTask', {id:this.data.id, board_id: this.$route.params.board_id})
                .then(() => {
                    this.$router.push({name: 'kanboard', params: {board_id: this.$route.params.board_id}})
                    this.$toaster.warning('Task deleted succesfully!.')
                })
        },

        listenTask() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('UpdateListTaskEvent', (e) => {
                    this.data.task_cover = e.task.task_cover
                    // this.data.points = e.task.points
                    this.data.description = e.task.description
                    this.data.name = e.task.name
                    this.data.assigned_to.name = e.task.assigned_to.name
                    this.updateData.assign_to = e.task.assigned_to.id
                    // console.log(e);
                    // this.$store.commit('updateTask', e.task);
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
            Echo.leave('task.'+this.$route.params.task_id);
            Echo.leave('list.'+this.$route.params.board_id);
        }
    }
}
</script>


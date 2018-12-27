<template>
    <!--VIEW TASK-->
    <transition name="fade">
        <div class="overlay" v-if="data">
            <div class="taskView" style="">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <!-- <h4><span class="fa fa-tasks"></span> Make a new banner for the ganito & ganyan ang make it more beautiful</h4> -->
                        <h4><span class="fa fa-tasks"></span> <span @input="debounceWait" :id="'name_'+data.id" contenteditable="true">{{ data.name }}</span></h4>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <h4 class="">
                            <span class="pull-right"><router-link :to="{ name: 'kanboard'}" class="btn btn-simple btn-close" title="Close"><i class="fa fa-close"></i></router-link></span>
                            <span class="pull-right"><a class="btn btn-simple btn-close" title="Delete This Task"><i class="fa fa-trash-o"></i></a></span>
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6><b>ABOUT</b></h6>
                        <hr />
                        <div class="row">
                            <div class="col-md-4">
                                <p><span @click="clickAssigned = !clickAssigned" title="click to edit" class="fa fa-user-o text-info"></span> <span @click="clickAssigned = !clickAssigned" v-if="!clickAssigned">{{ data.assigned_to.name }}</span>
                                <select @change="updateTask" style="width: 80%" v-if="clickAssigned" required v-model="updateData.assign_to" class="my-input my-inp-blk" >
                                    <option value="">Unassign</option>
                                    <option v-for="user in boardMembers" :key="user.id" :value="user.id">{{ user.name }}</option>
                                </select>
                                
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p><span class="fa fa-trophy text-warning"></span> <span :id="'points_'+data.id" contenteditable="true" @input="checkNumberRange" @keypress="checkIfNumber">{{ data.points }}</span> pts <i v-if="isError">(1-9)</i></p>
                            </div>
                            <div class="col-md-4">
                                <p><span class="fa fa-clock-o text-danger"></span> {{ data.due | moment("MMM D, YYYY") }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p v-if="data.jo_id"><small>Task from JO no. 237874910</small></p>
                                <p @input="debounceWait" :id="'desc_'+data.id" contenteditable="true">{{ data.description }}</p>
                            </div>
                        </div>
                        <h6><b>ATTACHMENTS</b></h6>
                        <hr />
                        <!-- <p><a class="btn-default btn-simple btn-sm" href="/images/sample.docx" download><span class="fa fa-file-o"></span> dsjdisdiasnd.txt</a></p>
                        <p style="cursor: pointer"><a @click="openGallery" class="btn-default btn-simple btn-sm"><span class="fa fa-photo"></span> View attached images</a></p> -->
                        <div class="row" v-if="data.files.length">
                            <div class="col-md-12">
                                <div id="ataskment-wrapper">
                                    <div v-for="attachment in data.files" :key="attachment.id">
                                        <div class="ataskment" v-if="attachment.extension == 'jpg' || attachment.extension == 'jpeg' || attachment.extension == 'png' || attachment.extension == 'gif'">
                                            <div class="media">
                                                <div class="media-left media-top">
                                                    <router-link :to="{ name: 'kanboard_gallery', params: {task_id: data.id} }" :style="'background-image: url(\'/storage/task/'+ attachment.new_filename +'\')'" class="ataskment-thumb" @click.prevent="openGallery = !openGallery">
                                                    </router-link>
                                                </div>
                                                <div class="media-body">
                                                    <p><b>{{ attachment.original_filename }}</b></p>
                                                    <p ><span>Added 4 minutes ago</span> - <a @click.prevent="setRemoveTaskPhoto(attachment.new_filename)" href=""><span v-if="data.task_cover != attachment.new_filename">Set</span><span v-else>Remove</span><!-- (di ko alam tawag) --></a></p>
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
                                                    <p><span>Added 20 minutes ago</span></p>
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
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="txt-bold">COMMENTS</h6>
                                <hr />
                                <div class="comments">
                                    <div class="comment-box" style="">
                                        <div class="comment-msg">
                                            <div class="comment-sender">
                                                <h6 class="txt-bold">
                                                    <span><img src="/images/sample.jpg" class="comment-icon"></span>
                                                    Sam <small>3:18am 12-01-2018</small>
                                                </h6>
                                            </div>
                                            <div class="comment-comment">
                                                <p>This is my fckn comment</p>
                                            </div>
                                        </div>
                                        <div class="comment-msg">
                                            <div class="comment-sender">
                                                <h6 class="txt-bold">
                                                    <span><img src="/images/sample.jpg" class="comment-icon"></span>
                                                    Sam <small>3:18am 12-01-2018</small>
                                                </h6>
                                            </div>
                                            <div class="comment-comment">
                                                <p>This is my fckn comment with a file
                                                    with fckn Lorem ipsum dolor sit amet consectetur adipisicing elit. A hic, laboriosam laudantium modi neque eveniet tempore exercitationem ratione assumenda cupiditate voluptatibus odio rem iste qui? Quos dolore dolorum sint deleniti.
                                                </p>
                                                <p><a class="btn btn-default btn-simple btn-xs" href="/images/sample.docx" download><span class="fa fa-file-o"></span> withfcknfile.txt</a></p>
                                            </div>
                                        </div>
                                        <div class="comment-msg">
                                            <div class="comment-sender">
                                                <h6 class="txt-bold">
                                                    <span>
                                                        <img src="/images/sample.jpg" class="comment-icon">
                                                    </span>
                                                    Yow <small>3:18am 12-01-2018</small>
                                                </h6>
                                            </div>
                                            <div class="comment-comment">
                                                <p>This is my fckn comment with an image</p>
                                                <img src="/images/sample.jpg" style="max-height: 100px; max-width: 100%;">
                                            </div>
                                        </div>
                                        <div class="comment-msg">
                                            <div class="comment-sender">
                                                <h6 class="txt-bold">
                                                    <span><img src="/images/sample.jpg" class="comment-icon"></span>
                                                    Yow <small>3:18am 12-01-2018</small>
                                                </h6>
                                            </div>
                                            <div class="comment-comment">
                                                <p>This is my fckn comment with multiple images</p>
                                                <p style="cursor:pointer"><a class="btn btn-default btn-simple btn-xs"><span class="fa fa-photo"></span> View 2 photos</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group is-empty comment-input-wrap">
                                        <input ref="files" v-show="false" @change="onFileChange" type="file" id="inputFile3" multiple class="form-control">
                                        <button @click="chooseFile" type="button" class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center">
                                            <i class="fa fa-paperclip"></i>
                                        </button>
                                        <textarea class="form-control" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                                        <button  class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
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
import {mapGetters} from 'vuex';
export default {
    data() {
        return {
            data: null,
            isError: false,
            pointsEditable: 0,
            updateData: {
                name: '',
                points: '',
                desc: '',
                id: '',
                assign_to: ''
            },
            clickAssigned: false,
            attachments: []
        }
    },

    created() {
        this.getTaskData();
        
    },

    computed: {
        ...mapGetters({
                boardMembers: 'boardMembers',
            }),
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
            }
        },

        getTaskData() {
            axios.post('/api/getTaskData', {id: this.$route.params.task_id})
                .then((response) => {
                    this.data = response.data
                    this.updateData.assign_to = this.data.assigned_to.id;
                })
        },

        checkIfNumber(event) {
            // console.log(event);
            if(!(event.keyCode >= 48 && event.keyCode <= 57)){
                
                // alert('asd')
                
                event.preventDefault()
            }
            else {
                var contenteditable = document.querySelector('#points_'+this.data.id).textContent;
                this.pointsEditable = contenteditable;
                this.isError = false;
                // alert(this.pointsEditable)
            }
        },

        checkNumberRange(event) {

            var contenteditable = document.querySelector('#points_'+this.data.id).textContent;
            // console.log(contenteditable);
            if(!(contenteditable <= 9 && contenteditable >= 0)) {
                document.querySelector('#points_'+this.data.id).innerText = this.pointsEditable;
                this.isError = true;
                // event.preventDefault()
                // alert('shei')
            }
            this.debounceWait();
            
        },

        debounceWait: _.debounce(function (e) {
            this.updateTask();
        }, 500),

        updateTask() {
            let contenteditablePoints = document.querySelector('#points_'+this.data.id).textContent;
            let contenteditableName = document.querySelector('#name_'+this.data.id).textContent;
            let contenteditableDesc = document.querySelector('#desc_'+this.data.id).textContent;
            this.updateData.name = contenteditableName;
            this.updateData.points = contenteditablePoints;
            this.updateData.desc = contenteditableDesc;
            this.updateData.id = this.$route.params.task_id;
            this.updateData.list_id = this.$route.params.list_id;
            // console.log(this.updateData);
            this.$store.dispatch('updateTask', this.updateData);
        },

        chooseFile() {
            $("#addAttachmentInput").click();
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
            axios.patch('/api/taskPhoto', {filename: filename, id: this.$route.params.task_id})
                .then(response => {
                    // console.log(response);
                    this.data.task_cover = response.data.task_cover
                    this.$store.commit('updateTask', response.data);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>


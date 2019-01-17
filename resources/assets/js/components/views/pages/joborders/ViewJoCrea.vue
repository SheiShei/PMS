<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form</h2>
        </div>

        <div class="first-column col-md-1">
        </div>

        <div class="col-md-10" v-if="!!details">
            <div class="joform">
                <div class="jo-head">
                    <h4 class="noprint"><span class="fa fa-file-o"></span> {{ details.name }}
                    <span>
                        <button type="button" class="btn btn-success btn-simple btn-xs" title="Edit">
                            <i class="fa fa-edit"></i>
                        </button>
                    </span>
                    <span class="pull-right"><small>Status: </small>
                        <span v-if="details.status == 1" class="label label-info">Active</span>
                        <span v-if="details.status == 2" class="label label-success">Completed</span>
                        <span v-if="details.status == 3" class="label label-danger">Blocked</span>
                    </span>
                    </h4>
                </div>
                <div class="jo-body">
                    <div class="row">
                        <div v-if="details.brand" class="col-md-6">
                            <p><span class="txt-bold">Brand :</span> {{ details.brand.name }}</p>
                            <p><span class="txt-bold">Client :</span> Robert Fereno</p>
                            <p><span class="txt-bold">Brand Owner :</span> {{ details.brand.tandem.name }}</p>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="" class="align-right">JO No.</label> -->
                            <p><span class="txt-bold">JO No. :</span>{{ details.id }}</p>
                            <!-- <img class="" style="height: 70px" src="/images/nightsky3.jpg" alt=""> -->
                            <p><span class="txt-bold">Date In :</span> {{ details.indate }}</p>
                            <p><span class="txt-bold">Date Due :</span> {{ details.duedate }}</p>
                            
                        </div>
                    </div>

                    <hr v-if="details.jocreatives">

                    <div class="row" v-if="details.jocreatives">
                        <div class="col-md-6">
                            <p><span class="txt-bold">Usage Media :</span>
                                <span v-for="(media, index) in details.jocreatives.media" :key="index" v-if="media">
                                    <span v-if="media == 1">IG Post, </span> 
                                    <span v-if="media == 2">FB Post, </span> 
                                    <span v-if="media == 3">IG/Messenger Stories, </span> 
                                    <span v-if="media == 4">Cover Photo, </span> 
                                    <span v-if="media == 5">Branding (New Brand), </span> 
                                    <span v-if="media == 6">Trademark Form, </span> 
                                </span>
                            </p>
                            <p><span class="txt-bold">Ad Type :</span> 
                                <span v-for="(ad, index) in details.jocreatives.ad_type" :key="index" v-if="ad">
                                    <span v-if="ad == 1">Carousel, </span> 
                                    <span v-if="ad == 2">Canvas, </span> 
                                    <span v-if="ad == 3">Gallery, </span> 
                                    <span v-if="ad == 4">Album Type, </span> 
                                </span>
                            </p>
                            <p><span class="txt-bold">File Format :</span> 
                                <span v-for="(file, index) in details.jocreatives.file_type" :key="index" v-if="file">
                                    <span v-if="file == 1">PDF, </span> 
                                    <span v-if="file == 2">JPG, </span> 
                                    <span v-if="file == 3">GIF, </span> 
                                    <span v-if="file == 4">PNG, </span> 
                                    <span v-if="file == 5">MP4, </span> 
                                    <span v-if="file == 6">Boosted, </span> 
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="txt-bold">Copy On Artwork:</p>
                            <p>{{ details.jocreatives.copy }}</p>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h5><span class="fa fa-tasks"></span> Tasks</h5>
                        </div>
                        <div class="col-md-12" v-if="details.tasks">
                            <!-- random -->
                            <div class="tasklist row" v-for="(task, index) in details.tasks" :key="task.id">
                                <div class="col-md-12">
                                    <div class="taskdesc">
                                        <div class="taskno-cir">{{ index + 1 }}</div>
                                        <div class="taskdesattach">
                                            <p>&nbsp;{{ task.name }}</p>
                                            <p>&nbsp;{{ task.description }}</p>
                                            <!-- files here -->
                                            <div class="" v-if="task.files">
                                                <a v-for="(file, i) in task.files" :key="i" v-if="!(file.extension.includes('image'))" :href="file.new_filename" class="btn btn-info btn-sm" download>
                                                    <span class="fa fa-file-text-o"></span>&nbsp;{{ file.original_filename }}
                                                </a>
                                            </div>
                                            <div class="taskimgdiv" v-if="task.files">
                                                <a v-for="(file, i) in task.files" :key="i" v-if="file.extension.includes('image')" :href="file.new_filename" target="_blank" title="Click to View">
                                                    <img :src="file.new_filename" class="task-img" alt="bg2.jpg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- with files -->
                            <!-- <div class="tasklist row">
                                <div class="col-md-12">
                                    <div class="taskdesc">
                                        <div class="taskno-cir">1</div>
                                        <div class="taskdesattach">
                                            <p>&nbsp;New Page for Rewards Page Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magni ullam quis quam deserunt culpa esse soluta eos aliquam 
                                            hic quasi impedit sint asperiores id dolore, voluptatum iste officiis at.
                                            </p>
                                            <div class="">
                                                <a href="/images/sample.docx" class="btn btn-info btn-sm" download>
                                                    <span class="fa fa-file-text-o"></span>&nbsp;filename.docx
                                                </a>
                                                <a href="/images/sample.docx" class="btn btn-info btn-sm" download>
                                                    <span class="fa fa-file-text-o"></span>&nbsp;filename.docx
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                            <!-- with image -->
                            <!-- <div class="tasklist row">
                                <div class="col-md-12">
                                    <div class="taskdesc">
                                        <div class="taskno-cir">2</div>
                                        <div class="taskdesattach">
                                            <p>&nbsp;New Page for Rewards Page Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magni ullam quis quam deserunt culpa esse soluta eos aliquam 
                                                hic quasi impedit sint asperiores id dolore, voluptatum iste officiis at.
                                            </p>
                                            <div class="taskimgdiv">
                                                <a href="/images/bg2.jpeg" target="_blank" title="Click to View">
                                                    <img src="/images/bg2.jpeg" class="task-img" alt="bg2.jpg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                            <!-- with images -->
                            <!-- <div class="tasklist row">
                                <div class="col-md-12">
                                    <div class="taskdesc">
                                        <div class="taskno-cir">3</div>
                                        <div class="taskdesattach">
                                            <p>&nbsp;New Page for Rewards Page Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magni ullam quis quam deserunt culpa esse soluta eos aliquam 
                                            hic quasi impedit sint asperiores id dolore, voluptatum iste officiis at.</p>
                                            <div class="taskimgdiv">
                                                <a href="/images/bg2.jpeg" target="_blank" title="Click to View">
                                                    <img src="/images/bg2.jpeg" class="task-img" alt="bg2.jpg">
                                                </a>
                                                <a href="/images/bg2.jpeg" target="_blank" title="Click to View">
                                                    <img src="/images/default.png" class="task-img" alt="bg2.jpg">
                                                </a>
                                                <a href="/images/sample.jpg" target="_blank" title="Click to View">
                                                    <img src="/images/sample.jpg" class="task-img" alt="bg2.jpg">
                                                </a>
                                                <a href="/images/bg2.jpeg" target="_blank" title="Click to View">
                                                    <img src="/images/nightsky3.jpg" class="task-img" alt="bg2.jpg">
                                                </a>
                                                <a href="/images/bg2.jpeg" target="_blank" title="Click to View">
                                                    <img src="/images/luljetta.png" class="task-img" alt="bgkhjn2.jpg">
                                                </a>
                                                <a href="/images/bg2.jpeg" target="_blank" title="Click to View">
                                                    <img src="/images/logo.png" class="task-img" styls="task-img" alt="bg2.jpg">
                                                </a>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div> -->
                                
                            <!-- with file and image -->
                            <!-- <div class="tasklist row">
                                <div class="col-md-12">
                                    <div class="taskdesc">
                                        <div class="taskno-cir">4</div>
                                        <div class="taskdesattach">
                                            <p>&nbsp;New Page for Rewards Page Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magni ullam quis quam deserunt culpa esse soluta eos aliquam 
                                                hic quasi impedit sint asperiores id dolore, voluptatum iste officiis at.</p>
                                            <a href="/images/sample.docx" class="btn btn-info btn-sm" download>
                                                <span class="fa fa-file-text-o"></span>&nbsp;filename.docx
                                            </a>
                                            <div class="taskimgdiv">
                                                <a href="/images/sample.jpg" target="_blank" title="Click to View">
                                                    <img src="/images/sample.jpg" class="task-img" style="" alt="bg2.jpg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <hr />            
                    <div class="row" v-if="details.jocreatives">
                        <div class="col-md-12" v-if="details.jocreatives.post_caption">
                            <p class="txt-bold">Post Caption:</p>
                            <p>{{ details.jocreatives.post_caption }}</p>
                        </div>
                    </div>
                    <hr /> 
                    <div class="row" v-if="details.jocreatives" >
                        <div class="col-md-7">
                            <!-- <p><span class="txt-bold">Status:</span></p>
                            <ul>
                                <li>No Revisions</li>
                                <li>Copy Approved for Post</li>
                                <li>ACMA/BO Approved for Posting</li>
                            </ul> -->
                            <!--If there's revision-->
                            <p class="txt-bold">Revisions:</p>
                            <p>{{ details.jocreatives.revisions }}</p>
                        </div>
                        <div class="col-md-5">
                            <div v-if="details.jocreatives.signed_by">
                                <p><span class="txt-bold">Final Sign Off by: </span>{{ details.jocreatives.signedby.name }}</p>
                                <p><span class="txt-bold">Date:</span> {{ details.jocreatives.completed_at }}</p>
                            </div>
                            <!-- <p v-if="!details.jocreatives.signed_by">Not yet ready for sign off.</p> -->
                            <div v-if="!details.jocreatives.signed_by">
                                <!-- <p>Not yet ready for sign off.</p> -->
                                <label for="">Final Sign Off:</label>
                                <div class="checkbox mr-10">
                                    <label>
                                        <input v-model="sign_off.check" type="checkbox" name="final_sign_off"><span class="check"></span>
                                        Checking this field means you are confirming the final sign off. (?)
                                    </label>
                                </div>
                                <div v-if="sign_off.check">   
                                    <form @submit.prevent="signOff" >
                                        <p v-if="error" style="color: red">Unauthorize</p>
                                        <p class="note">Enter email and password for verification.</p>
                                        <input v-model="sign_off.email" type="email" class="form-control" placeholder="email" required>
                                        <input v-model="sign_off.password" type="password" class="form-control" placeholder="password" required>
                                        <button class="btn btn-success btn-md btn-block" type="submit">
                                            DONE!
                                        </button>   
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                            
                </div>
            </div>
        </div>

        <div class="col-md-1">
        </div>

        <div class="modal fade" id="SuccesCreativeSignOff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-small ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h3>Success!!</h3>
                    </div>
                    <div class="modal-body text-center">
                        <h5>Go to JO List? </h5>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-simple" data-dismiss="modal">Cancel</button>
                        <button @click="success()" type="button" class="btn btn-success btn-simple">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    data(){
        return{
            details: {},
            sign_off: {
                email: '',
                password: '',
                check: false,
            },
            error: false,
        }
    },
    created() {
        this.getJoDetails();
    },
    methods: {
        getJoDetails() {
            this.$store.dispatch('getJoDetails', this.$route.params.jo_id)
                .then ((response) => {
                    this.details = response;

                    if(response.jocreatives) {
                        let media = [], ad_type = [], file_type = [];
                        media = response.jocreatives.media.split('.');
                        ad_type = response.jocreatives.ad_type.split('.');
                        file_type = response.jocreatives.file_type.split('.');
                        
                        this.details.jocreatives.media = media;
                        this.details.jocreatives.ad_type = ad_type;
                        this.details.jocreatives.file_type = file_type;
                    }

                    console.log(this.details);
                })
        },

        signOff() {
            this.$store.dispatch('creativeSignOff', {sign: this.sign_off, id: this.$route.params.jo_id})
                .then ((response) => {
                    $('#SuccesCreativeSignOff').modal('show');
                })
                .catch( error => {
                    this.error = true;
                })
        },

        success() {
            $('#SuccesCreativeSignOff').modal('hide');
            this.$router.push({name: 'all_jo_list'})
        },
    }
}
</script>


<style scoped>
@media print {
  .nav-side-menu,
  noprint {
    display: none;
  }
}
table {
  border: 1px solid gray !important;
}
label {
  color: #868686 !important;
  font-weight: 700 !important;
  font-size: 0.9em !important;
}

.btn-group,
.btn-group-vertical {
  position: relative;
  margin: 2px 1px;
}

label > small {
  font-weight: normal;
}
.jo-barcode {
  margin-top: 10px;
  margin-right: 10px;
  width: 100px;
  height: 100px;
  border: 1px solid gray;
}
.btn-group bootstrap-select {
  margin-top: 0px !important;
  margin-bottom: 7px !important;
}
div.checkbox > label {
  font-weight: normal !important;
}
.txt-bold {
  font-weight: bold !important;
  font-size: 12px;
}
</style>


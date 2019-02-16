<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form</h2>
        </div>

        <div class="container-fluid">
            <div class="main2" v-if="!!details">
                <div class="row">
                    <div class="col-md-12">
                        <div class="taskchart shadow mt-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="no-margin "><span class="fa fa-copy"></span> {{ details.name }}&nbsp;
                                        <span v-if="details.status == 1" class="txt-bold text-info" title="Job Order Status: Active"><i class="fa fa-circle"></i></span>
                                        <span v-if="details.status == 2" class="txt-bold text-success" title="Job Order Status: Completed"><i class="fa fa-circle"></i></span>
                                        <span v-if="details.status == 3" class="txt-bold text-danger" title="Job Order Status: Blocked"> <i class="fa fa-circle"></i></span>
                                    </h4>
                                    <p class="no-margin"><small class="text-gray">Job Order ID: {{ details.id }}</small></p>
                                    <!-- <p class="no-margin"><small class="text-gray">Brand: {{ details.brand.name }} </small></p> -->
                                </div>
                                <div class="col-md-4 text-right">
                                    <!-- <p class="no-margin"><small>Status: </small>
                                        <span v-if="details.status == 1" class="txt-bold text-info"><span class="fa fa-circle"></span> Active</span>
                                        <span v-if="details.status == 2" class="txt-bold text-success"><span class="fa fa-circle"></span> Completed</span>
                                        <span v-if="details.status == 3" class="txt-bold text-danger"> <span class="fa fa-circle"></span> Blocked</span>
                                    </p> -->
                                    <!-- <p class="no-margin"><small class="text-gray">For Client: Robert Fereno ( {{ details.brand.name }} )</small></p> -->
                                    <button class="btn btn-xs btn-default btn-simple" type="button">
                                        <i class="fa fa-pencil"></i> Edit Mode
                                    </button>
                                </div>
                            </div>

                            <hr/>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-6 col-xs-6">
                                            <p class="no-margin"><small><span class="fa fa-briefcase"></span> Brand: </small></p>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-6 text-right">
                                            <p class="no-margin">{{ details.brand.name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-6 col-xs-6">
                                            <p class="no-margin"><small><span class="fa fa-address-book-o"></span> Contact Person: </small></p>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-6 text-right">
                                            <p class="no-margin">{{ details.brand.contact_person }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-8 col-xs-6">
                                            <p class="no-margin"><small><span class="fa fa-user-o"></span> Brand Owner: </small></p>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-6 text-right">
                                            <p class="no-margin">{{ details.brand.acma.name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-8 col-xs-6">
                                            <p class="no-margin"><small><span class="fa fa-clock-o text-success"></span> In Date: </small></p>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-6 text-right">
                                            <p class="no-margin">{{ details.indate }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-8 col-xs-6">
                                            <p class="no-margin"><small><span class="fa fa-clock-o text-danger"></span> Due Date: </small></p>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-6 text-right">
                                            <p class="no-margin">{{ details.duedate }}</p>
                                        </div>
                                    </div>
                                    <br/>
                                </div>

                                <div class="col-md-4 pl-4" v-if="details.jocreatives">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="no-margin"><span class="txt-bold">Usage Media :</span></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                             <p class="no-margin" v-for="(media, index) in details.jocreatives.media" :key="index" v-if="media">
                                                <span v-if="media == 1">IG Post</span> 
                                                <span v-else-if="media == 2">FB Post</span> 
                                                <span v-else-if="media == 3">IG/Messenger Stories</span> 
                                                <span v-else-if="media == 4">Cover Photo</span> 
                                                <span v-else-if="media == 5">Branding (New Brand)</span> 
                                                <span v-else-if="media == 6">Trademark Form</span>
                                                <span v-else>-</span> 
                                            </p>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="no-margin"><span class="txt-bold">Ad Type :</span></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <p class="no-margin"><span v-for="(ad, index) in details.jocreatives.ad_type" :key="index" v-if="ad">
                                                    <span v-if="ad == 1">Carousel</span> 
                                                    <span v-else-if="ad == 2">Canvas</span> 
                                                    <span v-else-if="ad == 3">Gallery</span> 
                                                    <span v-else-if="ad == 4">Album Type</span>
                                                    <span v-else>-</span> 
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 pl-4" v-if="details.jocreatives">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin txt-bold"><span class="fa fa-file-o"></span> File Format:</p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p class="no-margin">
                                                <span v-for="(file, index) in details.jocreatives.file_type" :key="index" v-if="file">
                                                    <span v-if="file == 1">PDF</span> 
                                                    <span v-else-if="file == 2">JPG</span> 
                                                    <span v-else-if="file == 3">GIF</span> 
                                                    <span v-else-if="file == 4">PNG</span> 
                                                    <span v-else-if="file == 5">MP4</span> 
                                                    <span v-else-if="file == 6">Boosted</span>
                                                    <span v-else>-</span> 
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin txt-bold"><span class="fa fa-align-left"></span> Copy on Artwork:</p>
                                            <p class="no-margin" v-if="details.jocreatives.copy == null ">
                                                {{ details.jocreatives.copy }}
                                            </p>
                                            <p class="no-margin" v-else>-</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-5">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="no-margin text-gray"><span class="txt-bold"><span class="fa fa-trello"></span>&nbsp;Board</span><small></small></p>
                                </div>
                                <div class="col-md-7 text-right">
                                    <p class="no-margin text-gray"><small>Sample Board Here</small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="no-margin"><span class="txt-bold"><span class="fa fa-tasks"></span> Tasks List</span>&nbsp;<small><span class="text-gray">(15)</span></small></p>
                                </div>
                                <div class="col-md-5 text-right">
                                    <p class="no-margin text-gray"><small>80%</small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="progress progress-line-success">
		                    	        <div class="progress-bar progress-bar-success" style="width: 35%">
		                                    <span class="sr-only">35% Complete (success)</span>
		                                </div>
		                            </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="torev3">
                                        <div class="torevdiv3" v-for="(task, index) in details.tasks" :key="task.id">
                                            
                                            <!-- if currently active -->
                                            <!-- <div class="torev-content divactive">
                                                <h6 class="no-margin txt-bold text-info"><span class="fa fa-circle text-info"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> sam</small> . 
                                                    <small><span class="fa fa-clock-o"></span> Feb 21, 2019</small> . 
                                                    <small>2 days left</small>

                                                </p>
                                            </div> -->

                                            <!-- if currently active 1 day before or on due-->
                                            <!-- <div class="torev-content divwarning">
                                                <h6 class="no-margin txt-bold text-warning"><span class="fa fa-circle text-warning"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> sam</small> . 
                                                    <small><span class="fa fa-clock-o"></span> Feb 21, 2019</small> . 
                                                    <small>2 days left</small>
                                                </p>
                                            </div> -->

                                            <!-- if completed -->
                                            <div class="torev-content divcompleted">
                                                <h6 class="no-margin txt-bold text-success"><span class="fa fa-check text-success"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> sam</small> . 
                                                    <small><span class="fa fa-clock-o"></span> Feb 21, 2019</small> . 
                                                </p>
                                            </div>

                                            <!-- if overdued & not yet completed -->
                                            <!-- <div class="torev-content divoverdued">
                                                <h6 class="no-margin txt-bold" text-danger><span class="fa fa-circle text-danger"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> sam</small> . 
                                                    <small><span class="fa fa-clock-o"></span> Feb 21, 2019</small> . 
                                                    <small>due 2 days ago</small>
                                                </p>
                                            </div> -->

                                            <!-- if overdued but completed after due date-->
                                            <!-- <div class="torev-content divoverdued">
                                                <h6 class="no-margin txt-bold text-success"><span class="fa fa-check text-success"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> sam</small> . 
                                                    <small><span class="fa fa-clock-o"></span> Feb 21, 2019</small> . 
                                                    <small>due 2 days ago</small>
                                                </p>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-7">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6" v-if="details.jocreatives.post_caption">
                                            <p class="no-margin txt-bold"><span class="fa fa-align-left"></span> Post Caption</p>
                                            <!-- <hr/> -->
                                            <p  class="no-margin">{{ details.jocreatives.post_caption }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="no-margin txt-bold"><span class="fa fa-rotate-right"></span> Revisions:</p>
                                            <p>{{ details.jocreatives.revisions }}</p>
                                        </div>
                                    </div>
                                    <br/>
                                     <div class="row" v-if="details.jocreatives.signed_by">
                                        <div class="col-md-12">
                                            <p><span class="txt-bold">Final Signed Off by: </span>{{ details.jocreatives.signedby.name }}</p>
                                            <p><span class="txt-bold">Date:</span> {{ details.jocreatives.completed_at }}</p>
                                        </div>
                                    </div>
                                    <div class="row" v-if="!details.jocreatives.signed_by">
                                        <div class="col-md-12">
                                            <p class="no-margin txt-bold"><span class="fa fa-pencil"></span> Final Sign Off</p>
                                            <button class="btn btn-success btn-md btn-block" v-if="!sign_off.check" @click="sign_off.check = !sign_off.check">Sign Off JO</button>
                                            <div v-if="sign_off.check">   
                                                <form @submit.prevent="signOff" >

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="no-margin text-gray"><small>Enter email and password for verification.</small></p>
                                                            <p v-if="error" class="text-danger"><small>Sorry. You're unauthorized to sign off.</small></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label class="">Email:</label>
                                                            <input v-model="sign_off.email" type="email" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label class="">Password:</label>
                                                            <input v-model="sign_off.password" type="password" class="form-control" required>
                                                        </div>
                                                    </div>
                                                                                                
                                                    <div class="row" v-if="!details.jocreatives.signed_by">
                                                        <div class="col-md-6">
                                                            <button @click="sign_off.check = !sign_off.check" class="btn btn-default btn-md btn-block" type="reset">
                                                            Cancel
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button class="btn btn-success btn-md btn-block" type="submit">
                                                            Confirm Sign Off
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="taskchart shadow">
                            <p class="no-margin"><span class="txt-bold"><span class="fa fa-tasks"></span> {{ details.name }}'s Workload</span></p>
                            <gantt-elastic v-if="show" ref="shei" :tasks="tasks" :options="options">
                                <gantt-header slot="header"></gantt-header>
                            </gantt-elastic>
                        </div>
                    </div>
                </div>
                <br/>


            </div>
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
import dayjs from "dayjs";
import GanttElastic from 'gantt-elastic';
import Header from './workload/Header.vue';
import style from "gantt-elastic/src/style.js";
export default {
    components: {
        'gantt-header': Header,
        'gantt-elastic': GanttElastic,
        'gantt-footer': { template: `` }
    },
    props: ['header', 'footer'],
    data(){
        return{
            details: {},
            sign_off: {
                email: '',
                password: '',
                check: false,
            },
            error: false,
            show: true,
            tasks: [
                {
                    id: 1,
                    label: 'Make some noise',
                    user: '<a><span><img class="small-avatar" src="/images/default"></span> shei</a>',
                    duration: 5 * 24 * 60 * 60,
                    progress: 85,
                    status: 'Completed',
                    type: 'task',
                },
                {
                    id: 2,
                    label: 'Make some noise 22',
                    user: '<a>shei</a>',
                    parentId: 1,
                    dependentOn: [1],
                    duration: 5*24*60*60,
                    progress: 85,
                    status: 'Completed',
                    type: 'task'
                }
            ],
            options: {
                title: {
                    label: 'Team Workload',
                    html: false,
                    style:{
                        'font-size' : '12px !important',
                        'vertical-align': 'middle',
                    }
                },
                taskList: {
                    columns: [
                        {
                            id: 2,
                            label: 'Member',
                            value: 'user',
                            width: 120,
                            html: true,
                            expander: true
                        }, 
                        {
                            id: 3,
                            label: 'Tasks',
                            value: 'label',
                            width: 170,
                            expander: false
                        }, 
                        {
                            id: 4,
                            label: 'Due',
                            value: (task) => task.endDate.format('YYYY-MM-DD'),
                            width: 78
                        }, 
                        {
                            id: 5,
                            label: 'Status',
                            value: 'status',
                            width: 80
                        } 
                    ]
                },
                locale: {
                    code: 'en',
                    'Now': 'Now',
                    'X-Scale': 'Zoom-X',
                    'Y-Scale': 'Zoom-Y',
                    'Task list width': 'Task list',
                    'Before/After': 'Expand',
                    'Display task list': 'Task list'
                }
            }
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


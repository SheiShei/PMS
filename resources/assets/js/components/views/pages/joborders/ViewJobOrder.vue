<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form</h2>
        </div>

        <div class="first-column col-md-1">
        </div>

        <div class="col-md-10" v-if="!!details">
            <form @submit.prevent="signed">
            <div class="joform shadow">
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
                        <div v-if="details.brand" class="col-md-4">
                            <p><span class="txt-bold">Brand :</span> {{ details.brand.name }}</p>
                            <p><span class="txt-bold">Client :</span> Robert Fereno</p>
                            <p><span class="txt-bold">ACMA/Brand Owner :</span> {{ details.brand.acma.name }}</p>
                        </div>
                        <div  v-if="details.brand" class="col-md-5">
                            <p><span class="txt-bold">Date In :</span> {{ details.indate }}</p>
                            <p><span class="txt-bold">Date Due :</span> {{ details.duedate }}</p>
                            <p v-if="details.joweb"><span class="txt-bold">Request Type :</span> 
                                <span v-for="(request, index) in details.joweb.request_type" :key="index" v-if="request">
                                    <span v-if="request == 1">Information Update, </span> 
                                    <span v-if="request == 2">Page Deletion, </span> 
                                    <span v-if="request == 3">Additional Page, </span> 
                                    <span v-if="request == 4">Setup Mail, </span> 
                                    <span v-if="request == 5">Contact Details Change, </span> 
                                    <span v-if="request == 6">URL & Domain Change, </span> 
                                </span>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p><span class="txt-bold">JO No. :</span>{{ details.id }}</p>
                            <!-- <label for="" class="align-right">JO No.</label> -->
                            <!-- <img class="pull-right" style="height: 70px" src="/images/above-art1.jpg" alt=""> -->
                        </div>
                    </div>
                    <hr>
                    <div class="row" v-if="details.joweb">
                        <div class="col-md-4">
                            <p><span class="txt-bold">TECH :</span>  
                                <span v-if="details.joweb.tech == 1">Request Domain Purchase </span> 
                                <span v-if="details.joweb.tech == 2">With Previos Domain </span> 
                            </p>
                            <p><span class="txt-bold">Domain Transfer :</span> 
                                <span v-if="details.joweb.domain_transfer == 1">Domain Unlocked </span> 
                                <span v-if="details.joweb.domain_transfer == 2">Auth/EPP Code Provided </span> 
                            </p>
                            <p><span class="txt-bold">Domain Renewal :</span> 
                                <span v-if="details.joweb.domain_renewal == 1">Domain for Renewal </span> 
                                <span v-if="details.joweb.domain_renewal == 2">Change Domain </span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="txt-bold">OLD HOST cPANEL</span>
                            </p>
                            <p><span class="txt-bold">Username :</span> {{ details.joweb.old_cpanel_uname }}</p>
                            <p><span class="txt-bold">Password :</span> {{ details.joweb.old_cpanel_password }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="txt-bold">NEW HOST cPANEL</span></p>
                            <p><span class="txt-bold">Username :</span> {{ details.joweb.new_cpanel_uname }}</p>
                            <p><span class="txt-bold">Password :</span> {{ details.joweb.new_cpanel_password }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row" v-if="details.joweb">
                        <div class="col-md-4">
                            <p><span class="txt-bold">TRACKER</span></p>
                            <p><span class="txt-bold">Date Commenced :</span> {{ details.joweb.commenceddate }}</p>
                            <p><span class="txt-bold">Date Ended :</span> {{ details.joweb.endeddate }}</p>
                        </div>
                        <div class="col-md-8">
                            <p><span class="txt-bold">NOTES & ACTION POINTS:</span></p>
                            <p>{{ details.joweb.action_points }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5><span class="fa fa-tasks"></span> Tasks</h5>
                        </div>
                        <div class="col-md-12" v-if="details.tasks">
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
                            <!-- <div class="tasklist row">
                                <div class="col-md-12">
                                    <div class="taskdesc">
                                        <div class="taskno-cir">1</div>
                                        <div class="taskdesattach">
                                            <p>&nbsp;New Page for Rewards Page Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magni ullam quis quam deserunt culpa esse soluta eos aliquam 
                                            hic quasi impedit sint asperiores id dolore, voluptatum iste officiis at.</p>
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
                            <div class="tasklist row">
                                <div class="col-md-12">
                                    <div class="taskdesc">
                                        <div class="taskno-cir">2</div>
                                        <div class="taskdesattach">
                                            <p>&nbsp;New Page for Rewards Page Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magni ullam quis quam deserunt culpa esse soluta eos aliquam 
                                            hic quasi impedit sint asperiores id dolore, voluptatum iste officiis at.</p>
                                            <div class="taskimgdiv">
                                                <a href="/images/bg2.jpeg" target="_blank" title="Click to View">
                                                    <img src="/images/bg2.jpeg" class="task-img" alt="bg2.jpg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tasklist row">
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
                            </div>
                            <div class="tasklist row">
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
                            <div class="row">
                                <div class="col-md-4" v-if="details.joweb">
                                    <label for="rqst_type">Accomplish list below before going live:</label> 
                                    <div class="checkbox mr-10">
                                        <label>
                                        <input v-model="details.joweb.target_list" value="1" type="checkbox" name="optionsCheckboxes" disabled>
                                            <span class="check"></span>
                                            All numbers are working/reachable
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                        <input v-model="details.joweb.target_list" value="2" type="checkbox" name="optionsCheckboxes" disabled>
                                            <span class="check"></span>
                                            All emails are working/not bouncing
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.joweb.target_list" value="3" type="checkbox" name="optionsCheckboxes" disabled>
                                                <span class="check" disabled checked></span>
                                                ACMA/BO approved for posting
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.joweb.target_list" value="4" type="checkbox" name="optionsCheckboxes" disabled>
                                                <span class="check" disabled checked></span>
                                                Copy has been proofed
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.joweb.target_list" value="5" type="checkbox" name="optionsCheckboxes" disabled>
                                                <span class="check" disabled checked></span>
                                                Prices of products/services are accurate
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.joweb.target_list" value="6" type="checkbox" name="optionsCheckboxes" disabled>
                                                <span class="check" disabled></span>
                                                All URL links in menu are working
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div v-if="details.joweb.web_proofed_at">
                                        <p><span class="txt-bold">Proofed by :</span> {{ details.joweb.web_signed_by.email }}</p>
                                        <p><span class="txt-bold">Date Proofed :</span> {{ details.joweb.web_proofed_at }}</p>
                                    </div>
                                    <!--If no proof yet-->
                                    <!-- <p v-if="!details.joweb.web_proofed_at"><span class="txt-bold">Approved by :</span> (Not Proofed Yet) </p> -->
                                    <div v-if="!details.joweb.web_proofed_at">
                                        <label for="rqst_type">Proofed by (Web Team):</label>
                                        <div class="checkbox mr-10" >
                                            <label>
                                                <input v-model="proofed.check" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Check this to confirm proofing.
                                            </label>
                                        </div>
                                        <div v-if="proofed.check">
                                            
                                                <p v-if="webProofedError" style="color: red">Unauthorize</p>
                                                <p class="note">Please enter email and password for verification.</p>
                                                <input v-model="proofed.email" class="form-control my-input mb-5" type="email" placeholder="Email...">
                                                <input v-model="proofed.password" class="form-control my-input" type="password" placeholder="Password...">
                                                
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div v-if="details.joweb.acma_proofed_at">
                                        <p><span class="txt-bold">Approved by :</span> {{ details.joweb.acma_signed_by.email }}</p>
                                        <p><span class="txt-bold">Date Approved :</span> {{ details.joweb.acma_proofed_at }}</p>
                                    </div>
                                    <!--If not approved yet-->
                                    <!-- <p v-if="!details.joweb.acma_proofed_at"><span class="txt-bold">Approved by :</span> (No Approval Yet) </p> -->
                                    <div v-if="!details.joweb.acma_proofed_at">
                                        <label for="">Changes Approved by: (ACMA+BO)</label>
                                        <div class="checkbox mr-10" >
                                            <label>
                                                <input v-model="approved.check" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Check this to approve changes.
                                            </label>
                                        </div>
                                        <div v-if="approved.check">
                                                <p v-if="acmaAprovedError" style="color: red">Unauthorize</p>
                                                <p class="note">Please enter email and password for verification.</p>
                                                <input v-model="approved.email" class="form-control my-input mb-5" type="email" placeholder="Email...">
                                                <input v-model="approved.password" class="form-control my-input" type="password" placeholder="Password...">
                                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button v-if="approved.check || proofed.check" class="btn btn-success btn-md btn-block" type="submit">
                                DONE!
                            </button>
                        </div>
                    </div>                 
                </div>
            </div>
            </form>
        </div>

        <div class="col-md-1">
        </div>

        <div class="modal fade" id="SuccesWebSignOff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            proofed: {
                check: false,
                email: '',
                password: ''
            },
            approved: {
                check: false,
                email: '',
                password: ''
            },
            webProofedError: false,
            acmaAprovedError: false,
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

                    if(response.joweb) {
                        let target_list = [], request_type = [];
                        target_list = response.joweb.target_list.split('.');
                        request_type = response.joweb.request_type.split('.');
                        
                        this.details.joweb.target_list = target_list;
                        this.details.joweb.request_type = request_type;
                    }

                    console.log(this.details);
                })
        },
        
        signed() {
            this.$store.dispatch('webSignOff', {id: this.$route.params.jo_id, proofed: this.proofed, approved: this.approved})
                .then (response => {
                    $('#SuccesWebSignOff').modal('show');
                })
                .catch (error => {
                    if(error == 'web') {
                        this.webProofedError = true;
                        this.acmaAprovedError = false;
                    }
                    else {
                        this.acmaAprovedError = true;
                        this.webProofedError = false;
                    }
                })
        },

        success() {
            $('#SuccesWebSignOff').modal('hide');
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
.jo-head {
  border-bottom: 1px dashed #cac8c8;
  margin-bottom: 12px;
}
.btn-group bootstrap-select {
  margin-top: 0px !important;
  margin-bottom: 7px !important;
}
div.checkbox > label {
  font-weight: normal !important;
}
</style>


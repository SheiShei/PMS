<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form - Web <small>Panel</small></h2>
        </div>

        <div class="first-column col-md-1"></div>

        <div class="col-md-10">
            <div class="joform shadow">
                <div class="jo-head">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="noprint"><span class="fa fa-file-code-o"></span> Job Order Form <small>(Web)</small>
                            &nbsp;&nbsp;&nbsp;
                                <span class="pull-right">
                                    <small>
                                        <select name="main_status" v-model="brand.status" class="my-input">
                                            <option value="1">Active</option>
                                            <option value="2">Completed</option>
                                            <option value="3">Blocked</option>
                                        </select>
                                    </small>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="jo-body">
                <form @submit.prevent="updateWebJO">
                    <!--BRAND CLIENT ACMA -->
                    <div class="row form-row">
                        <div class="col-md-6 form-group">
                            <label for="jo_name">Name </label>
                            <input v-model="brand.name" name="jo_name" id="jo_name" type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="brand">Brand:</label>
                            <div class="btn-group bootstrap-select">
                                <select name="brand_id" v-model="brand.brand_id" class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                        <option value="">---</option>
                                        <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-3 form-group">
                            <label for="brand">Client:</label>
                            <div class="btn-group bootstrap-select">
                                <select class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                    <option value="">Aya</option>
                                    <option value="">Marley</option>
                                    <option value="">Kwini</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">ACMA / Brand Owner:</label>
                            <div class="btn-group bootstrap-select">
                                <select multiple class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                    <option value="">Aya</option>
                                    <option value="">Marley</option>
                                    <option value="">Kwini</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-3 form-group">
                            <label for="" class="align-right">JO No.</label>
                            <img class="pull-right" style="height: 70px" src="/images/above-art1.jpg" alt="">
                        </div>
                    </div>
                    <!--./end of BRAND CLIENT ACMA -->

                    <hr />

                    <div class="row form-row">
                        <!--TIME IN and DUE -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for=""><span class="fa fa-calendar-o text-success"></span> Date In
                                    <small><i> (dd-mm-yyyy)</i></small></label>
                                <input v-model="brand.date_in" class="form-control" type="date" />
                            </div>
                            <div class="form-group">
                                <label for=""><span class="fa fa-calendar-o text-danger"></span> Date Due
                                    <small><i> (dd-mm-yyyy)</i></small></label>
                                <input v-model="brand.date_due" class="form-control" type="date" />
                            </div>
                        </div>
                        <!--./end of TIME IN and DUE -->

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="rqst_type">Request Type:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="details.request_type" value="1" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Information Update
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="details.request_type" value="2" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Page Deletion
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="details.request_type" value="3" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Additional Page
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="details.request_type" value="4" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Setup Mail (Zoho)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="details.request_type" value="5" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Contact Details Change
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="details.request_type" value="6" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            URL & Domain Change
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="details.request_type" value="7" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Others
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rqst_type">TECH:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.tech" value="1" name="optionsCheckboxes"><span class="check"></span>
                                        Request for Domain Purchase
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.tech" value="2" name="optionsCheckboxes"><span class="check"></span>
                                        With Previous Domain
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rqst_type">Domain Transfer:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_transfer" value="1" name="domain_transfer"><span class="check"></span>
                                        Domain Unlocked
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_transfer" value="2" name="domain_transfer"><span class="check"></span>
                                        Auth/EPP Code Provided
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rqst_type">Domain Renewal:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_renewal" value="1" name="domain_renewal"><span class="check"></span>
                                        Domain for Renewal
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_renewal" value="2" name="domain_renewal"><span class="check"></span>
                                        Change Domain
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col md-12">
                                    <div class="">
                                        <div class="col-md-4">
                                            <h6 class="text-default">OLD HOST cPANEL</h6>
                                            <div class="form-group">
                                                <label for="" class="">Username</label>
                                                <input v-model="details.old_cpanel_uname" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input v-model="details.old_cpanel_password" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-default">NEW HOST cPANEL</h6>
                                            <div class="form-group">
                                                <label for="" class="">Username</label>
                                                <input v-model="details.new_cpanel_uname" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input v-model="details.new_cpanel_password" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-default">Tracker</h6>
                                            <div class="form-group">
                                                <label for="" class="">Date Commerced</label>
                                                <input v-model="details.date_commerced" type="date" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Date Ended</label>
                                                <input v-model="details.date_ended" type="date" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    <br />
                                    <div class="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="">NOTES & ACTION POINTS:</label>
                                                <textarea v-model="details.action_points" class="my-text-area btn-block" rows="5" placeholder="Write your notes here..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="jo-body" style="background-color: whitesmoke">
                        <div class="row pb-10">
                            <div class="col-md-12">
                                <h5>Add Task 
                                <span><button type="button" @click="addNewTask" class="btn btn-success btn-fab btn-fab-mini"
                                        rel="tooltip" data-original-title="Click to add new task form" data-placement="right">
                                    <!-- <span class="fa fa-plus"></span> -->
                                    +
                                    </button></span>
                                </h5>
                            </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                    
                            <div class="row" id="addtaskdiv">
                            <div class="col-md-12">
                                <div class="card taskcard" v-for="(task, index) in tasks" :key="task.id">
                                    <span class="pull-right" @click="deleteTaskForm(index)" style="cursor:pointer"><i class="fa fa-times"></i></span>
                                    <h5 class="text-gray"><span class="fa fa-tasks"></span> Task #{{index+1}}</h5>
                                    <!-- <div class="card-body"> -->
                                        <div class="form-row">
                                            <div class="col-md-7">
                                                <label for="">Decription </label>
                                                <textarea type="text" v-model="task.name" class="btn-block" placeholder="" ></textarea>
                                                <!-- <label for="">Attach File: </label>
                                                <input class="btn-block" type="file" name="" id="" multiple> -->
                                                    <!-- <input type="text" v-model="task.about" class="form-control" placeholder="About"> -->
                                                <!-- </div> -->
                                            </div>
                                            <div class="col-md-5">
                                                <label for=""><span class="fa fa-user-o"></span> Assign to </label>
                                                <select class="btn-block">
                                                    <option value="">Shooky</option>
                                                    <option value="">Chimmy</option>
                                                    <option value="">RJ</option>
                                                </select>
                                                <label for="" style="margin-top: 8px"><span class="fa fa-file-o"></span> Attach File</label>
                                                <input class="btn-block" type="file" multiple>
                                            </div>
                                        </div>
                                        
                                    <!-- </div> -->
                                </div>
                            </div>
                            </div>

                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    </div>

                    <hr>
                     <div class="row">
                        <!-- <div class="col-md-12">
                                <label for="rqst_type">Status:</label> 
                                </div> -->
                                <div class="col-md-4">
                                    <label for="rqst_type">Accomplish list below before going live:</label> 
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.target_list" value="1" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            All numbers are working/reachable
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.target_list" value="2" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            All emails are working/not bouncing
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.target_list" value="3" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            ACMA/BO approved for posting
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.target_list" value="4" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Copy has been proofed
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.target_list" value="5" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Prices of products/services are accurate
                                        </label>
                                    </div>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input v-model="details.target_list" value="6" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            All URL links in menu are working
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4" v-if="!web.email">
                                    <!-- <div class="checkbox mr-10">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Revisions Below
                                        </label>
                                    </div> -->
                                    <label for="rqst_type">Proofed by (Web Team):</label>
                                    <div class="checkbox mr-10" >
                                        <label>
                                            <input v-model="proofed.check" type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Check this to confirm proofing.
                                        </label>
                                        <div v-if="proofed.check">
                                            <p v-if="webProofedError" style="color: red">Unauthorize</p>
                                            <p class="note">Please enter email and password for verification.</p>
                                            <input v-model="proofed.email" class="form-control my-input mb-5" type="email" placeholder="Email...">
                                            <input v-model="proofed.password" class="form-control my-input" type="password" placeholder="Password...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" v-if="!acma.email">
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
                                <div class="col-md-4" v-if="web.email">
                                    <p><span class="txt-bold">Proofed by :</span> {{ web.email }}</p>
                                    <p><span class="txt-bold">Date Proofed :</span> {{ web.date }}</p>
                                </div>
                                <div class="col-md-4" v-if="acma.email">
                                    <p><span class="txt-bold">Approved by :</span> {{ acma.email }}</p>
                                    <p><span class="txt-bold">Date Approved :</span> {{ acma.date }}</p>
                                </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-md btn-block" type="submit">
                                DONE!
                            </button>
                        </div>
                    </div>

                   
                </form>
                </div>


                
            </div>
        </div>
        <div class="col-md-1">

        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    data(){
        return{
            tasks: [{
                name: '',
                about: ''
            }],
            brand: {
                name: '',
                brand_id: '',
                status: 1,
                date_in: '',
                date_due: ''
            },
            details: {
                target_list: [],
                request_type: [],
                tech: '',
                domain_transfer: '',
                domain_renewal: '',
                action_points: '',
                old_cpanel_uname: '',
                new_cpanel_uname: '',
                old_cpanel_password: '',
                new_cpanel_password: '',
                date_commerced: '',
                date_ended: ''
            },
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
            web: {
                email: '',
                date: ''
            },
            acma: {
                email: '',
                date: ''
            }
        }
    },
    created() {
        this.$store.dispatch('onCreate');
        console.log(this.brands);
        this.getJoDetails();
    },
    computed: {
        ...mapGetters({
                brands: 'getBrands',
            }),        
    },
    methods: {
        addNewTask(){
            this.tasks.push({
                name: '',
                about: ''
            })
            this.scrollToEnd()
        },
        deleteTaskForm(index){
            this.tasks.splice(index,1)
        },
        scrollToEnd(){
            var taskdiv = document.querySelector("#addtaskdiv")
            // var scrollHeight = taskdiv.scrollHeight + 200
            taskdiv.scrollTop = taskdiv.scrollHeight

        },
        updateWebJO() {
            this.$store.dispatch('updateJOW', {brand: this.brand, details: this.details, id: this.$route.params.jo_id, proofed: this.proofed, approved: this.approved})
                .then ((response) => {
                    this.acmaAprovedError = false;
                    this.webProofedError = false;
                    alert('updated');
                })
                .catch ((error) => {
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
        getJoDetails() {
            this.$store.dispatch('getJoDetails', this.$route.params.jo_id)
                .then ((response) => {
                    console.log(response);
                    this.brand.name = response.name;
                    this.brand.brand_id = response.brand_id;
                    this.brand.status = response.status;
                    this.brand.date_in = response.date_in;
                    this.brand.date_due = response.date_due;
                    $(this.$el).find('select[name=main_status]').val(response.status);
                    $(this.$el).find('.selectpicker').selectpicker('refresh');
                    $(this.$el).find('select[name=brand_id]').val(response.brand_id+'');
                    $(this.$el).find('.selectpicker').selectpicker('refresh');

                    let target_list = [], request_type = [];
                    target_list = response.joweb.target_list.split('.');
                    request_type = response.joweb.request_type.split('.');
                    
                    this.details.target_list = target_list;
                    this.details.request_type = request_type;
                    this.details.tech = response.joweb.tech;
                    this.details.domain_transfer = response.joweb.domain_transfer;
                    this.details.domain_renewal = response.joweb.domain_renewal;
                    this.details.action_points = response.joweb.action_points;
                    this.details.old_cpanel_uname = response.joweb.old_cpanel_uname;
                    this.details.new_cpanel_uname = response.joweb.new_cpanel_uname;
                    this.details.old_cpanel_password = response.joweb.old_cpanel_password;
                    this.details.new_cpanel_password = response.joweb.new_cpanel_password;
                    this.details.date_ended = response.joweb.date_ended;
                    this.details.date_commerced = response.joweb.date_commerced;

                    if(response.joweb.acma_proofed_at && response.joweb.acma_proofed_by) {
                        this.acma.email = response.joweb.acma_signed_by.email
                        this.acma.date = response.joweb.acma_proofed_at
                    }
                    if(response.joweb.web_proofed_at && response.joweb.web_proofed_by) {
                        this.web.email = response.joweb.web_signed_by.email
                        this.web.date = response.joweb.web_proofed_at
                    }
                })
        }
    }
}
</script>

<style scoped lang="scss" scoped>
    @media print{
        .nav-side-menu, noprint{
            display: none;
        }
    }
    table{
        border: 1px solid gray !important;
    }
    label{
        color: #868686 !important;
        font-weight: 700 !important;
        font-size: 0.9em !important;
    }

    .btn-group, .btn-group-vertical {
        position: relative;
        margin: 2px 1px;
    }

    label > small{
        font-weight: normal;
    }
    .jo-barcode{
        margin-top: 10px;
        margin-right: 10px;
        width: 100px;
        height: 100px;
        border: 1px solid gray;
    }
    .btn-group bootstrap-select{
        margin-top: 0px !important;
        margin-bottom: 7px !important;
    }
    div.checkbox > label{
        font-weight: normal !important;
    }
</style>


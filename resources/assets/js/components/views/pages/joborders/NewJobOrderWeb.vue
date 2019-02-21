<template>
    <section class="main-main-container" style="">
    <add-member :notmember="boardNotMembers" :board_id="brand.board_id" @refreshBoardMembers="refreshBoardMembers" @addedIds="addMemberToNewBoard" v-if="viewMemmod" @close="toggleJustNewMember"></add-member>
    <div class="jo-wrapper" style="max-height: 100vh; overflow-y: scroll;">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form - Web</h2>
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
                                        <select v-model="brand.status" class="my-input">
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
                <form @submit.prevent="newWebJO">
                    <!--BRAND CLIENT ACMA -->
                    <div class="row form-row">
                        <div class="col-md-6 form-group">
                            <label for="jo_name">Name </label>
                            <input required v-model="brand.name" name="jo_name" id="jo_name" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="brand">Brand:</label>
                            <!-- <div class="btn-group bootstrap-select"> -->
                                <select required v-model="brand.brand_id" class="my-thin-select my-inp-blk" type="text">
                                        <option value="">---</option>
                                        <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
                                </select>
                            <!-- </div> -->
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
                                <input required v-model="brand.date_in" class="form-control" type="date" />
                            </div>
                            <div class="form-group">
                                <label for=""><span class="fa fa-calendar-o text-danger"></span> Date Due
                                    <small><i> (dd-mm-yyyy)</i></small></label>
                                <input required v-model="brand.date_due" class="form-control" type="date" />
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
                                        <input type="radio" v-model="details.tech" value="1" name="tech"><span class="check"></span>
                                        Request for Domain Purchase
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.tech" value="2" name="tech"><span class="check"></span>
                                        With Previous Domain
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rqst_type">Domain Transfer:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_transfer" value="1" name="transfer"><span class="check"></span>
                                        Domain Unlocked
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_transfer" value="2" name="transfer"><span class="check"></span>
                                        Auth/EPP Code Provided
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rqst_type">Domain Renewal:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_renewal" value="1" name="renewal"><span class="check"></span>
                                        Domain for Renewal
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" v-model="details.domain_renewal" value="2" name="renewal"><span class="check"></span>
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
                    <br/>
                    <div class="row">
                            <div class="col-md-6" v-if="boards">
                                <label for="brand">Board:</label>
                                <p class="text-gray no-margin"><small>Select a board to where all tasks here should be managed.</small></p>
                            <div v-if="justNewBoard==false">
                                <select required @change="getJOBoardUsers" v-model="board" name="board_id" class="my-thin-select my-inp-blk">
                                    <option value="">---</option>
                                        <!-- <option value="new">New Board</option> -->
                                        <option v-for="board in boards" :key="board.id" :value="board">{{ board.name }}  ({{ board.type == 1? 'kanban' : 'scrum' }})</option>
                                </select>
                                <a @click="toggleJustNewBoard" style="cursor:pointer"><small>or Add New Board</small></a>
                            </div>
                            <div v-if="justNewBoard==true">
                            <div class="form-group is-empty">
                                <input @blur="getJOBoardUsers" required v-model="brand.newBoard.name" type="text" class="form-control" placeholder="New Board Name ">
                            </div>
                            <div class=" text-center">
                                <div class="radio">
                                    <span>
                                        <label>
									        <input required @change="getJOBoardUsers" v-model="brand.newBoard.type" value="1" type="radio" name="optionsRadios"><span class="circle"></span><span class="check"></span>
									        Kanban
								        </label>
                                    </span>
                                    <span>
                                        <label>
									        <input required @change="getJOBoardUsers" v-model="brand.newBoard.type" value="2" type="radio" name="optionsRadios"><span class="circle"></span><span class="check"></span>
									        Scrum
								        </label>                                
                                    </span>
						        </div>
                            </div>
                            <a @click="toggleJustNewBoard" style="cursor:pointer"><small>or just select from existing boards</small></a>
                            </div>
                                   
                            </div>
                            <div class="col-md-6"  v-if="isScrum">
                                <label>New User Story: </label>
                                <button type="button" @click="addNewUS" class="btn btn-success btn-md btn-block">Add User Story</button>
                            </div>
                            <div class="col-md-6"  v-if="!isScrum">
                                <label>New Task: </label>
                                <button type="button" @click="addNewTaskK" class="btn btn-success btn-md btn-block">Add New Task</button>
                            </div>
                        </div>
                        <br/>

                <!--if selected board is scrum-->
                <div v-if="isScrum" >
                    <!-- <p class="no-margin"><span class="txt-bold">Tasks Section</span> . <small class="text-gray">Add tasks for this JO by adding User Story first.</small><p> -->
                    <!-- <p class="note">Add tasks for this JO by adding User Story first.</p>     -->
                    <!-- <button type="button" @click="addNewUS" class="btn btn-success btn-md">Add User Story</button> -->
                    
                    <div class="jo-body brl-gray" v-for="(userstory, index) in userstories" :key="index" style="background-color: whitesmoke; margin-bottom: 15px;">
                        <div class="row pb-10">
                            <div class="col-md-12">
                                <h4><span class="fa fa-list-ul"></span> User Story #{{ index + 1 }} {{ userstory.name }}</h4>
                            </div>
                            <div class="col-md-8">
                                <div class="form-inline">
                                <label for="" class="control-label">User Story Name:</label>
                                <input required type="text" class="my-input my-inp-blk" v-model="userstory.name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                <label for="" class="control-label">Points:</label>
                                <select required v-model="userstory.points" name="" id="" class="my-input my-inp-blk">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="8">8</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" @click="addNewTask(index)" class="btn btn-success btn-sm">Add Task</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                    
                            <div class="">
                            
                            <div class="row" id="addtaskdiv">
                                <div class="col-md-12">
                                    <br/>
                                    <div class="card taskcard" v-for="(task, i) in userstory.tasks" :key="i">
                                        <span class="pull-right" @click="deleteTaskForm(index,i)" style="cursor:pointer"><i class="fa fa-times"></i></span>
                                        <h5 class="text-gray"><span class="fa fa-tasks"></span> Task #{{i+1}}</h5>
                                        <div class="form-row">
                                            <div class="col-md-7">
                                                <label for="">Name </label>
                                                <input required v-model="task.name" type="text" class="form-control">
                                                <label for="">Decription </label>
                                                <textarea type="text" v-model="task.desc" class="btn-block" placeholder="" ></textarea>
                                            </div>
                                            <div class="col-md-5">
                                                <label for=""><span class="fa fa-user-o"></span> Assign to </label>
                                                <select required v-model="task.assign" class="btn-block" >
                                                    <option value="">--</option>
                                                    <option :value="member.id" v-for="member in boardMembers" :key="member.id">{{ member.name }}</option>
                                                </select>
                                                <a @click="toggleJustNewMember" style="cursor:pointer"><small>or Add Member</small></a> <br>
                                                <label for=""><span class="fa fa-clock-o"></span> Due </label>
                                                <date-picker @change="changeDateFormat(task.due)" v-model="task.due" format="MM-DD-YYYY" :not-before="new Date().setDate(new Date().getDate()+1)" lang="en" class="my-inp-blk"></date-picker>
                                                <label for="" style="margin-top: 8px"><span class="fa fa-file-o"></span> Attach File</label>
                                                <input id="taskFiles" @change="usOnFileChange($event, i, userstory)" class="btn-block" type="file" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            </div>
                            </div>

                        </div>
                    </div>
                    <!-- </div> -->
                </div>

                <!--if selected board is kanban-->
                        <div v-if="!isScrum" class="jo-body" style="background-color: whitesmoke">
                            <div class="row pb-10">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-10">
                                    <div class="row" id="addtaskdiv">
                                        <br/>
                                        <div class="col-md-12">
                                            <div class="card taskcard" v-for="(task, index) in tasks" :key="index">
                                                <span class="pull-right" @click="deleteTaskForm(index)" style="cursor:pointer"><i class="fa fa-times"></i></span>
                                                <h5 class="text-gray"><span class="fa fa-tasks"></span> Task #{{index+1}}</h5>
                                                <div class="form-row">
                                                    <div class="col-md-7">
                                                        <label for="">Name </label>
                                                        <input required v-model="task.name" type="text" class="form-control">
                                                        <label for="">Decription </label>
                                                        <textarea type="text" v-model="task.desc" class="btn-block" placeholder="" ></textarea>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for=""><span class="fa fa-user-o"></span> Assign to </label>
                                                        <select required v-model="task.assign" class="btn-block" >
                                                            <option value="">--</option>
                                                            <option :value="member.id" v-for="member in boardMembers" :key="member.id">{{ member.name }}</option>
                                                        </select>
                                                        <a @click="toggleJustNewMember" style="cursor:pointer"><small>or Add Member</small></a> <br>
                                                        <label for=""><span class="fa fa-clock-o"></span> Due </label>
                                                        <date-picker @change="changeDateFormat(task.due)" v-model="task.due" format="MM-DD-YYYY" :not-before="new Date().setDate(new Date().getDate()+1)" lang="en" class="my-inp-blk"></date-picker>
                                                        <label for="" style="margin-top: 8px"><span class="fa fa-file-o"></span> Attach File</label>
                                                        <input id="taskFiles" @change="onFileChange($event, index)" class="btn-block" type="file" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        </div>



                    <hr>
                     <div class="row">
                        <!-- <div class="col-md-12">
                                <label for="rqst_type">Status:</label> 
                                </div> -->
                                <div class="col-md-12">
                                     <label for="rqst_type">Accomplish list below before going live:</label>
                                </div>
                                <div class="col-md-6">
                                    
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
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-4" v-if="false">
                                    <!-- <div class="checkbox mr-10">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Revisions Below
                                        </label>
                                    </div> -->
                                    <label for="rqst_type">Proofed by (Web Team):</label>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Check this to confirm proofing.
                                        </label>
                                        <p class="note">Please enter email and password for verification.</p>
                                        <input class="form-control my-input mb-5" type="email" placeholder="Email...">
                                        <input class="form-control my-input" type="password" placeholder="Password...">

                                    </div>
                                </div>
                                <div class="col-md-4" v-if="false">
                                    <label for="">Changes Approved by: (ACMA+BO)</label>
                                    <div class="checkbox mr-10">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Check this to approve changes.
                                        </label>
                                    </div>
                                    <p class="note">Please enter email and password for verification.</p>
                                        <input class="form-control my-input mb-5" type="email" placeholder="Email...">
                                        <input class="form-control my-input" type="password" placeholder="Password...">
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

        <div class="modal fade" id="SuccesNewJoWeb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-small ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4 class="no-margin"><span class="fa fa-check-circle text-success"></span> Success!</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p>A new job order was created successfully.</p>
                        <p class="txt-bold">Do you want to view this JO?</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button @click="notsuccess()" type="button" class="btn btn-sm btn-simple" >Just Go To List</button>
                        <button @click="success()" type="button" class="btn btn-sm btn-success btn-simple">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ErrorNewJoWeb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-small ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4 class="no-margin"><span class="fa fa-times-circle text-danger"></span> Error!</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p>A network error has occured.</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-simple" data-dismiss="modal">Cancel</button>
                        <button @click="this.$router.push({name: 'all_jo_list'})" type="button" class="btn btn-success btn-simple">Retry</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
import DatePicker from 'vue2-datepicker'
import AddMember from './AddBoardMember.vue';

export default {
    components: {
        addMember: AddMember,
        DatePicker
    },
    data(){
        return{
            justNewBoard: false,
            tasks: [
                {
                    name: '', 
                    desc: '', 
                    assign: '', 
                    files: [],
                    due: ''
                }
            ], 
            userstories: [
                {
                    name: '',
                    desc: '',
                    points: 0,
                    tasks: [
                        {
                            name: '', 
                            desc: '', 
                            assign: '', 
                            files: [],
                            due: ''
                        }
                    ], 
                }

            ],
            brand: {
                name: '',
                brand_id: '',
                board_id: '',
                newBoard: {
                    name: '',
                    type: 2,
                    ids: []
                },
                status: 1,
                date_in: '',
                date_due: ''
            },
            details: {
                target_list: [],
                request_type: [],
                tech: null,
                domain_transfer: null,
                domain_renewal: null,
                action_points: '',
                old_cpanel_uname: '',
                new_cpanel_uname: '',
                old_cpanel_password: '',
                new_cpanel_password: '',
                date_commerced: null,
                date_ended: null
            },
            attachments: [],
            viewMemmod: false,
            boardMembers: [],
            boardNotMembers: [], 
            board: null,
            isScrum: true,
            joid: ''
        }
    },
    created() {
        this.$store.dispatch('onCreate')
            .then(() => {
                $(this.$el).find('.selectpicker').selectpicker('refresh');
            })
        this.$store.dispatch('getUserBoards')
            .then(() => {
                $(this.$el).find('.selectpicker').selectpicker('refresh');
            })
    },
    mounted() {
        // $('#ErrorNewJoWeb').modal('show');
    },
    computed: {
        ...mapGetters({
                brands: 'getBrands',
                boards: 'userBoards'
            }),        
    },
    methods: {
        addNewTaskK(){
            this.tasks.push({
                name: '',
                desc: '',
                assign: '', 
                files: [],
                due: ''
            })
            this.scrollToEnd()
        },
        addNewTask(index){
            console.log('asdasd');
            
            this.userstories[index].tasks.push({
                name: '',
                desc: '',
                assign: '', 
                files: [],
                due: ''
            });
            this.scrollToEnd()
        },
        addNewUS(){
            this.userstories.push({
                name: '',
                desc: '',
                points: 0,
                tasks: [{
                    name: '',
                    desc: '',
                    assign: '', 
                    files: [],
                    due: ''
                }]
            })
        },
        deleteTaskForm(usind,taskind){
            this.userstories[usind].tasks.splice(taskind,1)
        },
        scrollToEnd(){
            var taskdiv = document.querySelector("#addtaskdiv")
            // var scrollHeight = taskdiv.scrollHeight + 200
            taskdiv.scrollTop = taskdiv.scrollHeight

        },

        newWebJO() {
            if(!this.brand.board_id) {
                this.brand.newBoard.ids = this.boardMembers;
            }
            let form = new FormData;
            form.append('brand', JSON.stringify(this.brand));
            form.append('details', JSON.stringify(this.details));
            form.append('tasks', JSON.stringify(this.isScrum ? this.userstories : this.tasks));
            for(let i=0; i<this.attachments.length;i++){
                form.append('files[]',this.attachments[i]);
            }
            this.$store.dispatch('newJOW', form)
                .then ((response) => {
                    const jodata = response.data;
                    this.joid = jodata.id;
                    $('#SuccesNewJoWeb').modal('show');
                })  
        },
        notsuccess() {
            $('#SuccesNewJoWeb').modal('hide');
            this.$router.push({name: 'all_jo_list'})

        },
        success() {
            $('#SuccesNewJoWeb').modal('hide');
            this.$router.push({name: 'viewjoweb', params: {jo_id: this.joid}})

        },

        onFileChange(e, index) {
            this.tasks[index].files = [];
            // this.attachments = [];
            let selectedFiles=e.target.files;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                let file = {filename: selectedFiles[i].name, type: selectedFiles[i].type}
                this.tasks[index].files.push(file);
                this.attachments.push(selectedFiles[i]);
            }
            // document.getElementById('taskFiles').value=[];
            // console.log(this.tasks[index].files);
        },
        usOnFileChange(e, index, us) {
            us.tasks[index].files = [];
            // this.attachments = [];
            let selectedFiles=e.target.files;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                let file = {filename: selectedFiles[i].name, type: selectedFiles[i].type}
                us.tasks[index].files.push(file);
                this.attachments.push(selectedFiles[i]);
            }
            // document.getElementById('taskFiles').value=[];
            // console.log(this.tasks[index].files);
        },
        toggleJustNewBoard() {
            this.justNewBoard = !this.justNewBoard;
            if(this.justNewBoard == true) {
                this.brand.board_id = ''
                this.board = null
            }
            else {
                this.brand.newBoard.name = ''
            }
        },
        toggleJustNewMember() {
            this.viewMemmod = !this.viewMemmod;
        },
        getJOBoardUsers() {
            if(this.board) {
                console.log(this.board);
                
                if(this.board.type == 1) {
                    this.isScrum = false
                }
                else {
                    this.isScrum = true
                }
            }
            else {
                console.log(this.board);
                if(this.brand.newBoard.type == 1) {
                    this.isScrum = false
                }
                else {
                    this.isScrum = true
                }
            }
            if(this.justNewBoard == true) {
                this.brand.board_id = '';
                axios.post('/api/getJOBoardUsers', {board_id: null})
                    .then(response => {
                        // console.log(response);
                        this.boardNotMembers = response.data;
                        this.boardMembers = []
                    })

            }
            else {
                this.brand.newBoard.name = ''
                this.brand.board_id = this.board.id
                axios.post('/api/getJOBoardUsers', {board_id: this.brand.board_id})
                    .then(response => {
                        // console.log(response);
                        this.boardMembers = response.data.member;
                        this.boardNotMembers = response.data.not
                    })
            }
        },
        addMemberToNewBoard(e) {
            // console.log(e);
            e.forEach(element => {
                this.boardMembers.push(element);
                let index = _.findIndex(this.boardNotMembers, {id: element.id});
                this.boardNotMembers.splice(index, 1);
            });
        },
        refreshBoardMembers(e) {
            this.boardMembers =  e.member;
            this.boardNotMembers = e.not
        },
        changeDateFormat(date) {
            // this.taskData.due = new Date(this.taskData.due).toISOString().slice(0, 10).replace('T', ' ');
            date = moment(date).format('YYYY-MM-DD')
            console.log(date);
            
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
    .peruserstory{
        background-color: #efefef;
    }
    .modal-small .modal-body{
        margin-top: 0;
    }
</style>


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
                                        <span v-if="details.status == 2" class="txt-bold text-danger" title="Job Order Status: Overdue"><i class="fa fa-circle"></i></span>
                                        <span v-if="details.status == 3" class="txt-bold text-warning" title="Job Order Status: Pending"> <i class="fa fa-circle"></i></span>
                                        <span v-if="details.status == 4" class="txt-bold text-success" title="Job Order Status: Completed"><i class="fa fa-circle"></i></span>
                                    </h4>
                                    <p class="no-margin"><small class="text-gray">Job Order ID: {{ details.id }}</small></p>
                                    <!-- <p class="no-margin"><small class="text-gray">Brand: {{ details.brand.name }} </small></p> -->
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <p class="text-gray" style="margin-top:10px"><small>Job Order Progress: <b>{{ taskPercent }}%</b></small></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-v-8b3961f4="" class="progress progress-line-info"><div data-v-8b3961f4="" class="progress-bar progress-bar-info" :style="'width:'+ taskPercent +'%'">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <div class="row" v-if="details.brand">
                                <div class="col-md-4">
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin"><span class="txt-bold">DETAILS</span></p>
                                        </div>
                                    </div> -->
                                    <!-- <p class="no-margin txt-bold">ABOUT</p> -->
                                    <!-- <br> -->
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
                                    <!-- <br/> -->
                                    <!-- <div class="row">
                                        <div class="col-md-5 col-sm-8 col-xs-6">
                                            <p class="no-margin text-gray"><small>Request Type:</small></p>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-6 text-right">
                                            <p class="no-margin" v-for="(request, index) in details.joweb.request_type" :key="index" v-if="request">
                                                <span v-if="request == 1">Information Update </span> 
                                                <span v-if="request == 2">Page Deletion </span> 
                                                <span v-if="request == 3">Additional Page </span> 
                                                <span v-if="request == 4">Setup Mail </span> 
                                                <span v-if="request == 5">Contact Details Change </span> 
                                                <span v-if="request == 6">URL & Domain Change </span> 
                                            </p>
                                        </div>
                                    </div> -->

                                    <br/>
                                    
                                    <!-- <div class="row">
                                        <div class="col-md-12 text-center ">
                                            <p class="txt-bold">DOMAIN</p>
                                        </div>
                                    </div> -->

                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin"><span class="txt-bold">TECH</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray"><small>Domain Use:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.tech == 1">Request Domain Purchase </p> 
                                            <p v-if="details.joweb.tech == 2">With Previous Domain </p>
                                            <p class="no-margin" v-else>-</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin  text-gray"><small>Domain Transfer:</small></p> 
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.domain_transfer == 1">Domain Unlocked </p> 
                                            <p v-if="details.joweb.domain_transfer == 2">Auth/EPP Code Provided</p>
                                            <p class="no-margin" v-else>-</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray"><small>Domain Renewal:</small></p> 
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.domain_renewal == 1">Domain for Renewal </p> 
                                            <p v-if="details.joweb.domain_renewal == 2">Change Domain </p>
                                            <p class="no-margin" v-else>-</p> 
                                        </div> 
                                    </div> -->
                                    
                                    <!-- <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin"><span class="txt-bold">Old Host cPanel</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray"><small><span class="fa fa-user-o"></span> Username:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p class="no-margin">{{ details.joweb.old_cpanel_uname }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray"><small><span class="fa fa-lock"></span> Password: </small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.old_cpanel_password == NULL" class="no-margin"> -</p>
                                            <p v-else class="no-margin">{{ details.joweb.old_cpanel_password }}</p>
                                        </div>
                                    </div> -->
                                    <!-- </div> -->
                                    <!-- </div> -->
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin"><span class="txt-bold">New Host cPanel</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray"><small><span class="fa fa-user-o"></span> Username:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p class="no-margin">{{ details.joweb.new_cpanel_uname }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray"><small><span class="fa fa-lock"></span> Passport:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p class="no-margin">{{ details.joweb.new_cpanel_password }}</p>
                                        </div>
                                    </div> -->


                                </div>
                                <!-- <div class="col-md-1">
                                </div> -->
                                <div class="col-md-4 pl-4" v-if="details.joweb">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin"><span class="txt-bold"><span class="fa fa-hdd-o"></span> TECH</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray">&nbsp;&nbsp;<small>Domain Use:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.tech == 1" class="no-margin">Request Domain Purchase </p> 
                                            <p v-if="details.joweb.tech == 2" class="no-margin">With Previous Domain </p>
                                            <p class="no-margin" v-else>-</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin  text-gray"><small>&nbsp;&nbsp;Domain Transfer:</small></p> 
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.domain_transfer == 1" class="no-margin">Domain Unlocked </p> 
                                            <p v-else-if="details.joweb.domain_transfer == 2" class="no-margin">Auth/EPP Code Provided</p>
                                            <p class="no-margin" v-else>-</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray"><small>&nbsp;&nbsp;Domain Renewal:</small></p> 
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.domain_renewal == 1" class="no-margin">Domain for Renewal </p> 
                                            <p v-if="details.joweb.domain_renewal == 2" class="no-margin">Change Domain </p>
                                            <p class="no-margin" v-else>-</p> 
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-8 col-xs-6">
                                            <p class="no-margin"><small><span class="fa fa-check-square-o"></span> Request Type:</small></p>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-6 text-right">
                                            <p class="no-margin" v-for="(request, index) in details.joweb.request_type" :key="index" v-if="request">
                                                <span v-if="request == 1">Information Update </span> 
                                                <span v-if="request == 2">Page Deletion </span> 
                                                <span v-if="request == 3">Additional Page </span> 
                                                <span v-if="request == 4">Setup Mail </span> 
                                                <span v-if="request == 5">Contact Details Change </span> 
                                                <span v-if="request == 6">URL & Domain Change </span> 
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4" v-if="details.joweb">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin"><span class="txt-bold">Old Host cPanel</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray">&nbsp;&nbsp;<small><span class="fa fa-user-o"></span> Username:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p class="no-margin">{{ details.joweb.old_cpanel_uname }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray">&nbsp;&nbsp;<small><span class="fa fa-lock"></span> Password: </small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p v-if="details.joweb.old_cpanel_password == null" class="no-margin"> -</p>
                                            <p v-else class="no-margin">{{ details.joweb.old_cpanel_password }}</p>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- </div> -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin"><span class="txt-bold">New Host cPanel</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray">&nbsp;&nbsp;<small><span class="fa fa-user-o"></span> Username:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p class="no-margin">{{ details.joweb.new_cpanel_uname }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="no-margin text-gray">&nbsp;&nbsp;<small><span class="fa fa-lock"></span> Passport:</small></p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <p class="no-margin">{{ details.joweb.new_cpanel_password }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>

                    </div>



                </div>
                
                <div class="row mt-4" v-if="details.board">
                    <div class="col-md-5">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="no-margin text-gray"><span class="txt-bold"><span class="fa fa-trello"></span>&nbsp;Board</span><small></small></p>
                                </div>
                                <div class="col-md-7 text-right">
                                    <router-link :to="{name: details.board.type == 1 ? 'kanboard' : 'test', params: {board_id: details.board.id}}" class="no-margin text-gray"><small>{{ details.board.name }}</small></router-link>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="no-margin"><span class="txt-bold"><span class="fa fa-tasks"></span> Tasks List</span>&nbsp;<small><span class="text-gray">({{ completedTasks }} / {{ details.tasks.length }})</span></small></p>
                                </div>
                                <!-- <div class="col-md-5 text-right">
                                    <p class="no-margin text-gray"><small>{{ taskPercent }}%</small></p>
                                </div> -->
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="progress progress-line-success">
		                    	        <div class="progress-bar progress-bar-success" :style="'width:'+ taskPercent +'%'">
		                                    <span class="sr-only">35% Complete (success)</span>
		                                </div>
		                            </div>
                                </div>                                
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-7">
                                    <p class="no-margin text-gray"><small>Board: The Potato Scrum Boards</small></p>
                                </div>
                                <div class="col-md-5">
                                    <p class="no-margin text-gray"><small>12 Tasks</small></p>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="torev3">
                                        <div class="torevdiv3" v-for="(task) in details.tasks" :key="task.id">
                                            
                                            <!-- if currently active -->
                                            <div class="torev-content divactive" v-if="taskStatus(task) == 'active'">
                                                <h6 class="no-margin txt-bold text-info"><span class="fa fa-circle text-info"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> {{ task.assigned_to.name }}</small> . 
                                                    <small><span class="fa fa-clock-o"></span> {{ task.due | moment('MMM DD, YYYY') }}</small> . 
                                                    <!-- <small>2 days left</small> -->

                                                </p>
                                            </div>

                                            <!-- if currently active 1 day before or on due-->
                                            <div class="torev-content divwarning" v-if="taskStatus(task) == 'tomorrow'">
                                                <h6 class="no-margin txt-bold text-warning"><span class="fa fa-circle text-warning"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> {{ task.assigned_to.name }}</small> . 
                                                    <small><span class="fa fa-clock-o"></span> {{ task.due | moment('MMM DD, YYYY') }}</small> . 
                                                    <small>1 day left</small>
                                                </p>
                                            </div>

                                            <!-- if completed -->
                                            <div class="torev-content divcompleted" v-if="taskStatus(task) == 'completed'">
                                                <h6 class="no-margin txt-bold text-success"><span class="fa fa-check text-success"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> {{ task.assigned_to.name }}</small> . 
                                                    <small><span class="fa fa-clock-o"></span> {{ task.due | moment('MMM DD, YYYY') }}</small> . 
                                                </p>
                                            </div>

                                            <!-- if overdued & not yet completed -->
                                            <div class="torev-content divoverdued" v-if="taskStatus(task).message == 'overdue'">
                                                <h6 class="no-margin txt-bold" text-danger><span class="fa fa-circle text-danger"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> {{ task.assigned_to.name }}</small> . 
                                                    <small><span class="fa fa-clock-o"></span> {{ task.due | moment('MMM DD, YYYY') }}</small> . 
                                                    <small>due {{ taskStatus(task).day }} days ago</small>
                                                </p>
                                            </div>

                                            <!-- if overdued but completed after due date-->
                                            <div class="torev-content divwarning" v-if="taskStatus(task) == 'today'">
                                                <h6 class="no-margin txt-bold text-warning"><span class="fa fa-circle text-warning"></span> {{ task.name }} </h6>
                                                <p class="no-margin">
                                                    <small><span class="fa fa-user-o"></span> {{ task.assigned_to.name }}</small> . 
                                                    <small><span class="fa fa-clock-o"></span> {{ task.due | moment('MMM DD, YYYY') }}</small> . 
                                                    <small>Due today</small>
                                                </p>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-7" v-if="details.joweb">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="no-margin txt-bold"><span class="fa fa-sticky-note-o"></span> Notes & Action Points</p>
                                            <!-- <hr/> -->
                                            <p v-if="details.joweb.action_points != ''" class="txt-bold">{{ details.joweb.action_points }}</p>
                                            <p v-else> - </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="txt-bold"><span class="fa fa-check-square-o"></span> Checklist Before Going Live</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" v-if="details.joweb">
                                            <p v-if="details.joweb.target_list === 1" class="no-margin"> All numbers are working/reachable</p>
                                            <p v-else-if="details.joweb.target_list === 2" class="no-margin"> All emails are working/not bouncing</p>
                                            <p v-else-if="details.joweb.target_list === 3" class="no-margin"> ACMA/BO approved for posting</p>
                                            <p v-else-if="details.joweb.target_list === 4" class="no-margin"> Copy has been proofed</p>
                                            <p v-else-if="details.joweb.target_list === 5" class="no-margin"> Prices of products/services are accurate</p>
                                            <p v-else-if="details.joweb.target_list === 6" class="no-margin"> All URL links in menu are working</p>
                                            <p v-else class="no-margin"> - </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        
                        <div class="taskchart shadow" v-if="details.joweb">
                            <div class="row">
                        
                                <div class="col-md-6">
                                    <form @submit.prevent="signed">
                                    <div class="row" v-if="details.joweb.acma_proofed_at">
                                        <div class="col-md-12">
                                            <div>
                                                <p><span class="txt-bold">Proofed by :</span> {{ details.joweb.acma_signed_by.email }}</p>
                                                <p><span class="txt-bold">Date Approved :</span> {{ details.joweb.acma_proofed_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="proofed.check">
                                        <br/>
                                        <div class="col-md-12">
                                            <p class="no-margin txt-bold"><span class="fa fa-pencil"></span > Proofing Verification</p>
                                            <p v-if="webProofedError" class="text-danger"><small>Sorry. You're unauthorized to proof this JO.</small></p>
                                            <p class="no-margin ext-grayt"><small>Please enter email and password for verification.</small></p>

                                            <div class="form-group">
                                                <label class="">Email:</label>
                                                <input v-model="proofed.email" class="my-input mb-5 my-inp-blk" type="email">
                                            </div>
                                            <div class="form-group">
                                                <label class="">Password:</label>
                                                <input v-model="proofed.password" class="my-input my-inp-blk" type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="!details.joweb.acma_proofed_at">
                                        <div class="col-md-12" v-if="!proofed.check">
                                            <button @click="proofed.check = !proofed.check" class="btn btn-success btn-md btn-block" type="button">Proof</button>
                                        </div>
                                        <div class="col-md-12" v-if="proofed.check">
                                            <button @click="proofed.check = !proofed.check" class="btn btn-default btn-md btn-block" type="reset" value="Reset">Cancel</button>
                                            <button class="btn btn-success btn-md btn-block" type="submit">Confirm Proof</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <form @submit.prevent="signed">
                                    <div class="row" v-if="details.joweb.acma_proofed_at">
                                        <div class="col-md-12">
                                            <div>
                                                <p><span class="txt-bold">Approved by :</span> {{ details.joweb.acma_signed_by.email }}</p>
                                                <p><span class="txt-bold">Date Approved :</span> {{ details.joweb.acma_proofed_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="approved.check">
                                        <br/>
                                        <div class="col-md-12">
                                            <p class="no-margin txt-bold"><span class="fa fa-pencil"></span > Approval Verification</p>
                                            <p v-if="acmaAprovedError" class="text-danger"><small>Sorry. You're unauthorized to proof this JO.</small></p>
                                            <p class="no-margin ext-grayt"><small>Please enter email and password for verification.</small></p>

                                            <div class="form-group">
                                                <label class="">Email:</label>
                                                <input v-model="approved.email" class="my-input mb-5 my-inp-blk" type="email">
                                            </div>
                                            <div class="form-group">
                                                <label class="">Password:</label>
                                                <input v-model="approved.password" class="my-input my-inp-blk" type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="!details.joweb.acma_proofed_at">
                                        <div class="col-md-12" v-if="!approved.check">
                                            <button type="reset" @click="approved.check = !approved.check" class="btn btn-success btn-md btn-block">Approve</button>
                                        </div>
                                        <div class="col-md-12" v-if="approved.check">
                                            <button type="reset" @click="approved.check = !approved.check" class="btn btn-default btn-md btn-block">Cancel</button>
                                            <button class="btn btn-success btn-md btn-block" type="submit">Confirm Approval</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>

                <div class="row mt-4" v-if="show">
                    <div class="col-md-12">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="no-margin"><span class="txt-bold"><span class="fa fa-tasks"></span> {{ details.name }}'s Workload</span></p>
                                    <hr/>
                                </div>
                                <!-- <div class="col-md-5 text-right">
                                    <p class="no-margin text-gray"><small>80%</small></p>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <gantt-elastic v-if="show" ref="shei" :tasks="tasks" :options="options">
                                        <gantt-header slot="header"></gantt-header>
                                    </gantt-elastic>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
            </div>
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
import dayjs from "dayjs";
import GanttElastic from './../workload/GanttElastic.vue';
import Header from './../workload/Header.vue';
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
          }, 

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
    computed: {
        taskPercent() {
            if(this.details) {
                var done = 0;
                var total = 0;
                if(this.details.tasks) {
                    this.details.tasks.forEach(task => {
                        total++;
                        if(task.card_id) {
                            if(task.card.isDone) {
                                done++;
                            }
                        }
                        else {
                            if(task.status == 4) {
                                done++;
                            }
                        }
                    });
                }
                return Math.round((done/total) * 100);
            }
        },
        completedTasks() {
            var ctasks = 0
            this.details.tasks.forEach(task => {
                if(task.card_id) {
                    if(task.card.isDone) {
                        ctasks++;
                    }
                }
                else {
                    if(task.status == 4) {
                        ctasks++;
                    }
                }
            });

            return ctasks;
        }
    },
    methods: {
        getJoDetails() {
            this.show = false;
            this.$store.dispatch('getJoDetails', this.$route.params.jo_id)
                .then ((response) => {
                    this.show = false;
                    this.details = response.jobor;

                    if(response.joweb) {
                        let target_list = [], request_type = [];
                        target_list = response.joweb.target_list.split('.');
                        request_type = response.joweb.request_type.split('.');
                        
                        this.details.joweb.target_list = target_list;
                        this.details.joweb.request_type = request_type;
                    }

                    // console.log(this.details);

                    this.tasks = [];
                    this.show = false;
                    let colors = [
                        '#fc5c65',
                        '#fd9644',
                        '#45aaf2',
                        '#A3CB38',
                        '#ffc048',
                        '#D6A2E8',
                        '#fd79a8',
                    ];
                    let tasks = response.workload;
                    let style = {
                    style : {
                        base: {
                        fill: '#D6A2E8',
                        stroke: '#fff'
                        }
                    }
                    }

                    tasks.forEach(task => {
                        if(task.status == 'Completed') {
                            task = Object.assign(task, {style : {
                                base: {
                                fill: '#A3CB38',
                                stroke: '#fff'
                                }
                            }});
                        }

                        else if(task.status == 'Overdue') {
                            task = Object.assign(task, {style : {
                                base: {
                                fill: '#fc5c65',
                                stroke: '#fff'
                                }
                            }});
                        }
                        
                        else if(task.status == 'Due Today' || task.status == 'Due Tomorrow') {
                            task = Object.assign(task, {style : {
                                base: {
                                fill: '#ffc048',
                                stroke: '#fff'
                                }
                            }});
                        }
                        
                        else if(task.status == 'Active') {
                            task = Object.assign(task, {style : {
                                base: {
                                fill: '#45aaf2',
                                stroke: '#fff'
                                }
                            }});
                        }
                    task.start = ''+task.start;
                    this.tasks.push(task)
                    });
                    this.show = true;
                    // console.log(this.tasks);
                })
        },
        
        signed() {
            if(this.taskPercent == 100) {
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
            }
            else {
                alert('Di pa pwede, tapusin niyo task niyo, Gagu!');
            }
        },

        success() {
            $('#SuccesWebSignOff').modal('hide');
            this.$router.push({name: 'all_jo_list'})
        },

        taskStatus(task) {
            // console.log(task);
            var today = new Date();
            var due = moment(task.due).format('YYYY-MM-DD')
            today = moment(today).format('YYYY-MM-DD')
            // var diff = moment(today).diff(moment(task.due), 'days')
            if(task.card_id) {
                if(task.card.isDone) {
                    // console.log('completed');
                    return 'completed'
                }
                else {
                    if(moment(today).isAfter(moment(task.due), 'days')) {
                        // console.log('overdue');
                        var diff = moment(today).diff(moment(task.due), 'days')
                        return {
                            message: 'overdue',
                            day: diff
                        }
                    }

                    else if(moment(today).isSame(moment(task.due), 'days')) {
                        // console.log('due today');
                        return 'today'
                    }

                    else if(moment(today).isBefore(moment(task.due), 'days')) {
                        // console.log('before');
                        var diff = moment(task.due).diff(moment(today), 'days')
                        // console.log(diff);
                        
                        if(diff == 1) {
                            // console.log('due tomorrow');
                            return 'tomorrow'
                        }
                        else {
                            // console.log('active');
                            return 'active'
                        }
                    }
                }
            }
            else {
                if(task.status == 4) {
                    // console.log('completed');
                    return 'completed'
                }
                else {
                    if(moment(today).isAfter(moment(task.due), 'days')) {
                        // console.log('overdue');
                        var diff = moment(today).diff(moment(task.due), 'days')
                        return {
                            message: 'overdue',
                            day: diff
                        }
                    }

                    else if(moment(today).isSame(moment(task.due), 'days')) {
                        // console.log('due today');
                        return 'today'
                    }

                    else if(moment(today).isBefore(moment(task.due), 'days')) {
                        // console.log('before');
                        var diff = moment(task.due).diff(moment(today), 'days')
                        console.log(diff);
                        
                        if(diff == 1) {
                            // console.log('due tomorrow');
                            return 'tomorrow'
                        }
                        else {
                            // console.log('active');
                            return 'active'
                        }
                    }
                }
            }
            
            
        }
    }
}
</script>

<style scoped>

.gantt-elastic__main-view svg{
  display: block;
  /* margin: 10px 15px; */
}
.gantt-elastic__svg-container{
  position: relative;
}
.gantt-elastic__main-view,.gantt-elastic__svg-container{
  background: #fff;
}
.gantt-elastic__container,.gantt-elastic__svg-container{
  max-width: 100%;
}
.gantt-elastic__grid-horizontal-line, .gantt-elastic__grid-vertical-line{
  stroke: #a0a0a0;
  stroke-width: 1;
}
foreignObject > *{
  margin: 0px;
}
.gantt-elastic .p-2{
  padding: 10rem;
}
.gantt-elastic__container{
  display: flex;
  max-width: 100%;
  position: absolute;
  height: 100%;
}
.gantt-elastic__main-view-svg-container , .gantt-elastic__main-view-container{
  overflow: hidden;
  max-width:100%;
}
.gantt-elastic__task-list-header-column:last-of-type{
  border-right: 1px solid #00000050;
}
.gantt-elastic__task-list-item:last-of-type{
  border-bottom:1px solid #00000050;
}
.gantt-elastic__task-list-header-resizer,
.gantt-elastic__task-list-header-resizer-wrapper{
  display: none !important;
}
.workload-user-pic{
  height: 20px; 
  width: 20px; 
  border-radius: 50%;
}


@media print {
  .nav-side-menu,
  noprint {
    display: none;
  }
}
table {
  border: 1px solid gray !important;
}
/* label {
  color: #868686 !important;
  font-weight: 700 !important;
  font-size: 0.9em !important;
} */

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


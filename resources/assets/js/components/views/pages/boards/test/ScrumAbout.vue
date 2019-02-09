<template>
    <transition name="fade">
                    <div class="overlay">
                        <div class="aboutmod">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="taskchart shadow bl-gray">
                                        <h4><span class="fa fa-trello"></span> Scrum Board Name Here - Details <span class="pull-right"><button @click.prevent="$emit('close')" class="btn btn-xs btn-danger btn-simple"><span class="fa fa-times"></span></button></span> </h4>
                                        <p class="note">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore accusamus officia placeat, qui dolorum quis aspernatur fugit laudantium perferendis similique, minima tempore nesciunt amet enim inventore delectus dolorem possimus a.</p>
                                    </div>
                                </div>
                            </div> 
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="taskchart shadow">
                                         <h6 class="txt-bold"><span class="fa fa-history"></span> Activities</h6>
                                         <hr/>
                                     <div class="actlist">
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-success">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam created the board: Board Name</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-success">
                                                <i class="fa fa-user-o medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam added Jenjen to the board</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-warning">
                                                <i class="fa fa-star medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam assgined Jenjen as admin</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-success">
                                                <i class="fa fa-tasks medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam created new task: TaskTitleHere in ListName/SprintName</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-info">
                                                <i class="fa fa-tasks medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam updated the details of task: TaskTitleHere</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-danger">
                                                <i class="fa fa-tasks medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam deleted the task: TaskTitleHere</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-info">
                                                <i class="fa fa-gears medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Admin Sam updated board settings</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-info">
                                                <i class="fa fa-user-o medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam set Jenjen's role to Dev Team or Scrum Master or Product Owner</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-success">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam created new sprint: SprintName1</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-info">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam renamed the SprintName1 to: SprintNameUlet</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-danger">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam deleted the sprint: SprintName1</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-default">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam closed the sprint: SprintName1</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-info">
                                                <i class="fa fa-tasks medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam moved the task TaskTitle to TaskList2</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-warning">
                                                <i class="fa fa-star-o medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam removed Jenjen as admin</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="actdiv">
                                        <div class="act-left">
                                            <div class="act-icon bg-danger">
                                                <i class="fa fa-user-o medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="act-right">
                                            <p>Sam removed Jenjen from the board</p>
                                            <p class="acttime"><small>
                                                <span class="fa fa-clock-o"></span>&nbsp;10:30 am January </small>
                                            </p>
                                        </div>
                                    </div>
                                     </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="taskchart shadow">
                                        <h6 class="txt-bold"><span class="fa fa-user-o"></span> Members</h6>
                                        <hr/>
                                        <h6 class="txt-bold"><small>ADMIN</small></h6>
                                        <div class="membbb">
                                        <div class="membdiv">
                                            <div class="memb-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="memb-right">
                                                <p class="text-default membsender"><span class="txt-bold">Samantha Millos</span></p>
                                                <p class="mainmemb">Scrum Master</p>
                                            </div>
                                        </div>
                                        </div>
                                        <h6 class="txt-bold"><small>MEMBER</small></h6>
                                        <div class="membbb">
                                        <div class="membdiv">
                                            <div class="memb-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="memb-right">
                                                <p class="text-default membsender"><span class="txt-bold">Samantha Millos</span></p>
                                                <p class="mainmemb">Product Owner</p>
                                            </div>
                                        </div>
                                        <div class="membdiv">
                                            <div class="memb-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="memb-right">
                                                <p class="text-default membsender"><span class="txt-bold">Samantha Millos</span></p>
                                                <p class="mainmemb">Dev Team</p>
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

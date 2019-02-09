<template>
    <div class="db-wrapper" style="box-sizing: border-box;">
            <div class="content-area" style="max-width: 1280px; margin: 0 auto;">
                <div class="container-fluid">
                    <div class="main2">
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">To-be-Reviewed Workbooks</p>
                                       <p class="number">10832</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Reviewed Workbooks</p>
                                       <p class="number">75</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">All Workbooks</p>
                                       <p class="number">40</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-star text-warning"></span> To Review Workbooks</p>
                                    <hr>
                                    <div class="torev">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>Potato Corner New Images</h6>
                                            <p><small>by: Aya on Sept. 13, 2019</small></p>
                                        </div>
                                    </div>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                                <br/>
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-bell-o"></span> Notifications</p>
                                    <hr>
                                    <div class="notifsss">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <div class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-info">
                                                <i class="fa fa-envelope-o medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p>You have new message received!</p>
                                        </div>
                                    </div>
                                    <div class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-success">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p><span class="highlight">Sam</span> added you to board <span class="highlight">Board Name Here</span></p>
                                        </div>
                                    </div>
                                    <div class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-warning">
                                                <i class="fa fa-star medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p>The workbook <span class="highlight">_____</span> has been reviewed by <span class="highlight">Luljetta's</span></p>
                                        </div>
                                    </div>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-commenting-o"></span> Recent Messages |
                                    <a href="#" class=""><small class="text-right">Go to Messages</small></a>
                                    </p>
                                    <hr>
                                    <!-- <p class="note">No messages to show</p> -->
                                    <div class="mess">
                                        <div class="msgdiv">
                                            <div class="msg-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="msg-right">
                                                <p class="text-default msgsender"><span class="txt-bold">Samantha Millos</span> . 
                                                <small><span class="fa fa-clock-o"></span>&nbsp;5:31am 1/06</small></p>
                                                <p class="mainmsg">Sam moved the task Encode the data to Completed</p>
                                            </div>
                                        </div>
                                        <div class="msgdiv">
                                            <div class="msg-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="msg-right">
                                                <p class="txt-bold text-default msgsender">Samantha Millos</p>
                                                <p class="mainmsg">Sam moved the task Encode the data to Completed</p>
                                            </div>
                                        </div>
                                        <div class="msgdiv">
                                            <div class="msg-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="msg-right">
                                                <p class="txt-bold text-default msgsender">Samantha Millos</p>
                                                <p class="mainmsg">Sam moved the task Encode the data to Completed</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <br/>

                                <div class="taskchart shadow">
                                    <p><span class="fa fa-check-circle-o"></span> Reviewed Workbooks</p>
                                    <hr>
                                    <div class="torev">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>Potato Corner New Images</h6>
                                            <p><small>by: Aya on Sept. 13, 2019</small></p>
                                        </div>
                                    </div>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-files-o"></span> Job Orders (163) 
                                    <!-- <span><a href="#" title="Create New JO" class="btn btn-just-icon btn-round btn-xs"><i class="fa fa-plus"></i></a></span> -->
                                    </p>
                                    <hr>
                                    <!-- <p class="note">No created JO to show</p> -->
                                    <div class="mess">
                                    <ul class="list-unstyled">
                                        <li><span class="fa fa-circle text-info"></span>
                                            <a href="">MFI JOB Order 10 </a></li>
                                        <li><span class="fa fa-circle text-info"></span>
                                            <a href="">MFI JOB Order 10 </a></li>
                                        <li><span class="fa fa-circle text-info"></span>
                                            <a href="">MFI JOB Order 10 </a></li>
                                        <li><span class="fa fa-circle text-info"></span>
                                            <a href="">MFI JOB Order 10 </a></li>
                                        <li><span class="fa fa-circle text-info"></span>
                                            <a href="">MFI JOB Order 10 </a></li>                             
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
// import VueApexCharts from 'vue-apexcharts';
// export default {
//     components:{
//         apexchart: VueApexCharts
//     }
// }
</script>

<style lang="scss" scoped>
.list-unstyled > li > a{
    color: gray;
}
ul > li a{
    display: inline-block !important;
}
</style>



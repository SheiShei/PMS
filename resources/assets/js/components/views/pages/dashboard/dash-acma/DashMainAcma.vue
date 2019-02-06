<template>
    <div class="db-wrapper" style="box-sizing: border-box;">
            <div class="content-area" style="max-width: 1280px; margin: 0 auto;">
                <div class="container-fluid">
                    <div class="main2">
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-files-o"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Total JO Created</p>
                                       <p class="number">10832</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Total Workbooks Created</p>
                                       <p class="number">75</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-suitcase"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Total Brands Handled</p>
                                       <p class="number">40</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-bell-o"></span> Notifications</p>
                                    <hr>
                                    <div class="notifsss">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    
                                    <a href="#"><div class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-info">
                                                <i class="fa fa-envelope-o medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p>You have new message received!</p>
                                        </div>
                                    </div></a>
                                    <a href="#"><div class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-success">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p><span class="highlight">Sam</span> added you to board <span class="highlight">Board Name Here</span></p>
                                        </div>
                                    </div></a>
                                    <a href="#"><div class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-warning">
                                                <i class="fa fa-star medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p>The workbook <span class="highlight">_____</span> has been reviewed by <span class="highlight">Luljetta's</span></p>
                                        </div>
                                    </div></a>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                                <br/>
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-commenting-o"></span> Recent Messages |
                                    <a href="#" class=""><small class="text-right">Go to Messages</small></a>
                                    </p>
                                    <hr>
                                    <!-- <p class="note">No messages to show</p> -->
                                    <div class="mess">
                                        <a href="#"><div class="msgdiv">
                                            <div class="msg-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="msg-right">
                                                <p class="text-default msgsender"><span class="txt-bold">Samantha Millos</span> . 
                                                <small><span class="fa fa-clock-o"></span>&nbsp;5:31am 1/06</small></p>
                                                <p class="mainmsg">Sam moved the task Encode the data to Completed</p>
                                            </div>
                                        </div></a>
                                        <a href="#"><div class="msgdiv">
                                            <div class="msg-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="msg-right">
                                                <p class="txt-bold text-default msgsender">Samantha Millos</p>
                                                <p class="mainmsg">Sam moved the task Encode the data to Completed</p>
                                            </div>
                                        </div></a>
                                        <a href="#"><div class="msgdiv">
                                            <div class="msg-left">
                                                <img src="/images/default.png" class="medium-avatar" alt="">
                                            </div>
                                            <div class="msg-right">
                                                <p class="txt-bold text-default msgsender">Samantha Millos</p>
                                                <p class="mainmsg">Sam moved the task Encode the data to Completed</p>
                                            </div>
                                        </div></a>
                                    </div>

                                </div>
                                <br/>
                            </div>
                            <div class="col-md-4">
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-star text-warning"></span> Recently Reviewed Workbook</p>
                                    <hr>
                                    <div class="torev">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <a href="#"><div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>Potato Corner New Images <span class="fa fa-check-circle text-success" title="Reviewed by Client"></span></h6>
                                            <p><small>by: Aya on Sept. 13, 2019</small></p>
                                            <p><small>Potato Corner</small></p>
                                        </div>
                                    </div></a>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                                <br/>
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-star-o"></span> Waiting Client's Review</p>
                                    <hr>
                                    <div class="torev">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <a href="#"><div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>Potato Corner New Images</h6>
                                            <p><small>by: Aya on Sept. 13, 2019</small></p>
                                            <p><small>Potato Corner</small></p>
                                        </div>
                                    </div></a>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                                <br/>
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-align-left"></span> All Created Workbooks</p>
                                    <hr>
                                    <div class="torev">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <a href="#"><div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>Potato Corner New Images <span class="fa fa-check-circle text-success" title="Reviewed by Client"></span></h6>
                                            <p><small>by: Aya on Sept. 13, 2019</small></p>
                                            <p><small>Potato Corner</small></p>
                                        </div>
                                    </div></a>
                                    <a href="#"><div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>Potato Corner New Images</h6>
                                            <p><small>by: Aya on Sept. 13, 2019</small></p>
                                            <p><small>Potato Corner</small></p>
                                        </div>
                                    </div></a>
                                    <a href="#"><div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>Potato Corner New Images <span class="fa fa-check-circle text-success" title="Reviewed by Client"></span></h6>
                                            <p><small>by: Aya on Sept. 13, 2019</small></p>
                                            <p><small>Potato Corner</small></p>
                                        </div>
                                    </div></a>
                                    </div>
                                </div>
                                <br/>
                            </div>
                            <div class="col-md-4">
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-plus-square-o"></span> Create New Job Order 
                                    <!-- <span><a href="#" title="Create New JO" class="btn btn-just-icon btn-round btn-xs"><i class="fa fa-plus"></i></a></span> -->
                                    </p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-md btn-info btn-block">Web</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-md btn-info btn-block">Creatives</button>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-files-o"></span> Active Job Orders (10) 
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
.shadow {
    box-shadow: 0px 1px 15px 1px rgba(69, 65, 78, 0.08);
}
.box {
    background-color: #fff;
    // padding: 25px 20px;
    margin-top: 0.7rem;
    padding: 0;
    display: flex;
    .box-half-1{
        display: inline-block;
        width: 30%;
        padding: 25px 20px;
        text-align: center;
        background-color: #43a0b9;
        i{
            font-size: 40px;
            color: #fffffffc;
            margin: auto;
        }
    }
    .box-half-2{
        display: inline-block;
        width: 70%;
        padding: 15px 20px;
        .boxtitle{
            color: gray;
            text-transform: uppercase;
            font-size: 11px;
        }
        .number{
            color:#43a0b9;
            text-align: right;
            font-size: 30px;
        }
    }
}
.taskchart, .taskdisp{
    background-color:#fff;
    padding: 15px 20px;
}
</style>



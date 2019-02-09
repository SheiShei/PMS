<template>
    <div class="db-wrapper" style="box-sizing: border-box;">
        <div class="content-area" style="max-width: 1280px; margin: 0 auto;">
            <div class="container-fluid">
                <div class="main2">
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Users</p>
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
                                        <p class="boxtitle">Workbooks</p>
                                        <p class="number">75</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-files-o"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Job Orders</p>
                                       <p class="number">10832</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-user-o"></span> New User Account | <small><a href="#">Go to User Manager</a></small></p>
                                    <hr>
                                    <!-- (Success/Error Messages:)
                                        <p class="text-success"><span class="fa fa-check"></span>
                                            A new successfully added!</p>
                                        <p class="text-danger"><span class="fa fa-times"></span>
                                            A problem occured. Please try again.</p> -->
                                    <form action="" class="form row">
                                        <div class="col-md-12">
                                            <div class="form-group is-empty">
                                                <label class="control-label">Name</label>
                                                <input type="text" class="form-control">
                                                <span class="material-input"></span>
                                                <!-- <p><small class="text-danger">Errorhere</small></p> -->
                                            </div>
                                            <div class="form-group is-empty">
                                                <label class="control-label">Email</label>
                                                <input type="email" class="form-control">
                                                <span class="material-input"></span>
                                                <!-- <p><small class="text-danger">Errorhere</small></p> -->
                                            </div>
                                            <div class="form-group is-empty">
                                                <label class="control-label">Password</label>
                                                <input minlength="6" type="password" class="form-control">
                                                <span class="material-input"></span>
                                                <!-- <p><small>Errorhere</small></p> -->
                                            </div>
                                            <div class="btn-group bootstrap-select">
                                                <select name="team" class="selectpicker" data-style="btn btn-primary btn-xs btn-simple" title="--Team--" data-size="7" tabindex="-98">
                                                    <option disabled="" value="" selected>--Choose Team--</option>
                                                    <option value="1">Web</option>
                                                    <option value="2">Creatives</option>
                                                </select>
                                            </div>
                                            <div class="btn-group bootstrap-select">
                                                <select name="role" class="selectpicker" data-style="btn btn-primary btn-xs btn-simple" title="--Role--" data-size="7" tabindex="-98">
                                                    <option disabled="" value="" selected="">--Choose Role--</option>
                                                    <option value="2">ACMA</option>
                                                    <option value="3">Reg. Employee</option>
                                                </select>
                                                <!-- <p><small>Error here</small></p> -->
                                            </div>
                                            <button class="btn btn-primary btn-block btn-md" type="submit">ADD</button>
                                        </div> 
                                    </form>
		                        </div>
                                <br/>
                            </div>
                            <div class="col-md-4">
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
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p><span class="highlight">Workbook</span> has been submitted to <span class="highlight">Luljettas</span> for review.</p>
                                        </div>
                                    </div>
                                    <div class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-warning">
                                                <i class="fa fa-star medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p><span class="highlight">Luljettas</span> sumitted the review for workbook <span class="highlight">Workbook Name</span></p>
                                        </div>
                                    </div>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                                <br/>
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



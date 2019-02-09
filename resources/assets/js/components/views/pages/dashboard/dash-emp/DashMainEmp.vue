<template>
    <div class="db-wrapper" style="box-sizing: border-box;">
            <div class="content-area" style="max-width: 1280px; margin: 0 auto;">
                <div class="container-fluid">
                    <div class="main2">
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-tasks"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Total Active Tasks</p>
                                       <p class="number">10832</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-tasks"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Total Tasks</p>
                                       <p class="number">75</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box shadow" style="position: relative">
                                    <div class="box-half-1">
                                        <i class="fa fa-trello"></i>
                                    </div>
                                    <div class="box-half-2">
                                        <p class="boxtitle">Total Boards</p>
                                       <p class="number">40</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-5">
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
                                <br>
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
                            </div>
                            <div class="col-md-7">
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-clock-o text-success"></span> Task Reminders!</p>
                                    <hr>
                                    <div class="taskrem">
                                        <div class="taskremdiv">
                                            <div class="taskremname">
                                                <a href="">Encode the directors data</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>Feb 27, 2019</small> | 
                                                    <span class="fa fa-trello"></span> <small>Board Name Here</small></p>
                                            </div>
                                        </div>
                                        <div class="taskremdiv">
                                            <div class="taskremname">
                                                <a href="">Change the banner into this</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>Mar 2, 2019</small> | 
                                                    <span class="fa fa-trello"></span> <small>Board Name Here</small></p>
                                            </div>
                                        </div>
                                        <div class="taskremdiv">
                                            <div class="taskremname">
                                                <a href="">Create background image for home page</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>Mar 5, 2019</small> | 
                                                    <span class="fa fa-trello"></span> <small>Board Name Here</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-clock-o text-danger"></span> Overdued Task</p>
                                    <hr>
                                    <div class="taskrem">
                                        <div class="taskremdiv">
                                            <div class="taskremname">
                                                <a href="" class="donetask">Encode the directors data</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>Feb 27, 2019</small> | 
                                                    <span class="fa fa-trello"></span> <small>Board Name Here</small></p>
                                            </div>
                                        </div>
                                        <div class="taskremdiv">
                                            <div class="taskremname">
                                                <a href="" class="donetask">Change the banner into this</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>Mar 2, 2019</small> | 
                                                    <span class="fa fa-trello"></span> <small>Board Name Here</small></p>
                                            </div>
                                        </div>
                                        <div class="taskremdiv">
                                            <div class="taskremname">
                                                <a href="" class="donetask">Create background image for home page</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>Mar 5, 2019</small> | 
                                                    <span class="fa fa-trello"></span> <small>Board Name Here</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-commenting-o"></span> Recent Messages |
                                    <a href="#" class=""><small class="text-right">Go to Messages</small></a>
                                    </p>
                                    <hr>
                                    <p class="note">No messages to show</p>
                                    <div class="mess">
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
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.list-unstyled > li > a{
    color: gray;
}
ul > li a{
    display: inline-block !important;
}
.donetask{
    text-decoration: line-through;
    color: gray;
}
.donetask:hover{
    text-decoration: line-through !important;
}
</style>



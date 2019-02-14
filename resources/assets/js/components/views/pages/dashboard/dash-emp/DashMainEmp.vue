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
                                       <p class="number">{{dashboard_emp.activetasks}}</p>
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
                                       <p class="number">{{dashboard_emp.totaltasks}}</p>
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
                                       <p class="number">{{dashboard_emp.totalboards}}</p>
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
                                        <p v-if="display_notifs.notifications==0" class="note">No notifications to show</p>
                                    
                                    <div v-for="notif in display_notifs.notifications" :key="notif.id" class="notifdiv">
                                        <div class="notif-left">
                                            <div class="notif-icon bg-success">
                                                <i class="fa fa-trello medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <p><span class="highlight">{{notif.data.creator.name}}</span> {{notif.data.data}}</p>
                                        </div>
                                    </div>
                                                                        <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                                <br>
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-commenting-o"></span> Recent Messages |
                                    <router-link :to="{name: 'messages'}"><a><small class="text-right">Go to Messages</small></a></router-link>
                                    </p>
                                    <hr>
                                    <p v-if="display_messages==0" class="note">No messages to show</p>
                                    <div class="mess">
                                        <div v-for="messages in display_messages" :key="messages.id" class="msgdiv">
                                            <div class="msg-left">
                                                <img :src="messages.sender.picture" class="medium-avatar" alt="">
                                            </div>
                                            <router-link :to="{ name: 'convo-view', params: {convo_id: messages.sender.slug} }" class="msg-right">
                                                <p class="txt-bold text-default msgsender">{{messages.sender.name}} {{messages.message_date}} {{messages.message_sent}}</p>
                                                <p class="mainmsg">{{messages.text}}</p>
                                            </router-link>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-clock-o text-success"></span> Task Reminders!</p>
                                    <hr>
                                    <div class="taskrem">
                                        <div v-if="reminder_tasks" v-for="taskrem in reminder_tasks" :key="taskrem.id" class="taskremdiv">
                                            <div class="taskremname">
                                                <a>{{taskrem.name}}</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>{{taskrem.due}}</small> | 
                                                    <!-- <span v-if="taskrem.card_id" class="fa fa-trello"></span> <small>{{ taskrem.card }}</small> -->
                                                    <!-- <span v-if="taskrem.sprint_id" class="fa fa-trello"></span> <small>{{ taskrem.sprint }}</small> -->
                                                </p>
                                            </div>
                                        </div>
                                        <p class="note" v-if="reminder_tasks==0"> There still no tasks assigned </p>
                                        
                                    </div>
                                </div>
                                <br/>
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-clock-o text-danger"></span> Overdued Task</p>
                                    <hr>
                                    <div class="taskrem">
                                        <div v-if="overdued_tasks" v-for="taskdue in overdued_tasks" :key="taskdue.id" class="taskremdiv">
                                            <div class="taskremname">
                                                <a class="donetask">{{taskdue.name}}</a>
                                            </div>
                                            <div class="taskremdue">
                                                <p>
                                                    <span class="fa fa-calendar text-danger"></span>&nbsp;<small>{{taskdue.due}}</small> | 
                                                    <span class="fa fa-trello"></span> <small>Board Name Here</small></p>
                                            </div>
                                        </div>
                                        <p v-if="overdued_tasks==0" class="note"> There still no overdued tasks</p>
                                          
                                       
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
import {mapGetters} from 'vuex';
export default {
 created() {
        // this.$store.dispatch('getuser_info')
        this.$store.dispatch('dashboard_emp')
        this.$store.dispatch('reminder_tasks')
        this.$store.dispatch('overdued_tasks')
        this.$store.dispatch('display_messages')
        this.$store.dispatch('display_notifs')
        

	},
    computed: {
        ...mapGetters({
            dashboard_emp: 'dashboard_emp',
            reminder_tasks: 'reminder_tasks',
            overdued_tasks: 'overdued_tasks',
            display_messages: 'display_messages',
            display_notifs: 'display_notifs',

        })
        
    }

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



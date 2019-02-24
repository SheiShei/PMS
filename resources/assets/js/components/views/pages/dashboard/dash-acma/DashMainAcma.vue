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
                                       <p class="number">{{dashboard_acma.jo_created}}</p>
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
                                       <p class="number">{{dashboard_acma.workbookss}}</p>
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
                                       <p class="number">{{dashboard_acma.handled_brands}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="taskchart shadow">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="no-margin txt-bold"><span class="fa fa-line-chart"></span> Job Order Progress Overview</p>
                                             <router-link :to="{name: 'all_jo_list'}"><a><small>Go to All Job Orders</small></a></router-link>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <select v-model="data.jo_status" @change="filterjo()" class="my-thin-select">
                                                <option value="">All</option>
                                                <option value="1">Active</option>
                                                <option value="2">Completed</option>
                                                <option value="3">Undone</option>
                                                <option value="4">Overdue</option>
                                            </select>
                                            <input @input="filterjo()" v-model="data.search" type="search" class="my-thin-input" placeholder="Search...">
                                            &nbsp;&nbsp;<span class="fa fa-search text-gray"></span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div v-if="display_joborders!=0" class="v2-table table-reponsive">
                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>Job Order</th>
                                                        <th>Due Date</th>
                                                        <th>Status</th>
                                                        <th>Progress</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody name="list-complete" is="transition-group">
                                                    <tr v-for="jo in display_joborders" :key="jo.id" class="list-complete-item">
                                                           <td><span class="fa fa-copy"></span>&nbsp;{{jo.name}}</td>
                                                        <td><span class="fa fa-clock-o"></span>&nbsp;{{jo.date_due | moment("MMM D, YYYY")}}</td>
                                                        <td v-if="jo.status==1"><span class="label label-info">Active</span></td>
                                                        <td v-if="jo.status==2"><span class="label label-success">Completed</span></td>
                                                        <td v-if="jo.status==3" ><span class="label label-warning">Undone</span></td>
                                                        <td v-if="jo.status==4"><span class="label label-danger">Overdue</span></td>

                                                        <td>
                                                            <p class="text-gray no-margin"><small>{{ completedTasks(jo) }}/{{ jo.tasks.length }}<span class="pull-right txt-bold">{{ joPercent(jo) }}%</span></small></p>
                                                            <div class="no-margin progress progress-line-info"><div class="progress-bar progress-bar-info" :style="'width: '+joPercent(jo)+'%;'">
                                                            </div></div>
                                                        </td>
                                                        <td>
                                                            <a style="cursor: pointer"><small  @click="view(jo.id, jo.type)">VIEW</small></a>
                                                        </td>
                                                    </tr>
    
                                                    </tbody>
                                                </table>

                                                <!--dont show if selected is active/warning; all active&warning should be all shown-->
                                                <!--Due Tomorrow/warning is still an active status though -->
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <button class="btn btn-info btn-simple btn-sm">Load More</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                                <p v-if="display_joborders==0" class="note"> No Joborder yet </p>
                                             
                                        </div>

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
                                        <p v-if="display_notifs==0" class="note">No notifications to show</p>
                                    <!-- <a href="#"> -->
                                    <div v-for="notif in display_notifs" :key="notif.id" class="notifdiv">
                                        <div class="notif-left">
                                            <div :class="notif.data.color">
                                                <i :class="notif.data.icon" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <router-link :to="{path: notif.data.action}"><span class="highlight"> {{notif.data.text}}</span> </router-link>
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                                                        <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                                <br/>
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
                                                <p class="msgsender"><span class="txt-bold text-default">{{messages.sender.name}}</span>
                                                <small class="text-gray">&nbsp;{{messages.message_date| moment("MMM D, YYYY")}}, {{messages.message_sent}}</small></p>
                                                <p class="mainmsg">{{messages.text}}</p>
                                            </router-link>
                                        </div>
                                    </div>

                                </div>
                                <br/>
                            </div>
                            <div class="col-md-4">
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-star text-warning"></span> Recently Reviewed Workbook</p>
                                    <hr>
                                    <div v-for="(rwb, index) in display_rworkbooks" :key="rwb.id" class="torev">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <router-link v-if="index<=3" :to="{name: 'view_workbook', params:{wb_id: rwb.id}}"><a><div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>{{rwb.name}} <span class="fa fa-check-circle text-success" title="Reviewed by Client"></span></h6>
                                            <p><small>by: {{rwb.brand.acma.name}} on {{rwb.created_at |  moment("MMM D, YYYY")}}</small></p>
                                            <p><small>{{rwb.brand.name}}</small></p>
                                        </div>
                                    </div></a></router-link>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                    <p v-if="display_rworkbooks==0" class="note">No workbooks to show</p>
                                </div>
                                <br/>
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-star-o"></span> Waiting for Client's Review</p>
                                    <hr>
                                    <div v-for="(urwb, index) in display_urworkbooks" :key="urwb.id"  class="torev">
                                        <!-- <p class="note">No notifications to show</p> -->
                                    <router-link v-if="index<=3" :to="{name: 'view_workbook', params:{wb_id: urwb.id}}"><a><div class="torevdiv">
                                        <div class="torev-left">
                                            <div class="torev-icon">
                                                <i class="fa fa-book medium-avatar" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="torev-right">
                                            <h6>{{urwb.name}}</h6>
                                            <p><small>by: {{urwb.brand.acma.name}} on {{urwb.created_at |  moment("MMM D, YYYY")}}</small></p>
                                            <p><small>{{urwb.brand.name}}</small></p>
                                        </div>
                                    </div></a></router-link>
                                    <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                    <p v-if="display_urworkbooks==0" class="note">No workbooks to show</p>
                                </div>
                                <br/>
                               
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
                                             <router-link :to="{name: 'new_jo_web'}" class="btn btn-md btn-info btn-block">Web</router-link>
                                        </div>
                                        <div class="col-md-6">
                                          
                                            <router-link :to="{name: 'new_jo_creative'}" class="btn btn-md btn-info btn-block">Creatives</router-link>

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
import {mapGetters} from 'vuex';
export default {
    // components:{
    //     apexchart: VueApexCharts
    // },
    data() {
        return {
        data:{
            sort: 'created_at.desc',
            search: '',
            notArchive: true,
            jo_status: ''
        },
       
        }
    },
    created() {
        // this.$store.dispatch('getuser_info')
        this.$store.dispatch('dashboard_acma')
        this.$store.dispatch('display_joborders',this.data)
        this.$store.dispatch('display_messages')
        this.$store.dispatch('display_notifs')
        this.$store.dispatch('display_urworkbooks')
        this.$store.dispatch('display_rworkbooks')

        

	},
    computed: {
        ...mapGetters({
               // no_wb: 'no_wb',
                dashboard_acma: 'dashboard_acma',
                display_joborders: 'display_joborders',
                display_messages: 'display_messages',
                display_notifs: 'display_notifs',
                display_urworkbooks: 'display_urworkbooks',
                display_rworkbooks: 'display_rworkbooks',
                            }),
    },
    methods:{
     view(id, type) {
            if(type == 1) {
                this.$router.push({name: 'viewjocreative', params: {jo_id: id}});
            }
            else{
                this.$router.push({name: 'viewjoweb', params: {jo_id: id}});
            }
        },
    filterjo(){
        this.$store.dispatch('display_joborders',this.data)
    },
     joPercent(jo) {
            var done = 0;
            var total = 0;
            jo.tasks.forEach(task => {
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

            return Math.round((done/total) * 100);
        },
        completedTasks(jo) {
            var ctasks = 0
            jo.tasks.forEach(task => {
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

.completedjo{
    // background-color: #4caf50;
    border-left: 3px solid #4caf50;
}

</style>



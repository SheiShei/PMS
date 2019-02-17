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
                                            <a><small>Go to All Job Orders</small></a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <select class="my-thin-select">
                                                <option value="">Active</option>
                                                <option value="">Due Tomorrow</option>
                                                <option value="">Overdued</option>
                                                <option value="">Completed</option>
                                                <option value="">All</option>
                                            </select>
                                            <input type="search" class="my-thin-input" placeholder="Search...">
                                            &nbsp;&nbsp;<span class="fa fa-search text-gray"></span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="v2-table table-reponsive">
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
                                                    <tr class="list-complete-item">
                                                        <td><span class="fa fa-copy"></span>&nbsp;Mfi JO</td>
                                                        <td><span class="fa fa-clock-o"></span>&nbsp;Feb 16, 2019</td>
                                                        <td><span class="label label-info">Active</span></td>
                                                        <!-- <td><span class="label label-success">Completed</span></td> -->
                                                        <!-- <td><span class="label label-warning">Due Tomorrow</span></td> -->
                                                        <!-- <td><span class="label label-danger">Overdued</span></td> -->

                                                        <td>
                                                            <p class="text-gray no-margin"><small>Completed: 1/30<span class="pull-right txt-bold">80%</span></small></p>
                                                            <div class="no-margin progress progress-line-info"><div class="progress-bar progress-bar-info" style="width: 35%;">
                                                            </div></div>
                                                        </td>
                                                        <td>
                                                            <a style="cursor: pointer"><small>VIEW</small></a>
                                                        </td>
                                        
                                                    </tr>
                                                    <tr class="list-complete-item">
                                                        <td><span class="fa fa-copy"></span>&nbsp;Mowelfund JO</td>
                                                        <td><span class="fa fa-clock-o"></span>&nbsp;Feb 16, 2019</td>
                                                        <td><span class="label label-success">Completed</span></td>
                                                        <td>
                                                            <p class="text-gray no-margin"><small>Completed: 1/30<span class="pull-right txt-bold">80%</span></small></p>
                                                            <div class="no-margin progress progress-line-info"><div class="progress-bar progress-bar-info" style="width: 35%;">
                                                            </div></div>
                                                        </td>
                                                        <td>
                                                            <a style="cursor: pointer"><small>VIEW</small></a>
                                                        </td>
                                                    </tr>
                                                    <tr class="list-complete-item">
                                                        <td><span class="fa fa-copy"></span>&nbsp;Luljettas JO</td>
                                                        <td><span class="fa fa-clock-o"></span>&nbsp;Feb 16, 2019</td>
                                                        <td><span class="label label-warning">Due Tomorrow</span></td>
                                                        <td>
                                                            <p class="text-gray no-margin"><small>Completed: 1/30<span class="pull-right txt-bold">80%</span></small></p>
                                                            <div class="no-margin progress progress-line-info"><div class="progress-bar progress-bar-info" style="width: 35%;">
                                                            </div></div>
                                                        </td>
                                                        <td>
                                                            <a style="cursor: pointer"><small>VIEW</small></a>
                                                        </td>
                                                    </tr>
                                                    <tr class="list-complete-item">
                                                        <td><span class="fa fa-copy"></span>&nbsp;osaihfosdfdsa</td>
                                                        <td><span class="fa fa-clock-o"></span>&nbsp;Feb 16, 2019</td>
                                                        <td><span class="label label-danger">Overdued</span></td>
                                                        <td>
                                                            <p class="text-gray no-margin"><small>Completed: 1/30<span class="pull-right txt-bold">80%</span></small></p>
                                                            <div class="no-margin progress progress-line-info"><div class="progress-bar progress-bar-info" style="width: 35%;">
                                                            </div></div>
                                                        </td>
                                                        <td>
                                                            <a style="cursor: pointer"><small>VIEW</small></a>
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
                                        <p v-if="display_notifs.notifications==0" class="note">No notifications to show</p>
                                    <!-- <a href="#"> -->
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
                                                <p class="txt-bold text-default msgsender">{{messages.sender.name}} {{messages.message_date}} {{messages.message_sent}}</p>
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
                                <!-- <div class="taskchart shadow">
                                    <p><span class="fa fa-align-left"></span> All Created Workbooks</p>
                                    <hr>
                                    <div class="torev">
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
                                </div> -->
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
                                <!-- <div class="taskdisp shadow">
                                    <p><span class="fa fa-files-o"></span> Active Job Orders ( {{dashboard_acma.active_jo}} )
                                    </p>
                                    <hr>
                                    <p v-if="dashboard_acma.active_jo==0" class="note">No created JO to show</p>
                                    <div class="mess">
                                    <ul v-for="jo in display_joborders" :key="jo.id" class="list-unstyled">
                                        <li><span class="fa fa-circle text-info"></span>
                                            <a @click="view(jo.id, jo.type)">{{jo.name}}</a></li>                            
                                    </ul>
                                    </div>
                                </div> -->
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

    created() {
        // this.$store.dispatch('getuser_info')
        this.$store.dispatch('dashboard_acma')
        this.$store.dispatch('display_joborders')
        this.$store.dispatch('display_messages')
        this.$store.dispatch('display_notifs')

        

	},
    computed: {
        ...mapGetters({
               // no_wb: 'no_wb',
                dashboard_acma: 'dashboard_acma',
                display_joborders: 'display_joborders',
                display_messages: 'display_messages',
                display_notifs: 'display_notifs',
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
.v2-table{
    width: 100%;
    // max-width:100%;
    max-height: 400px;
    // overflow-y: auto; 
    table, td, th {  
        border: 1px solid #f1f1f1;
        text-align: left;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 10px 15px;
    }
    th{
        font-size: 0.8em;
        font-weight: bold;
        text-transform: uppercase;
    }
    tr > th{
        background-color: #f5f5f5;
    }
}
</style>



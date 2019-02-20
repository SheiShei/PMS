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
                                       <p class="number">{{dashboard_client.unreviewed}}</p>
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
                                       <p class="number">{{dashboard_client.reviewed}}</p>
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
                                       <p class="number">{{dashboard_client.total}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-star text-warning"></span> To Review Workbooks</p>
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
                                </div>
                                <br/>
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-bell-o"></span> Notifications</p>
                                    <hr>
                                   <div class="notifsss">
                                        <p v-if="display_notifs==0" class="note">No notifications to show</p>
                                    <div v-for="notif in display_notifs" :key="notif.id" class="notifdiv">
                                        <div class="notif-left">
                                            <div :class="notif.data.color">
                                                <i :class="notif.data.icon" alt=""></i>
                                            </div>
                                        </div>
                                        <div class="notif-right">
                                            <router-link :to="{path: notif.data.action}"><span class="highlight"> </span> {{notif.data.text}}</router-link>
                                        </div>
                                    </div>
                                                           <!--Please see DashboardNotifs.vue for other kinds of notifs-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
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

                                <div class="taskchart shadow">
                                    <p><span class="fa fa-check-circle-o"></span> Reviewed Workbooks</p>
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
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="taskdisp shadow">
                                    <p><span class="fa fa-files-o"></span> Job Orders ( {{dashboard_client.jocount}} ) 
                                    <!-- <span><a href="#" title="Create New JO" class="btn btn-just-icon btn-round btn-xs"><i class="fa fa-plus"></i></a></span> -->
                                    </p>
                                    <hr>
                                    <p v-if="dashboard_client.jocount==0" class="note">No created JO to show</p>
                                    <div class="mess">
                                    <ul v-for="jo in display_joborders" :key="jo.id" class="list-unstyled">
                                        <li><span class="fa fa-circle text-info"></span>
                                            <a @click="view(jo.id, jo.type)">{{jo.name}}</a></li>                            
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
import {mapGetters} from 'vuex';

export default {
    // components:{
    //     apexchart: VueApexCharts
    // }
    data() {
        return {
        data: {
            jo_status: '',
            search: ''
        }
       
        }
    },
     created() {
        // this.$store.dispatch('getuser_info')
        this.$store.dispatch('display_joborders',this.data)
        // this.$store.dispatch('display_joborders')
        this.$store.dispatch('dashboard_client')
        this.$store.dispatch('display_messages')
        this.$store.dispatch('display_notifs')
        this.$store.dispatch('display_urworkbooks')
        this.$store.dispatch('display_rworkbooks')
        

	},
    computed: {
        ...mapGetters({
               // no_wb: 'no_wb',
                 display_joborders: 'display_joborders',
                 dashboard_client: 'dashboard_client',
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
</style>



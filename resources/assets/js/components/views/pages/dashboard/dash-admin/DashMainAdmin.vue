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
                                       <p class="number">{{dashboard_admin.users}}</p>
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
                                       <p class="number">{{dashboard_admin.jos}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="taskchart shadow">
                                    <p><span class="fa fa-user-o"></span> New User Account |  <small><router-link :to="{name: 'users'}"><a>Go to User Manager</a></router-link></small></p>
                                    <hr>
                                    <!-- (Success/Error Messages:) -->
                                        <p v-if="success==true" class="text-success"><span class="fa fa-check"></span>
                                            A new User was successfully added!</p>
                                        <!-- <p class="text-danger"><span class="fa fa-times"></span>
                                            A problem occured. Please try again.</p> -->
                                    <form action="" class="form row" @submit.prevent="addNewUser()">
                                        <div class="col-md-12">
                                            <div class="form-group is-empty">
                                                <label class="control-label">Name</label>
                                                <input v-model="form.name" required type="text" class="form-control">
                                                <span class="material-input"></span>
                                                <p v-if="errors.name"><small v-for="(error, i) in errors.name" :key="i">{{ error }}</small></p>
                                            </div>
                                            <div class="form-group is-empty">
                                                <label class="control-label">Email</label>
                                                <input v-model="form.email" required type="email" class="form-control">
                                                <span class="material-input"></span>
                                                <p v-if="errors.email"><small v-for="(error, i) in errors.email" :key="i">{{ error }}</small></p>
                                            </div>
                                            <div class="form-group is-empty">
                                                <label class="control-label">Password</label>
                                                <input v-model="form.password" :required="!!add" minlength="6" type="password" class="form-control">
                                                <span class="material-input"></span>
                                                <p v-if="errors.password"><small v-for="(error, i) in errors.password" :key="i">{{ error }}</small></p>
                                            </div>
                                            <div class="btn-group bootstrap-select">
                                                <select name="team" v-model="form.team" required class="selectpicker" data-style="btn btn-info btn-xs btn-simple" title="--Team--" data-size="7" tabindex="-98">
                                                    <option disabled="" value="" selected>--Team--</option>
                                                    <option value="1">Web</option>
                                                    <option value="2">Creatives</option>
                                                </select>
                                            </div>
                                            <div class="btn-group bootstrap-select">
                                                 <select name="role" v-model="form.role" required class="selectpicker" data-style="btn btn-info btn-xs btn-simple" title="--Role--" data-size="7" tabindex="-98">
                                                     <option disabled="" value="" selected="">--Role--</option>
                                                     <option value="2">ACMA</option>
                                                     <option value="3">Reg. Employee</option>
                                                 </select>
                                                <p v-if="errors.role_id"><small v-for="(error, i) in errors.role_id" :key="i">{{ error }}</small></p>
                                            </div>
                                            <p class="note">NOTE: Only employee account can be added here.</p>
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
                                <br/>
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
            form: {
                name: '',
                email: '',
                password: '',
                team: '',
                role: ''
            },
            isRole: true,
            isTeam: true,
            errors: [],
            add: true,
            success: false,

        }
    },
    created() {
        this.$store.dispatch('getuser_info')
        this.$store.dispatch('dashboard_admin')
        .then(() => {
                // console.log(this.tandemList)
                $(this.$el).find('.selectpicker').selectpicker('refresh');
            })
        this.$store.dispatch('display_messages')
        this.$store.dispatch('display_notifs')

	},
    computed: {
        ...mapGetters({
                dashboard_admin: 'dashboard_admin',
               // no_wb: 'no_wb',
                display_messages: 'display_messages',
                display_notifs: 'display_notifs',
              
                            }),
    },

methods:{
     addNewUser() {
            this.$store.dispatch('addUser', this.form)
                .then((response) => {
                    // console.log(response)
                    this.errors = [];
                    this.form.name = '';
                    this.form.email = '';
                    this.form.password = '';
                    this.form.team = '';
                    this.form.role = ''
                    //this.$toaster.success('New User added!.')
                    this.success=true;
                })

                .catch((error) => {
                    // console.log(error)
                    this.errors = error;
                })
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



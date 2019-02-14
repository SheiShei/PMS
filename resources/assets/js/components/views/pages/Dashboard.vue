<template>
    <section class="main-main-container" style="">

        <div class="title-head">
            <h2><span class="fa fa-dashboard"></span> Dashboard&nbsp;&nbsp;&nbsp;
                <span class="label label-info">
                    <span>
                        <!-- <span class="fa fa-clock-o"></span> 10:30 am -->
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <span class="fa fa-calendar"></span>
                        {{date}}
                    </span>
                </span>
            </h2>
        </div>
        <dash-acma v-if="user_info.role_id==2"></dash-acma>
        <dash-emp v-if="user_info.role_id==3" ></dash-emp>
        <dash-client v-if="user_info.role_id==4"></dash-client>
        <dash-admin v-if="user_info.role_id==1"></dash-admin>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
import DashMainAcma from './dashboard/dash-acma/DashMainAcma.vue';
import DashMainAdmin from './dashboard/dash-admin/DashMainAdmin.vue';
import DashMainEmp from './dashboard/dash-emp/DashMainEmp.vue';
import DashMainClient from './dashboard/dash-client/DashMainClient.vue';

export default {
    components:{
        dashAcma : DashMainAcma,
        dashEmp : DashMainEmp,
        dashAdmin : DashMainAdmin,
        dashClient : DashMainClient
    },

created() {
        this.$store.dispatch('getuser_info')
        this.$store.dispatch('date')
      
        

	},
computed: {
         ...mapGetters({
                user_info: 'getuser_info',
                date: 'date'
			}),
	},

}
</script>


<style lang="scss" scoped>

</style>

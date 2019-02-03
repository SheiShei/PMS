<template>
    <section class="main-main-container" style="">

        <div class="title-head">
            <h2><span class="fa fa-dashboard"></span> Dashboard&nbsp;&nbsp;&nbsp;
                <span class="label label-info">
                    <span>
                        <span class="fa fa-clock-o"></span> 10:30 am
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <span class="fa fa-calendar"></span>
                        Thursday, January 3, 2019
                    </span>
                </span>
            </h2>
        </div>
        <!-- <dash-acma></dash-acma> -->
        <dash-emp></dash-emp>
        <!-- <dash-client></dash-client> -->
        <!-- <dash-admin></dash-admin> -->
    </section>
</template>

<script>
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
    }
}
</script>


<style lang="scss" scoped>

</style>

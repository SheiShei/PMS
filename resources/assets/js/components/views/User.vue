<template>
    <div>
        <user-sidebar></user-sidebar>
        <!-- <user-topnav></user-topnav> -->
        <div>
        <!-- <notif-div></notif-div> -->
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
// import Topnav from './includes/Topnav.vue';
import Sidebar from './includes/Sidebar.vue';
import Notifdiv from './includes/Notif.vue'
export default {
    components: {
        // userTopnav : Topnav,
        userSidebar : Sidebar,
        notifDiv : Notifdiv
    },

    updated () {
        $(this.$el).find('.selectpicker').selectpicker('refresh');
    },
}
</script>

<style>
    .form-group label.control-label {
        margin: 2px 0 0 0;
    }
    .form-group {
        padding-bottom: 3px;
        margin: 1px 0 0 0;
    }
    .form-group .form-control {
        margin-bottom: 5px;
    }
    .form-control {
        height: 27px;
    }
    .main-main-container {
        height: 100vh;
        overflow-y: auto;
    }
    ul > li a {
        display: block !important;
    }
</style>

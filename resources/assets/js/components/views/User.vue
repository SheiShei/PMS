<template>
    <div>
        <user-sidebar></user-sidebar>
        <user-topnav></user-topnav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Topnav from './includes/Topnav.vue';
import Sidebar from './includes/Sidebar.vue';

export default {
    components: {
        userTopnav : Topnav,
        userSidebar : Sidebar
    }
}
</script>

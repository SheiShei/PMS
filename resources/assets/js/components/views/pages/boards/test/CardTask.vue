<template>
    <!-- simple card -->
    <div class="t-card" @mouseout="openTaskOpt=false">
        <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
            <div class="if-fr-jo">
                <span class="text-success">{{ sname }} US # {{ i+1 }}</span> <!-- <span>jo name here</span> -->
            </div>
            <div class="t-name">
                <b>{{ us.name }}</b>
            </div>
            <!-- <div class="t-desc">
                <img :src="'/storage/task/'+task.task_cover" width="100%" alt="">
            </div> -->
        </div>
        <transition name="fade">
            <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                <!-- <div class="assign-members">
                    <div class="task-member">
                        <img class="task-member-avatar" height="30" width="30" src="/images/default.png" title="User Name">
                    </div>
                </div> -->
                <div class="t-points">
                    <p>{{ us.points }} pts</p>
                </div>
                <div class="t-btns pull-right">
                    <router-link v-if="usPermission.view" :to="{ name: 'us_view', params: {us_id: us.id, sprint_id: us.sprint_id} }" class="mysm-btn"><span class="fa fa-eye"></span></router-link>
                    <!-- <button class="mysm-btn"><span class="fa fa-edit"></span></button> -->
                    <router-link v-if="usPermission.delete" :to="{ name: 'd_conf', params: {us_id: us.id} }" class="mysm-btn"><span class="fa fa-trash-o"></span></router-link>
                   
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: ['us', 'i', 'sname', 'usPermission', 'taskPermission', 'sprintPermission'],
    data() {
        return {
            openTaskOpt: false,
        }
    },
    methods: {
    }
}
</script>

<style lang="scss" scoped>
    
</style>
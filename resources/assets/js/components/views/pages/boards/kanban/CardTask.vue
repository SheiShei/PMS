<template>
    <!-- simple card -->
    <div class="t-card" @mouseout="openTaskOpt=false" @drag="checkMove" v-if="!task.task_cover" :class="task.jo_id ? (task.joborder.status == 4 ? '' : 'not-finished') : 'not-finished'">
        <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
            <div class="if-fr-jo">
                <span class="text-success">Task #{{ i+1 }}</span> <span v-if="task.jo_id">{{ task.joborder.name }}</span>
            </div>
            <div class="t-name">
                <b>{{ task.name }}</b>
            </div>
        </div>
        <transition name="fade">
            <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                <div class="t-points">
                    <p class=""><small><span class="fa fa-clock-o text-danger"></span> {{ task.due }}</small></p>
                    <!-- <p>{{ task.points }} pts</p> -->
                </div>
                <div class="t-btns pull-right">
                    <router-link v-if="taskPerm.view" :to="{ name: 'kanboard_viewtask', params: {task_id: task.id} }" class="mysm-btn"><span class="fa fa-eye"></span></router-link>
                    <!-- <button class="mysm-btn"><span class="fa fa-edit"></span></button> -->
                    <router-link v-if="taskPerm.delete" :to="{ name: 'delete', params: {taskid: task.id} }" class="mysm-btn"><span class="fa fa-trash-o"></span></router-link>
                    <!-- <button v-if="taskPerm.delete" @click="deleteTask(task.id)" class="mysm-btn"><span class="fa fa-trash-o"></span></button> -->
                    <img class="task-member-avatar" :src="task.assigned_to.picture" :title="task.assigned_to.name">
                </div>
            </div>
        </transition>
    </div>

    <!-- card with image -->
    <div class="t-card" @mouseout="openTaskOpt=false" v-else :class="task.jo_id ? (task.joborder.status == 4 ? '' : 'not-finished') : 'not-finished'">
        <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
            <div class="if-fr-jo">
                <span class="text-success">Task #{{ i+1 }}</span> <span v-if="task.jo_id">{{ task.joborder.name }}</span>
            </div>
            <div class="t-name">
                <b>{{ task.name }}</b>
            </div>
            <div class="t-desc">
                <img :src="'/storage/task/'+task.task_cover" width="100%" alt="">
            </div>
        </div>
        <transition name="fade">
            <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                <div class="t-points">
                    <!-- <p>{{ task.points }} pts</p> -->
                    <p class=""><small><span class="fa fa-clock-o text-danger"></span> {{ task.due }}</small></p>
                </div>
                <div class="t-btns pull-right">
                    <router-link v-if="taskPerm.view" :to="{ name: 'kanboard_viewtask', params: {task_id: task.id}, props: {per: taskPerm} }" class="mysm-btn"><span class="fa fa-eye"></span></router-link>
                    <!-- <button class="mysm-btn"><span class="fa fa-edit"></span></button> -->
                    <router-link v-if="taskPerm.delete" :to="{ name: 'delete', params: {taskid: task.id} }" class="mysm-btn"><span class="fa fa-trash-o"></span></router-link>
                    <img class="task-member-avatar" :src="task.assigned_to.picture" :title="task.assigned_to.name">
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: ['i', 'task', 'taskPerm'],
    data() {
        return {
            openTaskOpt: false,
        }
    },
    methods: {
        checkMove(event) {
            // console.log(event);
            var elmnt = document.querySelector('#testTaskDiv');
            let pos = event.pageX - $('#testTaskDiv').offset().left
            // console.log(`mouse position: ${pos}`);
            if(pos>1000) {
                elmnt.scrollBy(10, 0);
            }
            if(pos<200) {
                elmnt.scrollBy(-10, 0);
            }
        },
        // deleteTask(id) {
        //     this.$store.dispatch('deleteTask', {id:id, board_id: this.$route.params.board_id})
        //         .then(() => {
        //             this.$toaster.warning('Task deleted succesfully!.')
        //         })
        // },
        
    }
}
</script>

<style lang="scss" scoped>
</style>

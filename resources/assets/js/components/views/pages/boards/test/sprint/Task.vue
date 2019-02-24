<template>
    <div class="t-card" @mouseout="openTaskOpt=false" :class="task.jo_id ? (task.joborder.status == 4 ? '' : 'not-finished') : 'not-finished'">
        <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
            <div class="if-fr-jo">
                <span class="text-success"></span> <span v-if="task.jo_id"> {{ task.joborder.name }}</span>
            </div>
            <div class="t-name">
                <b>{{ task.name }}</b>
            </div>
            <div class="t-desc" v-if="task.task_cover">
                <img :src="'/storage/task/'+task.task_cover" width="100%" alt="">
            </div>
        </div>
        <transition name="fade">
            <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                <div class="assign-members">
                    <div class="task-member">
                        <img class="task-member-avatar" height="30" width="30" :src="task.assigned_to.picture" :title="task.assigned_to.name">
                    </div>
                </div>
                <div class="t-points">
                    <p class=""><small><span class="fa fa-clock-o text-danger"></span> {{ task.due }}</small></p>
                </div>
                <div class="t-btns pull-right">
                    <button v-if="taskPermission.view" @click="$router.push({name: 'viewtask_sprint', params: {task_id: task.id, us_id: task.us_id}})" class="mysm-btn"><span class="fa fa-eye"></span></button>
                    <!-- <button class="mysm-btn"><span class="fa fa-edit"></span></button> -->
                    <!-- <button v-if="taskPermission.delete" @click="dTask(task.id)" class="mysm-btn"><span class="fa fa-trash-o"></span></button> -->
                    <router-link v-if="taskPermission.delete" :to="{ name: 'deletesprint', params: {cardid: task.id} }" class="mysm-btn" ><span class="fa fa-trash-o"></span></router-link>
                   
                </div>
            </div>
        </transition>
    </div>
</template>
<script>
export default {
    props: ['task', 'usPermission', 'taskPermission', 'index'],
    data() {
        return {
            openTaskOpt: false,
        }
    },
    methods: {
        dTask(id) {
            this.$store.dispatch('deleteSprintTask', {id:id, board_id: this.$route.params.board_id})
                .then((response) => {
                    this.$store.commit('deleteSprintTask', response)
                    this.$toaster.warning('Task deleted succesfully!.')
                })
        },
    }
}
</script>
<style lang="scss" scoped>

    //individual card styles
    .t-card-wrap{
        width: 100%;
        height:auto;
        display: block;
        padding: 9px 12px;
        white-space: normal;

        .if-fr-jo{
            padding-top:1px;
            padding-bottom: 1px;
            line-height: normal;
            font-size: 9px;
            color: #bbbbbb;
        }
        .t-name{
            padding-top:1px;
            padding-bottom: 3px;
            font-size: 13px;
            line-height: normal;
            color: #2b2b2b;
            cursor: move;
            img{
                margin-top: 6px;
            }
        }
        .t-desc{
            padding-top:5px;
            padding-bottom: 10px;
            padding-left: 6px;
            padding-right: 6px;
            line-height: normal;
            font-size: 12px;
            color: rgb(127,127,127);
        }
    }

    .mysm-btn{
        background: transparent;
        color: rgb(105, 105, 105);
        padding: 5px 9px;
        border: none;
        box-shadow: none;
        margin: 0;
        border-radius: 50%;
    }

    .mysm-btn:hover{
        background-color: rgb(199, 199, 199);
        color: rgb(92, 92, 92);
        transition: 0.5s;
    }

    .t-card{
        display:block;
        margin-bottom: 6px;
        background-color: #fff;
        border: 1px solid #d6d5d5;
    }

    .t-options{
        width: 100%;
        height:auto;
        padding: 0;
        padding: 5px 12px;
        white-space: normal; 
        position: relative;

        .t-points{
            display: inline-flex;
            width: 50%;
        }

        .t-btns{
            display: inline-block;
            // float: right;
            text-align: right;
        }
    }

    .assign-members .task-member {
        height: 28px;
        width: 28px;
        float: right;
        margin: 0 0 10px 10px;
    }

    .task-member {
        cursor: pointer;
        display: block;
        height: 32px;
        margin: 0 4px 4px 0;
        overflow: visible;
        position: relative;
        width: 32px;
        text-decoration: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        z-index: 0;
    }
    .assign-members .task-member .task-member-avatar {
        height: 28px;
        width: 28px;
    }
    .task-member-avatar {
        height: 32px;
        width: 32px;
        border-radius: 25em;
    }


    //end of individual card
</style>


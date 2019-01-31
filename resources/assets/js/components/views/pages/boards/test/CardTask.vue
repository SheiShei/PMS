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
                    <router-link :to="{ name: 'us_view', params: {us_id: us.id, sprint_id: us.sprint_id} }" class="mysm-btn"><span class="fa fa-eye"></span></router-link>
                    <!-- <button class="mysm-btn"><span class="fa fa-edit"></span></button> -->
                    <router-link :to="{ name: 'd_conf', params: {us_id: us.id} }" class="mysm-btn"><span class="fa fa-trash-o"></span></router-link>
                   
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: ['us', 'i', 'sname'],
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
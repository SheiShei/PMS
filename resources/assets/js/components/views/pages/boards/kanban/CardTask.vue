<template>
    <!-- simple card -->
    <div class="t-card" @mouseout="openTaskOpt=false" @drag="checkMove" v-if="!task.image">
        <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
            <div class="if-fr-jo">
                <span class="text-success">Task #{{ i }}</span> {{ task.jo_name }}
            </div>
            <div class="t-name">
                <b>{{ task.name }}</b>
            </div>
        </div>
        <transition name="fade">
            <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                <div class="t-points">
                    <p>0 pts</p>
                </div>
                <div class="t-btns pull-right">
                    <router-link :to="{ name: 'kanboard_viewtask', params: {task_id: 'asdasd123'} }" class="mysm-btn"><span class="fa fa-eye"></span></router-link>
                    <!-- <button class="mysm-btn"><span class="fa fa-edit"></span></button> -->
                    <button class="mysm-btn"><span class="fa fa-trash-o"></span></button>
                </div>
            </div>
        </transition>
    </div>

    <!-- card with image -->
    <div class="t-card" @mouseout="openTaskOpt=false" v-else>
        <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
            <div class="if-fr-jo">
                <span class="text-success">Task #{{ i }}</span> {{ task.jo_name }}
            </div>
            <div class="t-name">
                <b>{{ task.name }}</b>
            </div>
            <div class="t-desc">
                <img :src="'/images/' + task.image" width="100%" alt="">
            </div>
        </div>
        <transition name="fade">
            <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                <div class="t-points">
                    <p>10 pts</p>
                </div>
                <div class="t-btns pull-right">
                    <router-link :to="{ name: 'kanboard_viewtask', params: {task_id: 'asdasd123'} }" class="mysm-btn"><span class="fa fa-eye"></span></router-link>
                    <!-- <button class="mysm-btn"><span class="fa fa-edit"></span></button> -->
                    <button class="mysm-btn"><span class="fa fa-trash-o"></span></button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: ['i', 'task'],
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
        }
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
    //end of individual card
</style>

<template>
    <div>
        <div class="story-div" :style="i == 0? '' : 'margin-top: 0'">
            <div class="story-head"  v-if="i == 0">
                <div class="story-title" title="Tasks List">
                    <b><span class="fa fa-list-ul"></span> User Stories</b>
                </div>
                <!-- <div class="editListBtn pull-right">
                    <button @click="$router.push({name: 'addus_sprint'})" title="Add New User Story"><span class="fa fa-plus"></span></button>
                </div> -->
            </div>
            <div class="story-body">

                <!-- <div class="editListBtn pull-right">
                    <button @click="$router.push({name: 'addtask_sprint', params: {us_id: uStory.id}})" title="Add New Task"><span class="fa fa-plus"></span></button>
                </div> -->
                <!-- <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h4 class="no-margin">{{ uStory.name }}</h4>
                        <p class="no-margin"><small>{{ uStory.points }} pts</small></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right editListBtn">
                        <button @click="$router.push({name: 'addtask_sprint', params: {us_id: uStory.id}})" title="Add New Task" class="">
                        <span class="fa fa-plus"></span></button>
                    </div>
                </div> -->
                <div class="story-content">
                    <div class="story-first">
                        <h4 class="no-margin">{{ uStory.name }}</h4>
                        <p class="no-margin"><small>{{ uStory.points }} pts</small></p>
                    </div>
                    <div class="story-sec editListBtn">
                        <button @click="$router.push({name: 'addtask_sprint', params: {us_id: uStory.id}})" title="Add New Task" class="">
                        <span class="fa fa-plus"></span></button>
                    </div>
                </div>
                
                
            </div>
        </div>
        <list-card v-for="(status , index) in statuses" :key="index" :status="status" :ind="i" :uStory="uStory"></list-card>
    </div>
</template>

<script>
import Card from './Card.vue';
export default {
    components: {
        listCard: Card,
    },
    props: ['uStory', 'i'],
    data() {
        return {
            statuses: [
                {id: 1, name: 'To Do'},
                {id: 2, name: 'In progress'},
                {id: 3, name: 'Ready for Test'},
                {id: 4, name: 'Closed'},
            ]
        }
    }
}
</script>
<style lang="scss" scoped>
    
    .story-div{
        height: auto;
        width: 300px;
        overflow-y:visible;
        background-color:beige;
        padding: 0;
        margin-top: 10px;
        display: inline-block;
        // margin-right: 10px;
        vertical-align:text-top;
    }

    .story-head{
        background-color: #dcdcdc;
        position: relative;
    }
    .story-title{
        display:inline-block;
        padding: 5px 8px;
        color: rgb(38,38,38);
        width: 50%;
        font-size: 13px;
        font-style: bold;
        overflow-x: hidden;
    }

    .story-body {
        height: 40vh; 
        background-color: rgb(234,234,234);
        // padding: 10px;
        .story-content{
            display: flex;
            .story-first{
                display: inline-block;
                width: 70%;
                padding: 10px 15px;
            }
            .story-sec{
                display: inline-block;
                width: 30%;
                padding: 10px 15px;
            }
        }
    }

    .editListBtn{
        display:inline-block ;
        width: 50%;
        text-align: right;
        button{
            background: transparent;
            color: rgb(105, 105, 105);
            padding: 5px 9px;
            border: none;
            box-shadow: none;
            margin: 0;
            border-radius: 50%;
        }
        button:hover{
            background-color: rgb(199, 199, 199);
            color: rgb(92, 92, 92);
            transition: 0.5s;
        }
    }
</style>


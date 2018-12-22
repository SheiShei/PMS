<template>

    <section class="main-main-container" id="kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-wrapper">
            <router-view></router-view>
            <div class="board-header">
                <div class="board-name">
                    <h4 class="" style="">Web Boards</h4>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;12</p>
                </div>
                <div class="board-info">
                    <p title="Members"><span class="fa fa-user-o"></span>&nbsp;7</p>
                </div>
                <div class="board-info">
                    <a class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                </div>
            </div>
            <button class="btn btn-success btn-sm" @click="addListDiv"> + Add New List</button>
            <router-link :to="{ name: 'kanboard_addtask'}" class="btn btn-success btn-sm"> + Add Task</router-link>
            <router-link :to="{ name: 'kanboard_viewtask', params: {task_id: 'asdasd123'} }" class="btn btn-warning btn-sm"> View Task</router-link>
            <router-link :to="{ name: 'kanboard_gallery', params: {task_id: '123asd'} }" class="btn btn-danger btn-sm"> Open Gallery</router-link>
            
            <div id="testTaskDiv" class="board-body">
                <list-card v-for="(listDiv , index) in listDivs" :key="index" :listDiv="listDiv"></list-card>
            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import Card from './kanban/Card.vue';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        listCard: Card
        // gallery: Gallery
    },
    data() {
        return {
            listDivs: [
                {name: 'tghnkm',about: ''},
                {name: 'tghnkm',about: ''},
                {name: 'tghnkm',about: ''},
            ],
        }
    },
    methods: {
        addListDiv(){
            this.listDivs.push({
                name: "",
                about: ""
            });
            this.scrollToEnd()
        },
        scrollToEnd(){
            // var listdiv = document.querySelector(".list-div")
            // var taskdiv = document.querySelector("#testTaskDiv")
            // // var scrollWidth = tas?kdiv.scrollHeight + 200
            // taskdiv.scrollLeft = taskdiv.scrollWidth + 300
        },
    }
}
</script>

<style scoped lang="scss">

    
</style>




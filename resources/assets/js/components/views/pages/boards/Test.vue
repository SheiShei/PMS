<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-wrapper">
            <!-- <router-view></router-view> -->
            <div class="board-header">
                <div class="board-name">
                    <h4 class="" style="">Test Board</h4>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;100</p>
                </div>
                <div class="board-info">
                    <p title="Members"><span class="fa fa-user-o"></span>&nbsp;5</p>
                </div>
                <div class="board-info">
                    <a class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                </div>
            </div>
            <!-- <button class="btn btn-success btn-sm"> + Add New List</button> -->
            <!-- <router-link :to="{ name: 'kanboard_addtask'}" class="btn btn-success btn-sm"> + Add Task</router-link>
            <router-link :to="{ name: 'kanboard_viewtask', params: {task_id: 'asdasd123'} }" class="btn btn-warning btn-sm"> View Task</router-link>
            <router-link :to="{ name: 'kanboard_gallery', params: {task_id: '123asd'} }" class="btn btn-danger btn-sm"> Open Gallery</router-link> -->
            
            <div id="testTaskDiv" class="board-body">
                <draggable v-model="boardLists" :options="{animation:200, group:'status'}" @change="updateListOrder" :element="'div'">
                    <list-card v-for="(list , index) in boardLists" :key="index" :li="index" :list="list"></list-card>
                </draggable>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>

</style>

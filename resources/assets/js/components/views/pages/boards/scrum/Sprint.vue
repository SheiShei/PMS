<template>

    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-wrapper" v-if="cSprint">
            <router-view></router-view>
            <div class="board-header">
                <div class="board-name">
                    <router-link :to="{name: 'scrumboard', params: {board_id: $route.params.board_id}}" style="color: #ffff"><h4 class="" style="">{{ cSprint.name }}</h4></router-link>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;{{ tasks.length }}</p>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;{{ totalPoints }} pts</p>
                </div>
                <div class="board-info">
                    <a class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                </div>
            </div>
            <div id="statusListDiv" class="board-body">
                <status-card v-for="(stat) in status" :key="stat.id" :status="stat" :tasks="tasks"></status-card>
            </div>
        </div>
    </section>
</template>

<script>
import Card from './sprint/Card.vue';
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        statusCard: Card
        // gallery: Gallery
    },
    data() {
        return {
            status: [
                {id: 1, name: 'New'},
                {id: 2, name: 'In progress'},
                {id: 3, name: 'Ready for Test'},
                {id: 4, name: 'Closed'},
            ]
        }
    },
    created() {
        // this.$store.dispatch('getSprintTasks', this.$route.params.sprint_id)
        this.$store.dispatch('getScrumLists', this.$route.params.board_id)
            .then(() => {
                this.$store.commit('getSprintTasks', this.$route.params.sprint_id);
                this.$store.commit('getSprint', this.$route.params.sprint_id);
            })
        this.$store.dispatch('getBoardMembers', this.$route.params.board_id);
        
        // 
    },
    mounted() {
        this.stopSprintEvents();
        this.listenSprintEvents()
    },
    destroyed() {
        this.stopSprintEvents();
        this.$store.commit('scrumBoardDestroyed');
    },
    computed: {
        ...mapGetters({
                cSprint: 'getSprint',
                tasks: 'getSprintTasks'
            }),
        totalPoints() {
            let points = 0;
            this.tasks.forEach(task => {
                points = points + task.points
            });
            return points;
        }
    },
    methods: {
        scrollToEnd(){
            // var listdiv = document.querySelector(".list-div")
            var taskdiv = document.querySelector("#statusListDiv")
            // var scrollWidth = tas?kdiv.scrollHeight + 200
            taskdiv.scrollLeft = taskdiv.scrollWidth + 300
        },
        
        listenSprintEvents() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('UpdateListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprintTask', e.task);
                })
                .listen('UpdateSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprint', e.sprint);
                })
                .listen('AddListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addSprintTask', e.task);
                })
                .listen('SprintTaskOrderEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('setScrumLists', JSON.parse(e.sprints));
                    this.$store.commit('getSprintTasks', this.$route.params.sprint_id);
                })
                .listen('ISprintTaskOrderEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('setScrumLists', JSON.parse(e.sprints));
                    this.$store.commit('getSprintTasks', this.$route.params.sprint_id);
                })
                .listen('DeleteListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteSprintTask', e.task_id);
                })
        },
        
        stopSprintEvents() {
            Echo.leave('list.'+this.$route.params.board_id)
        }
    }
}
</script>

<style scoped lang="scss">

    
</style>




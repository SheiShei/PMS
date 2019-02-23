<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" :style="'background-image: url('+board.board_image+');'" v-if="cSprint && board">
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper" >
                <router-view :usPermission="usPermission" :taskPermission="taskPermission" :cTasks="computeTaskCompleted" :tTasks="computeTaskLength"></router-view>
                
                <div class="board-header">
                    <div class="board-name">
                        <router-link :to="{name: 'test', params: {board_id: $route.params.board_id}}" style="color: #ffff"><h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;&nbsp;<span class="fa fa-angle-right"></span>&nbsp;&nbsp;{{ cSprint.name }}</h4></router-link>
                    </div>
                    <div class="board-info">
                        <a @click="$router.push({name: 'sprint_stats'})" class="btn btn-white btn-simple btn-xs"><span class="fa fa-line-chart"></span> Stats</a>
                    </div>
                </div>
                <div class="board-body-wrapper">
                    <div v-for="(uStory, i) in cSprint.us" :key="i">
                        <user-story :uStory="uStory" :i="i" :usPermission="usPermission" :taskPermission="taskPermission"></user-story>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import UserStory from './sprint/UserStory.vue';
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        userStory: UserStory,
    },
    
    data() {
        return {
            storyDivs: [
                {name: 'Home Page',about: ''},
                {name: 'About Page',about: ''},
                {name: 'Storyless Tasks',about: ''},
            ],
            taskPermission: {
                modify: false,
                view: false,
                add: false,
                delete: false,
                comment: false
            },
            usPermission: {
                modify: false,
                view: false,
                add: false,
                delete: false,
            }
        }
    },

    created() {
        this.$store.dispatch('getScrumLists', this.$route.params.board_id)
            .then(() => {
                this.$store.commit('getSprintTasks', this.$route.params.sprint_id);
                this.$store.commit('getSprint', this.$route.params.sprint_id);
            })
        this.$store.dispatch('getBoardMembers', this.$route.params.board_id);
        this.$store.dispatch('getCBoard', this.$route.params.board_id)
            .then(response => {
                this.manageUserPermissions(response);
            })
    },
    mounted() {
        this.stopEvents();
        this.listenEvents();
    },
    destroyed() {
        this.stopEvents();
    },
    computed: {
        ...mapGetters({
                cSprint: 'getSprint',
                board: 'getCBoard',
            }),
        computeTaskLength() {
            let totalTask = 0
            this.cSprint.tasks.forEach(task => {
                totalTask++;
            });
            return totalTask;
        },
        computeTaskCompleted() {
            let totalTask = 0
            this.cSprint.tasks.forEach(task => {
                if(task.status == 4) {
                    totalTask++;
                }
            });
            return totalTask;
        }
    },

    methods: {
        manageUserPermissions(response) {
            response.forEach(permit => {

                if(permit.type == "us" && permit.name == "Add" && permit.isAuthenticated) {
                    this.usPermission.add = true
                }
                if(permit.type == "us" && permit.name == "View" && permit.isAuthenticated) {
                    this.usPermission.view = true
                }
                if(permit.type == "us" && permit.name == "Modify" && permit.isAuthenticated) {
                    this.usPermission.modify = true
                }
                if(permit.type == "us" && permit.name == "Delete" && permit.isAuthenticated) {
                    this.usPermission.delete = true
                }

                if(permit.type == "task" && permit.name == "Add" && permit.isAuthenticated) {
                    this.taskPermission.add = true
                }
                if(permit.type == "task" && permit.name == "View" && permit.isAuthenticated) {
                    this.taskPermission.view = true
                }
                if(permit.type == "task" && permit.name == "Modify" && permit.isAuthenticated) {
                    this.taskPermission.modify = true
                }
                if(permit.type == "task" && permit.name == "Delete" && permit.isAuthenticated) {
                    this.taskPermission.delete = true
                }
                if(permit.type == "task" && permit.name == "Comment" && permit.isAuthenticated) {
                    this.taskPermission.comment = true
                }
            });
        },

        listenEvents() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('UpdateListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprintTask', e.task);
                })
                .listen('UpdateSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprint', e.sprint);
                })
                .listen('SprintTaskOrderEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('setScrumLists', JSON.parse(e.sprints));
                    this.$store.commit('getSprint', this.$route.params.sprint_id);
                })
                .listen('UpdateUSEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateUS', e.us);
                })
                .listen('DeleteUSEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteUS', e.us_id);
                })
                .listen('AddListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addUSSprintTask', e.task);
                })
                .listen('DeleteListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteSprintTask', e.task_id);
                })
        },
        
        stopEvents() {
            Echo.leave('list.'+this.$route.params.board_id)
        }
    }
}
</script>
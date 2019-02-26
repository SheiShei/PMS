<template>

    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" :style="'background-image: url('+board.board_image+');'" v-if="board"> 
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper">
                <router-view :sprintPermission="sprintPermission" :usPermission="usPermission" :taskPermission="taskPermission"></router-view>
                <scrum-about  v-if="viewBAbout" @close="viewBAbout = false" :board="board"></scrum-about>
                <scrum-setting  v-if="viewBSettings" @close="viewBSettings = false" :cUser="cUser" :boardData="board" :permissions="permissions" :role_permissions="role_permissions" :not_members="not_members"></scrum-setting>

                <div class="board-header">
                    <div class="board-name">
                        <h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;{{ board.name }}</h4>
                    </div>
                    <div class="board-info">
                        <button @click="viewBAbout = !viewBAbout" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-info-circle fa-xs"></span> 
                            Details
                        </button>
                    </div>
                    <div class="board-info" v-if="isAdmin">
                        <a @click.prevent="viewBSettings = !viewBSettings" class="btn btn-white btn-simple btn-round btn-xs" title="Board Settings"><span class="fa fa-gears fa-xs"></span> Board Settings</a>
                    </div>
                    <div class="board-info">
                        <a @click.prevent="vFS = !vFS" class="btn btn-white btn-simple btn-xs"><span class="fa fa-"></span> {{ vFS ? 'Hide Closed Sprint' : 'Show Closed Sprint' }}</a>
                    </div>
                </div>

                <div>
                    <router-link v-if="sprintPermission.add" :to="{name: 'scrumboard_newsprint'}" class="btn btn-success btn-sm"> + Add New Sprint</router-link>
                    <!-- <div id="scrumListDiv" class="board-body">
                        <sprint-card v-for="sprint in sprints" :key="sprint.id" :sprint="sprint" :sprintPermission="sprintPermission" :usPermission="usPermission" :taskPermission="taskPermission"></sprint-card>
                    </div> -->
                    <div v-if="vFS" id="scrumListDiv" class="board-body">
                        <sprint-card v-for="sprint in sprints" :key="sprint.id" :sprint="sprint" :sprintPermission="sprintPermission" :usPermission="usPermission" :taskPermission="taskPermission"></sprint-card>
                    </div>
                    <div v-else id="scrumListDiv" class="board-body">
                        <sprint-card v-for="sprint in sprints" v-if="sprint.finished_at == null" :key="sprint.id" :sprint="sprint" :sprintPermission="sprintPermission" :usPermission="usPermission" :taskPermission="taskPermission"></sprint-card>
                    </div>
                </div>
                

                

                <!-- <div id="scrumListDiv" class="board-body">
                    <sprint-card v-for="sprint in sprints" :key="sprint.id" :sprint="sprint"></sprint-card>
                </div> -->
                <!-- <div v-else id="scrumListDiv" class="board-body">
                    <sprint-card v-for="(sprint) in scrumLists" v-if="sprint.finished_at == null" :key="sprint.id" :sprint="sprint"></sprint-card>
                </div> -->
            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import Card from './test/Card.vue';
import Settings from './test/ScrumSettings.vue';
import About from './test/ScrumAbout.vue';
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        sprintCard: Card,
        scrumSetting: Settings,
        scrumAbout: About
        // gallery: Gallery
    },
    data() {
        return {
            vFS: false,
            viewBDChart: false,
            viewBSettings: false,
            viewBAbout: false,
            viewMemmod: false,
            taskPermission: {
                modify: false,
                view: false,
                add: false,
                delete: false,
                comment: false
            },
            sprintPermission: {
                modify: false,
                view: false,
                add: false,
                delete: false,
            },
            usPermission: {
                modify: false,
                view: false,
                add: false,
                delete: false,
            },
            isAdmin: false
        }
    },
    created() {
        this.$store.dispatch('getScrumLists', this.$route.params.board_id);
        this.$store.dispatch('getBoardMembers', this.$route.params.board_id);
        this.$store.dispatch('getCBoard', this.$route.params.board_id)
            .then(response => {
                this.manageUserPermissions(response);
                this.checkIfAdmin();
            })
        this.getBoardNotMembers();
    },
    mounted() {
        this.stopEvents();
        this.listenEvents();
    },
    destroyed() {
        this.stopEvents();
        // this.$store.commit('boardDestroyed');
        // this.$store.commit('scrumBoardDestroyed');
    },
    computed: {
        ...mapGetters({
                sprints: 'getScrumLists',
                boardMembers: 'boardMembers',
                board: 'getCBoard',
                permissions: 'getPermissionsList',
                role_permissions: 'getRolePermissions',
                not_members: 'getBoardNotMembers',
                cUser: 'currentUser'
            }),
        computeUSLength() {
            let totalTask = 0
            if(this.sprints) {
                this.sprints.forEach(list => {
                    totalTask += list.us.length
                });
            }
            return totalTask;
        }
    },
    methods: {
        scrollToEnd(){
            // var listdiv = document.querySelector(".list-div")
            var taskdiv = document.querySelector("#scrumListDiv")
            // var scrollWidth = tas?kdiv.scrollHeight + 200
            taskdiv.scrollLeft = taskdiv.scrollWidth + 300
        },

        getBoardNotMembers() {
            this.$store.dispatch('getBoardNotMembers', {board_id: this.$route.params.board_id})
        },

        manageUserPermissions(response) {
            response.forEach(permit => {
                if(permit.type == "sprint" && permit.name == "Add" && permit.isAuthenticated) {
                    this.sprintPermission.add = true
                }
                if(permit.type == "sprint" && permit.name == "View" && permit.isAuthenticated) {
                    this.sprintPermission.view = true
                }
                if(permit.type == "sprint" && permit.name == "Modify" && permit.isAuthenticated) {
                    this.sprintPermission.modify = true
                }
                if(permit.type == "sprint" && permit.name == "Delete" && permit.isAuthenticated) {
                    this.sprintPermission.delete = true
                }

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

        checkIfAdmin() {
            this.board.bu.forEach(user => {
                if(user.id == this.cUser.id) {
                    if(user.pivot.isAdmin) {
                        this.isAdmin = true;
                    }
                }
            });
        },

        listenEvents() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('UpdateListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprintTask', e.task);
                })
                .listen('AddSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addsprint', e.sprint);
                })
                .listen('UpdateSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprint', e.sprint);
                })
                .listen('DeleteSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteSprint', e.sprint);
                })
                .listen('NewUSEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addUS', e.us);
                })
                .listen('SprintTaskOrderEvent', (e) => {
                    // console.log(e);
                    this.$store.dispatch('getScrumLists', this.$route.params.board_id)
                })
                .listen('DeleteUSEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteUS', e.us_id);
                })
                .listen('UpdateUSEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateUS', e.us);
                })
        },
        
        stopEvents() {
            Echo.leave('list.'+this.$route.params.board_id)
        }
    }
}
</script>

<style scoped lang="scss">
.taskchart{
    p, h6, h4{
        margin:0;
    }
}
.overlay{
    position: absolute;
    top:0;
    left:0;
    // min-height: 100%;
}
</style>
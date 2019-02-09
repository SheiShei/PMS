<template>

    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" style="background-image: url('/images/bts.jpg');"> 
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper" v-if="board">
                <router-view></router-view>
                <scrum-about  v-if="viewBAbout" @close="viewBAbout = false"></scrum-about>
                <scrum-setting  v-if="viewBSettings" @close="viewBSettings = false" :boardData="board" :permissions="permissions" :role_permissions="role_permissions" :not_members="not_members"></scrum-setting>

                <div class="board-header">
                    <div class="board-name">
                        <h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;{{ board.name }}</h4>
                    </div>
                    <div class="board-info">
                        <button @click="viewBAbout = !viewBAbout" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-info-circle fa-xs"></span> 
                            About <span class="fa fa-angle-down"></span> 
                        </button>
                    </div>
                    <div class="board-info">
                        <a @click.prevent="vFS = !vFS" class="btn btn-white btn-simple btn-xs"><span class="fa fa-"></span> {{ vFS ? 'Hide Closed Sprint' : 'Show Closed Sprint' }}</a>
                    </div>
                    <div class="board-info">
                        <a @click.prevent="viewBSettings = !viewBSettings" class="btn btn-white btn-simple btn-round btn-xs" title="Board Settings"><span class="fa fa-gears fa-xs"></span> Board Settings</a>
                    </div>
                </div>

                <div>
                    <router-link :to="{name: 'scrumboard_newsprint'}" class="btn btn-success btn-sm"> + Add New Sprint</router-link>
                    <div id="scrumListDiv" class="board-body">
                        <sprint-card v-for="sprint in sprints" :key="sprint.id" :sprint="sprint"></sprint-card>
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
            viewMemmod: false
        }
    },
    created() {
        this.$store.dispatch('getScrumLists', this.$route.params.board_id);
        this.$store.dispatch('getBoardMembers', this.$route.params.board_id);
        this.$store.dispatch('getCBoard', this.$route.params.board_id);
        this.getBoardNotMembers();
    },
    computed: {
        ...mapGetters({
                sprints: 'getScrumLists',
                boardMembers: 'boardMembers',
                board: 'getCBoard',
                permissions: 'getPermissionsList',
                role_permissions: 'getRolePermissions',
                not_members: 'getBoardNotMembers'
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
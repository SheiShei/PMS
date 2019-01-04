<template>

    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-wrapper" v-if="board">
            <router-view></router-view>
            <div class="board-header">
                <div class="board-name">
                    <h4 class="" style="">{{ board.name }}</h4>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;{{ computeTaskLength }}</p>
                </div>
                <div class="board-info">
                    <p title="Members"><span class="fa fa-user-o"></span>&nbsp;{{ boardMembers.length }}</p>
                </div>
                <div class="board-info">
                    <a class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                </div>
                <div class="board-info">
                    <a @click.prevent="vFS = !vFS" class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> {{ vFS ? 'Hide Closed Sprint' : 'Show Closed Sprint' }}</a>
                </div>
            </div>
            <router-link :to="{name: 'scrumboard_newsprint'}" class="btn btn-success btn-sm"> + Add New Sprint</router-link>
            
            <div v-if="vFS" id="scrumListDiv" class="board-body">
                <sprint-card v-for="(sprint) in scrumLists" :key="sprint.id" :sprint="sprint"></sprint-card>
            </div>
            <div v-else id="scrumListDiv" class="board-body">
                <sprint-card v-for="(sprint) in scrumLists" v-if="sprint.finished_at == null" :key="sprint.id" :sprint="sprint"></sprint-card>
            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import Card from './scrum/Card.vue';
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        sprintCard: Card
        // gallery: Gallery
    },
    data() {
        return {
            vFS: false
        }
    },
    created() {
        this.$store.dispatch('getScrumLists', this.$route.params.board_id);
        this.$store.dispatch('getBoardMembers', this.$route.params.board_id);
        this.$store.dispatch('getCBoard', this.$route.params.board_id);
    },
    destroyed() {
        this.$store.commit('boardDestroyed');
        this.$store.commit('scrumBoardDestroyed');
    },
    computed: {
        ...mapGetters({
                scrumLists: 'getScrumLists',
                boardMembers: 'boardMembers',
                board: 'getCBoard',
            }),
        computeTaskLength() {
            let totalTask = 0
            if(this.scrumLists) {
                if(this.vFS) {
                    this.scrumLists.forEach(list => {
                        totalTask += list.tasks.length
                    });
                }
                else {
                    this.scrumLists.forEach(list => {
                        if(!list.finished_at) {
                            totalTask += list.tasks.length
                        }
                    });
                }
            }
            return totalTask;
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
            var taskdiv = document.querySelector("#scrumListDiv")
            // var scrollWidth = tas?kdiv.scrollHeight + 200
            taskdiv.scrollLeft = taskdiv.scrollWidth + 300
        },
    }
}
</script>

<style scoped lang="scss">

    
</style>




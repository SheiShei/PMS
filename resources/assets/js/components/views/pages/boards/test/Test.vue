<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" style="background-image: url('/images/above-art1.jpg');">
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper" v-if="cSprint && board">
                <router-view></router-view>
                
                <div class="board-header">
                    <div class="board-name">
                        <router-link :to="{name: 'test', params: {board_id: $route.params.board_id}}" style="color: #ffff"><h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;&nbsp;<span class="fa fa-angle-right"></span>&nbsp;&nbsp;{{ cSprint.name }}</h4></router-link>
                    </div>
                    <div class="board-info">
                        <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;12</p>
                    </div>
                    <div class="board-info">
                        <p title="Members"><span class="fa fa-user-o"></span>&nbsp;7</p>
                    </div>
                    <div class="board-info">
                        <a @click="$router.push({name: 'sprint_stats'})" class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                    </div>
                </div>
                <div class="board-body-wrapper">
                    <div v-for="(uStory, i) in cSprint.us" :key="i">
                        <user-story :uStory="uStory" :i="i"></user-story>
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
        }
    },

    created() {
        this.$store.dispatch('getScrumLists', this.$route.params.board_id)
            .then(() => {
                this.$store.commit('getSprintTasks', this.$route.params.sprint_id);
                this.$store.commit('getSprint', this.$route.params.sprint_id);
            })
        this.$store.dispatch('getBoardMembers', this.$route.params.board_id);
        this.$store.dispatch('getCBoard', this.$route.params.board_id);
    },

    computed: {
        ...mapGetters({
                cSprint: 'getSprint',
                board: 'getCBoard',
            }),
    },

    methods: {

    }
}
</script>
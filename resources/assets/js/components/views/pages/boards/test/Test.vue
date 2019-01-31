<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" style="background-image: url('/images/above-art1.jpg');">
            <div class="board-background-overlay">
            </div>
            <div class="board-wrapper" v-if="cSprint && board">
                <router-view></router-view>
                <transition name="slide">    
                    <div class="overlay" v-show="viewBDChart">   
                        <div class="burndown">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><span class="fa fa-line-chart"></span> Statistics - Sprint 1
                                    <span class="pull-right">
                                        <a class="btn btn-danger btn-simple btn-xs" @click="viewBDChart = !viewBDChart"><span class="fa fa-times-circle"></span></a>
                                    </span>
                                    </h4>
                                </div>
                                <div class="col-md-2 text-right">
                                    <!-- <a class="btn btn-danger btn-simple btn-just-icon btn-round btn-xs" @click="viewBDChart = !viewBDChart"><span class="fa fa-times-circle"></span></a> -->
                                </div>
                            </div>
                            
                            <br/>
                            <div class="card card-nav-tabs card-plain">
								<div class="header header-info">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<ul class="nav nav-tabs" data-tabs="tabs">
												<li class="active"><a href="#burndownchart" data-toggle="tab" aria-expanded="false">
                                                    <!-- <span class="fa fa-bell"></span>&nbsp; -->
                                                    Burndown Chart</a></li>
												<li class=""><a href="#cumulativechart" data-toggle="tab" aria-expanded="true">
                                                    <!-- <span class="fa fa-gear"></span>&nbsp; -->
                                                    Cumulative Chart<div class="ripple-container"></div></a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-content">
									<div class="tab-content text-center">
										<div class="tab-pane active" id="burndownchart">
                                            <burndown-chart></burndown-chart>
										</div>
										<div class="tab-pane" id="cumulativechart">
											<cumu-chart></cumu-chart>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </transition>
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
                        <a  @click="viewBDChart = !viewBDChart" class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
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
import BurndownChart from './sprint/BurndownChart.vue';
import CumulativeChart from './sprint/CumulativeChart.vue';
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        userStory: UserStory,
        burndownChart: BurndownChart,
        cumuChart: CumulativeChart
    },
    
    data() {
        return {
            storyDivs: [
                {name: 'Home Page',about: ''},
                {name: 'About Page',about: ''},
                {name: 'Storyless Tasks',about: ''},
            ],
            viewBDChart: false
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
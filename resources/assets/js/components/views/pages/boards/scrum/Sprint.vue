<template>

    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" style="background-image: url('/images/above-art1.jpg');">
        <div class="board-background-overlay">
        </div></div>
        <div class="board-wrapper" v-if="cSprint">
            <router-view></router-view>
            <div class="board-header">
                <div class="board-name">
                    <router-link :to="{name: 'scrumboard', params: {board_id: $route.params.board_id}}" style="color: #ffff"><h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;&nbsp;<span class="fa fa-angle-right"></span>&nbsp;&nbsp;{{ cSprint.name }}</h4></router-link>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;{{ tasks.length }}</p>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;{{ totalPoints }} pts</p>
                </div>
                <div class="board-info">
                    <a  @click="viewBDChart = !viewBDChart" class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                </div>
            </div>
            <div id="statusListDiv" class="board-body">
                <status-card v-for="(stat) in status" :key="stat.id" :status="stat" :tasks="tasks"></status-card>
            </div>

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

        </div>
        </div>
    </section>
</template>

<script>
import Card from './sprint/Card.vue';
// import BurndownChart from './sprint/BurndownChart.vue';
// import CumulativeChart from './sprint/CumulativeChart.vue';
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        statusCard: Card,
        burndownChart: BurndownChart,
        cumuChart: CumulativeChart
        // apexchart: VueApexCharts
        // gallery: Gallery
    },
    data() {
        return {
            status: [
                {id: 1, name: 'New'},
                {id: 2, name: 'In progress'},
                {id: 3, name: 'Ready for Test'},
                {id: 4, name: 'Closed'},
            ],
            viewBDChart: false
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


.overlay{
    position: absolute;
    top:0;
    left:0;
    min-height: 100%;
}
.card-nav-tabs {
    margin-top: 10px;
}  
</style>




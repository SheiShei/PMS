<template>
    <transition name="slide">    
        <div class="overlay">   
            <div class="burndown">
                <div class="row">
                    <div class="col-md-12">
                        <h4><span class="fa fa-line-chart"></span> Statistics - Sprint 1
                        <span class="pull-right">
                            <a class="btn btn-danger btn-simple btn-xs" @click="$router.go(-1)"><span class="fa fa-times-circle"></span></a>
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
									<!-- <li class=""><a href="#cumulativechart" data-toggle="tab" aria-expanded="true"> -->
                                        <!-- <span class="fa fa-gear"></span>&nbsp; -->
                                        <!-- Cumulative Chart<div class="ripple-container"></div></a></li> -->
								</ul>
							</div>
						</div>
					</div>
					<div class="card-content">
						<!-- <div class="tab-content text-center">
							<div class="tab-pane active" id="burndownchart">
                                <burndown-chart v-if="data" :chartData="data"></burndown-chart>
							</div>
							<div class="tab-pane" id="cumulativechart">
								<cumu-chart v-if="data" :chartData="data"></cumu-chart>
							</div>
						</div> -->
                        <kanban-chart v-if="data" :data="data"></kanban-chart>
					</div>
				</div>
            </div>
        </div>
    </transition>
</template>
<script>
import KanbanChart from './KanbanChart.vue';
import {mapGetters} from 'vuex';

export default {
    components: {
        kanbanChart: KanbanChart,
    },
    data() {
        return {
            data: null,
            range: 'week'
        }
    },
    created() {
        this.getArrayOfDates()
    },
    computed: {
        ...mapGetters({
            }),
    },
    methods: {
        getArrayOfDates() {
            var startOfWeek = moment().startOf(this.range).day(-7);
            var endOfWeek = moment().endOf(this.range);

            var days = [];
            var day = startOfWeek;

            while (day <= endOfWeek) {
                days.push(moment(day.toDate()).format('YYYY-MM-DD'));
                day = day.clone().add(1, 'd');
            }

            axios.post('/api/getBUData', {board_id: this.$route.params.board_id, dates: days})
                .then((response) => {
                    // console.log(response);
                    var max = 0;
                    response.data.data.forEach(date => {
                        if(date.y > max) {
                            max = date.y
                        }
                    });
                    response.data.max = max;
                    this.data = response.data
                })
        }
    }
}
</script>


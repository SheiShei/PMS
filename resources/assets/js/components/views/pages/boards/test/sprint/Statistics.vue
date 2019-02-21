<template>
    <transition name="slide">    
        <div class="overlay">   
            <div class="close-mod-btn">
                 <button type="button" @click="$router.go(-1)" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="burndown">
                <div class="row">
                    <div class="col-md-12">
                        <h4><span class="fa fa-line-chart"></span> Statistics
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="board-info" style="width: 100%">
                            <p class="txt-bold no-margin"><span class="fa fa-circle text-gray"></span> Board Progress</p>
                            <p class="text-gray"><small>Task Completed: 1/30 Completed<span class="pull-right txt-bold">35%</span></small></p>
                            <div class="no-margin progress progress-line-info">
                                <div class="progress-bar progress-bar-info" style="width: 35%;">
                                </div>
                            </div>
                        </div>
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
                                <burndown-chart v-if="data" :chartData="data"></burndown-chart>
							</div>
							<div class="tab-pane" id="cumulativechart">
								<cumu-chart v-if="data" :chartData="data"></cumu-chart>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </transition>
</template>
<script>
import BurndownChart from './BurndownChart.vue';
import CumulativeChart from './CumulativeChart.vue';
import {mapGetters} from 'vuex';

export default {
    components: {
        burndownChart: BurndownChart,
        cumuChart: CumulativeChart
    },
    data() {
        return {
            data: null
        }
    },
    created() {
        this.getArrayOfDates()
    },
    computed: {
        ...mapGetters({
                cSprint: 'getSprint',
            }),
    },
    methods: {
        getArrayOfDates() {
            var startDate = new Date(this.cSprint.started_at);
            // var startDate = startDate.setDate(startDate.getDate() - 1);
            var endDate = new Date(this.cSprint.due_date);

            var datesArray = [];
            var dt = new Date(startDate);

            while (dt <= endDate) {
                datesArray.push(moment(new Date(dt)).format('YYYY-MM-DD'));
                dt.setDate(dt.getDate() + 1);
                // console.log('shei');
                
            }

            // console.log(datesArray);
            axios.post('/api/getBD', {dates: datesArray, sprint_id: this.$route.params.sprint_id})
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
                .catch(error => {
                    console.error(error);
                    
                })
            
        }
    }
}
</script>


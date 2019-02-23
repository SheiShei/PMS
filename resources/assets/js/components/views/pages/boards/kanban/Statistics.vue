<template>
    <transition name="slide">    
        <div class="overlay">
            <div class="close-mod-btn">
                 <button type="button" @click="$router.go(-1)" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button>
                <!-- <button @click="$router.go(-1)" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button> -->
            </div>     
            <div class="burndown">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="no-margin"><span class="fa fa-line-chart"></span> Statistics</h4>
                        <hr/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="board-info" style="width: 100%">
                            <p class="txt-bold no-margin"><span class="fa fa-circle text-gray"></span> Board Progress</p>
                            <p class="text-gray"><small>Task Completed: {{ cTasks }}/{{ tTasks }} Completed<span class="pull-right txt-bold">{{ Math.round((cTasks / tTasks) * 100) }}%</span></small></p>
                            <div class="no-margin progress progress-line-info">
                                <div class="progress-bar progress-bar-info" :style="'width: '+Math.round((cTasks / tTasks) * 100)+'%;'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <!-- <p class="txt-bold no-margin"><span class="fa fa-circle text-gray"></span> Burndown Chart
                        </p> -->
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
    props: ['tTasks', 'cTasks'],
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


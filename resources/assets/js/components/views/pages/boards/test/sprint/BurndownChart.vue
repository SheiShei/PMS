<template>
    <div>
        <div id="chart">
            <apexchart type=line height=350 :options="chartOptions" :series="series" />
        </div>
    </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts';
export default {
    components: {
        apexchart: VueApexCharts
    },
    props: ['chartData'],
    data(){
        return{
            series: [{
                name: "Story Points Remaining",
                data: this.chartData.data
            }],
            chartOptions: {
                chart: {
                    height: 350,
                    zoom: {
                        enabled: true
                    }
                },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Burndown Chart',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                type: "datetime",
                // categories: ['2018 Jan 1', '2018 Jan 2', '2018 Jan 3', '2018 Jan 4', '2018 Jan 5', '2018 Jan 6', '2018 Jan 7'],
            },
            yaxis:{
                forceNiceScale: true,
                title: {
                    text: 'User Story Points Remaining'
                },
                labels: {
                    formatter: function(val, index) {
                        if(val % 1 === 0) {
                            return val;
                        }
                        return val.toFixed(1);
                    }
                }
            }
            }
        }
    },

    methods: {
        
    }
}
</script>

<style lang="scss" scoped>
.burndown{
    width: 90%;
    height: 80%;
    margin: auto;
    margin-top: 6%;
    vertical-align: middle;
    background-color: white;
    padding: 20px;
}
</style>

<template>
    <div>
        <div id="chart">
            <apexchart type=bar height=350 :options="chartOptions" :series="series" />
        </div>
    </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts';
export default {
    components: {
        apexchart: VueApexCharts
    },
    props: ['data'],
    data(){
        return{
            series: [{
                name: "Task Done",
                data: this.data.data
            }],
            chartOptions: {
                chart: {
                    height: 350,
                    zoom: {
                        enabled: false
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
                // categories: ['2018 Jan 1-4', '2018 Jan 5-9', '2018 Jan 10-20', '2018 Jan 21-Feb 20', '2018 Feb 21- 2019 Jan 1', '2019 Jan 2-10'],
            },
            yaxis:{
                min: 0 ,
                max: this.data.max
            }
            }
        }
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
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
    data(){
        return{
            series: [{
                name: "Task Done",
                data: [
                    {x:'2019-01-05', y:160},
                    {x:'2019-01-05', y:134}, 
                    {x:'2019-01-05', y:120}, 
                    {x:'2019-01-08', y:null}, 
                    {x:'2019-01-09', y:null}, 
                    {x:'2019-01-10', y:null}, 
                    {x:'2019-01-11', y:null},
                ]
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
                min: 0 ,
                max: 160
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

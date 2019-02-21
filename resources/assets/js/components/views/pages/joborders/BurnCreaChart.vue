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
                data: [160, 134, 120, 50, 37, 0]
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
                text: '',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['2018 Jan 1-4', '2018 Jan 5-9', '2018 Jan 10-20', '2018 Jan 21-Feb 20', '2018 Feb 21- 2019 Jan 1', '2019 Jan 2-10'],
            },
            yaxis:{
                min: 0 ,
                max: 160
            }
            }
        }
    }
}
</script>
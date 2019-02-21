<template>
    <div>
        <div id="chart">
             <apexchart type=area height=350 :options="chartOptions" :series="series" />
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
        series: [
        {
          name: 'Todo',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, {
          name: 'In Progress',
          data: [11, 32, 45, 32, 34, 52, 41]
        },
        {
          name: 'Done',
          data: [89, 80, 68, 12, 89, 12, 57]
        }],
        chartOptions: {
            chart:{
                stacked: false
            },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth'
          },
           xaxis: {
            // type: 'datetime',
            categories: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan"
            ],
          },
          tooltip: {
            x: {
              format: 'DD/MM/YYYY'
            },
           }
        }
        }
    }
}
</script>
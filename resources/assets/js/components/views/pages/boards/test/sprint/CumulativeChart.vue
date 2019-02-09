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
    props: ['chartData'],
    data(){
        return{
        series: [
        {
          name: 'Todo',
          data: this.chartData.todo
        }, {
          name: 'In Progress',
          data: this.chartData.in_progress
        },
        {
          name: 'Testing',
          data: this.chartData.for_test
        },
        {
          name: 'Closed',
          data: this.chartData.closed
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
            type: 'datetime',
            // categories: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan"
            // ],
          },
          tooltip: {
            x: {
              // format: 'DD/MM/YYYY'
            },

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

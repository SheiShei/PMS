<!--
/**
 * @fileoverview GanttElastic standalone version component
 * @license MIT
 * @author Rafal Pospiech <neuronet.io@gmail.com>
 * @package
 */
-->
<template>
  <section class="main-main-container" style="background-color: #43a0b9">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          
    <div class="workload-header">

      <div class="workload-name">
        <h4 class="" style=""><span class="fa fa-align-left"></span> Workloads</h4>
      </div>

      <div class="workload-info">
        <p title="Select Board">Filter by:</p>
      </div>

      <div class="workload-info">
        <div class="btn-group bootstrap-select">
          <select v-model="filterby" class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option value="byteam" selected>Team</option>
            <option value="bybrand">Brand</option>
          </select>
        </div>
      </div>



      <!-- <div class="workload-info">
        <p title="Select Board">Team:</p>
      </div> -->

      <div class="workload-info" v-show="filterby === 'byteam'">
        <div class="btn-group bootstrap-select">
          <select v-model="team" @change="initializeTask" class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option value="">All Teams</option>
            <option value="1">Web</option>
            <option value="2">Creatives</option>
          </select>
        </div>
      </div>

      <div class="workload-info" v-show="filterby != 'byteam'">
        <div class="btn-group bootstrap-select">
          <select class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option value="">Potato Corner </option>
            <option value="1">MFI</option>
            <option value="2">Luljetta's</option>
          </select>
        </div>
      </div>

      <div class="workload-info" v-show="filterby != 'byteam'">
        <div class="btn-group bootstrap-select">
          <select class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option value="">All JO</option>
            <option value="1">JO 2</option>
            <option value="2">JO 3</option>
          </select>
        </div>
      </div>

      <div class="workload-info">
        <p title="Select Board">Task Status:</p>
      </div>

      <div class="workload-info">
        <div class="btn-group bootstrap-select">
          <select class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option value="">All</option>
            <option value="1">Active</option>
            <option value="1">Completed</option>
            <option value="1">Overdued</option>
          </select>
        </div>
      </div>

    </div>
    <br/>
    </div>

       </div>    

    <div class="row">
        <div class="col-md-12">
  <gantt-elastic v-if="show" ref="shei" :tasks="tasks" :options="options">
    <gantt-header slot="header"></gantt-header>
    <!-- <gantt-footer slot="footer"></gantt-footer> -->
  </gantt-elastic>
   </div>
   </div>
   </div>

  </section>
 

</template>
<script>
import {mapGetters} from 'vuex';
import dayjs from "dayjs";
import GanttElastic from './workload/GanttElastic.vue';
import Header from './workload/Header.vue';
import style from "gantt-elastic/src/style.js";
export default {
  components: {
    'gantt-header': Header,
    'gantt-elastic': GanttElastic,
    'gantt-footer': { template: `` }
  },
  props: ['header', 'footer'],
  data() {
    return{
      team: '',
      filterby: 'byteam',
      show: true,
    tasks: [],
    options: {
      title: {
        label: 'Workload Manager',
        html: false
      },
      taskList: {
        columns: [
          // {
          //   id: 1,
          //   label: 'ID',
          //   value: 'id',
          //   width: 40
          // }, 
          {
            id: 2,
            label: 'Member',
            value: 'user',
            width: 140,
            html: true,
            expander: true
          }, 
          {
            id: 3,
            label: 'Tasks',
            value: 'label',
            width: 170,
            expander: false
          }, 
          // {
          //   id: 3,
          //   label: 'Start',
          //   value: (task) => task.startDate.format('YYYY-MM-DD'),
          //   width: 78
          // },
          {
            id: 4,
            label: 'Due',
            value: (task) => task.endDate.format('YYYY-MM-DD'),
            width: 78
          }, 
          // {
          //   id: 4,
          //   label: 'Type',
          //   value: 'type',
          //   width: 68
          // }, 
          // {
          //   id: 5,
          //   label: '%',
          //   value: 'progress',
          //   width: 35,
          //   style: {
          //     "task-list-header-label": {
          //       'text-align': 'center',
          //       'width': '100%'
          //     },
          //     "task-list-item-value": {
          //       'text-align': 'center',
          //       'width': '100%'
          //     }
          //   }
          // }
        ]
      },
      locale: {
        code: 'en',
        'Now': 'Now',
        'X-Scale': 'Zoom-X',
        'Y-Scale': 'Zoom-Y',
        'Task list width': 'Task list',
        'Before/After': 'Expand',
        'Display task list': 'Task list'
      }
    }
    }
  },
  created() {
    this.initializeTask();
  },
  computed: {
  },
  methods:{
    initializeTask() {
      this.show = false;
      axios.post('/api/testFunc', {team: this.team}) 
      .then(response => {
        
        this.tasks = [];
        this.show = false;
        let colors = [
            '#fc5c65',
            '#fd9644',
            '#45aaf2',
            '#A3CB38',
            '#ffc048',
            '#D6A2E8',
            '#fd79a8',
        ];
        let tasks = response.data;
        let style = {
          style : {
            base: {
              fill: '#D6A2E8',
              stroke: '#fff'
            }
          }
        }

        tasks.forEach(task => {
          task = Object.assign(task, {style : {
            base: {
              fill: colors[Math.floor(Math.random() * 7)],
              stroke: '#fff'
            }
          }});
          task.start = ''+task.start;
          this.tasks.push(task)
        });
        this.show = true;
        // console.log(this.tasks);
      })
      .catch(error => {
        console.error(error);
      })
    }
  }
}
</script>

<style scoped>
.title-head > h2,
.title-head > select{
  display: inline-block;
} 
.gantt-elastic__header{
  /* background: rgb(228, 233, 239) !important; */
  background: #eaedf1 !important;
}
.gantt-elastic__header-label,
.gantt-elastic__header-title--text{
  color: white !important;
}
</style>

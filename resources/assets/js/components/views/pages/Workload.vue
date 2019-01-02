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
    <div class="workload-header" style="margin: 5px 20px;">

      <div class="workload-name">
        <h4 class="" style=""><span class="fa fa-align-left"></span> Workloads</h4>
      </div>

      <div class="workload-info">
        <p title="Select Board">From Board:</p>
      </div>

      <div class="workload-info">
        <div class="btn-group bootstrap-select">
          <select class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option value="">All Boards</option>
            <option value="">Board 1</option>
            <option value="">Board 2</option>
          </select>
        </div>
      </div>

      <div class="workload-info">
        <p title="Total Tasks on this Board"><span class="fa fa-tasks"></span>&nbsp;12</p>
      </div>

      <div class="workload-info">
        <p title="Persons involved"><span class="fa fa-user-o"></span>&nbsp;7</p>
      </div>
    </div>
           


  <div style="margin: 10px 20px; border: 1px solid lightgray">                
  <gantt-elastic :tasks="tasks" :options="options">
    <gantt-header slot="header"></gantt-header>
    <gantt-footer slot="footer"></gantt-footer>
  </gantt-elastic>
   </div>
  </section>
 

</template>
<script>
import dayjs from "dayjs";
import GanttElastic from './workload/GanttElastic.vue';
import style from "gantt-elastic/src/style.js";
function getDate(hours) {
      const currentDate = new Date();
      const currentYear = currentDate.getFullYear();
      const currentMonth = currentDate.getMonth() + 1;
      const currentDay = currentDate.getDate();
      const timeStamp = new Date(`${currentYear}-${currentMonth}-${currentDay} 00:00:00`).getTime();
      return new Date(timeStamp + hours * 60 * 60 * 1000);
    };
export default {
  components: {
    'gantt-header': { template: `` },
    'gantt-elastic': GanttElastic,
    'gantt-footer': { template: `` }
  },
  props: ['header', 'footer'],
  data() {
    return{
    tasks: [
      {
        id: 1,
        label: 'Task 1 (Simula pinakamaaga yung start)',
        user: '<img src="images/default.png" class="workload-user-pic" />&nbsp;&nbsp;<a href="https://www.google.com/search?q=Clark+Kent" target="_blank" style="color:#0077c0;">User 1</a>',
        start: getDate(-24 * 5),
        duration: 5 * 24 * 60 * 60,
        progress: 0,
        type: 'task',
        style: {
          base: {
            fill: "#fc5c65",
            stroke: '#fff'
          }
        }
      }, {
        id: 2,
        label: 'Task 2',
        user: '<img src="images/default.png" class="workload-user-pic" />&nbsp;&nbsp;<a href="https://www.google.com/search?q=Clark+Kent" target="_blank" style="color:#0077c0;">User 1</a>',
        parentId: 1,
        // dependentOn: [1],
        start: getDate(-24 * 4),
        duration: 4 * 24 * 60 * 60,
        progress: 100,
        type: 'task',
        // dependentOn: [1],
        style: {
          base: {
            fill: "#fd9644",
            stroke: '#fff'
          }
          /*'tree-row-bar': {
            fill: '#1EBC61',
            stroke: '#0EAC51'
          },
          'tree-row-bar-polygon': {
            stroke: '#0EAC51'
          }*/
        }
      }, {
        id: 3,
        label: 'Task 3',
        user: '<img src="images/default.png" class="workload-user-pic" />&nbsp;&nbsp;<a href="https://www.google.com/search?q=Clark+Kent" target="_blank" style="color:#0077c0;">User 1</a>',
        parentId: 1,
        // dependentOn: [],
        start: getDate(-24 * 3),
        duration: 2 * 24 * 60 * 60,
        progress: 100,
        type: 'task',
        dependentOn: [2],
        style: {
          base: {
            fill: "#45aaf2",
            stroke: '#fff'
          }
        }
        },
      
       {
        id: 4,
        label: 'Task 1',
        user: '<img src="images/default.png" class="workload-user-pic" />&nbsp;&nbsp;<a href="https://www.google.com/search?q=Clark+Kent" target="_blank" style="color:#0077c0;">User 2</a>',
        start: getDate(-24 * 2),
        duration: 2 * 24 * 60 * 60,
        progress: 0,
        type: 'task',
        dependentOn: [],
        style: {
          base: {
            fill: "#A3CB38",
            stroke: '#fff'
          }
        }
      },
      {
        id: 5,
        label: 'One billion, gajillion, fafillion... shabadylu...mil...shabady......uh, Yen.',
        user: '<img src="images/default.png" class="workload-user-pic" />&nbsp;&nbsp;<a href="" target="_blank" style="color:#0077c0;">User 2</a>',
        parentId: 4,
        start: getDate(0),
        duration: 2 * 24 * 60 * 60,
        progress: 100,
        parentId: 4,
        dependentOn: [4],
        type: 'task',
        style: {
          base: {
            fill: '#fd79a8',
            stroke: '#fff'
          }
        }
      },
      // }, 
      {
        id: 6,
        label: 'Butch Mario and the Luigi Kid',
        user: '<img src="images/default.png" class="workload-user-pic" />&nbsp;&nbsp;<a href="" target="_blank" style="color:#0077c0;">User 2</a>',
        parentId: 4,
        dependentOn:[5],
        start: getDate(24),
        duration: 1 * 24 * 60 * 60,
        progress: 100,
        type: 'task',
        style: {
          base: {
            fill: '#D6A2E8',
            stroke: '#fff'
          }
        }
      }
    ],
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
            value: (task) => task.startDate.format('YYYY-MM-DD'),
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
  methods:{
    
  }
}
</script>

<style scoped>
.title-head > h2,
.title-head > select{
  display: inline-block;
} 
</style>

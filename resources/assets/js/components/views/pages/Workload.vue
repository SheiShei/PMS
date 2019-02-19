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
          <select v-model="byteam"  @change="initializeTask" class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
          </select>
        </div>
      </div>

      <div class="workload-info" v-show="filterby != 'byteam'">
        <div class="btn-group bootstrap-select">
          <select v-model="jo" class="selectpicker"  @change="initializeTask" data-style="btn btn-sm btn-info" type="text">
            <option v-for="jos in brands" :key="jos.id" :value="jos.id">{{ jos.name }}</option>            
            <option value="">All JO</option>
            <option value="1">JO 2</option>
            <option value="2">JO 3</option>
          </select>
        </div>
      </div>

      <div class="workload-info">
        <p title="Select Board">Task Status:</p>
      </div>

      <div class="workload-info" v-show="team!=1">
        <div class="btn-group bootstrap-select">
          <select v-model="task_status"  @change="initializeTask" class="selectpicker" data-style="btn btn-sm btn-info" type="text">
            <option value="">All</option>
            <option value="false">Active</option>
            <option value="true">Completed</option>
        
          </select>
        </div>
      </div>
      <div class="workload-info" v-show="team==1">
        <div class="btn-group bootstrap-select">
          <select v-model="task_status"  class="selectpicker"  @change="initializeTask" data-style="btn btn-sm btn-info" type="text">
            <option value="">All</option>
            <option value="1">To do</option>
            <option value="2">In Progress</option>
            <option value="3">Ready for Test</option>
            <option value="4">Closed</option>
        
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
      byteam: '',
      jo: '',
      task_status: '',
      data:  {
       filter: {position: 'desc', category:'created_at'},
        search: '',
        notArchive: true
        },
    tasks: [],
    options: {
      title: {
        label: 'Workload Manager',
        html: false
      },
      taskList: {
        columns: [
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
          {
            id: 4,
            label: 'Due',
            value: (task) => task.endDate.format('YYYY-MM-DD'),
            width: 78
          }, 
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
    const data = this.data;
   
    this.$store.dispatch('setBrands', {url : '/api/getbrands', data})
    $(this.$el).find('.selectpicker').selectpicker('refresh');
             },
  computed: {
      ...mapGetters({
                brands: 'brandsList',
               
            }),
  },
  methods:{
    initializeTask() {
      this.show = false;
      console.log('team:',this.team,'byteam:',this.byteam,'jo:',this.jo,'task_status:',this.task_status);
      axios.post('/api/testFunc',
       { team: this.team,
        byteam: this.byteam,
        jo: this.jo,
        task_status: this.task_status,  
      }) 
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

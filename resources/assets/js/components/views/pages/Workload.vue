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
					<select @change="initializeTask" v-model="filterby" class="selectpicker" data-style="btn btn-sm btn-info" type="text">
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
					<select v-model="selectedBrand" @change="refreshPicker" class="selectpicker" data-style="btn btn-sm btn-info" type="text">
						<option value="">All Brands</option>
						<option v-for="brand in brands" :key="brand.id" :value="brand">{{ brand.name }}</option>
					</select>
				</div>
			</div>

			<div class="workload-info" v-if="selectedBrand">
				<div class="btn-group bootstrap-select">
					<select v-model="selectedjo" class="selectpicker"  @change="initializeTask" data-style="btn btn-sm btn-info" type="text">   
						<option value="">All JO</option>
						<option v-for="jo in selectedBrand.jos" :key="jo.id" :value="jo.id" >{{ jo.name }}</option>
					</select>
				</div>
			</div>

			<div class="workload-info">
				<p title="Select Board">Task Status:</p>
			</div>

			<div class="workload-info">
				<div class="btn-group bootstrap-select">
					<select v-model="task_status"  @change="filterStatus" class="selectpicker" data-style="btn btn-sm btn-info" type="text">
						<option value="">All</option>
						<option value="Active">Active</option>
						<option value="Overdue">Overdue</option>
						<option value="Completed">Completed</option>
				
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
			brands: [],
			selectedBrand: null,
			selectedjo: '',
			task_status: '',
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
					{
            id: 5,
            label: 'Status',
            value: 'status',
            width: 80
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
		axios.get('/api/onWorkloadCreate')
			.then((response) => {
				// console.log(response);
					this.brands = response.data;
					$(this.$el).find('.selectpicker').selectpicker('refresh');
			})
			.catch((error) => {
				console.error(error);
				
			})
	},
	mounted() {
		$(this.$el).find('.selectpicker').selectpicker('refresh');
	},
	updated() {
		$(this.$el).find('.selectpicker').selectpicker('refresh');
	},
	computed: {
			...mapGetters({
						}),
	},
	methods:{
		initializeTask() {
			this.show = false;
			if(this.filterby == 'byteam') {
				this.selectedBrand = null;
				this.selectedjo = '';
			}
			else {
				this.team = ''
			}
			$(this.$el).find('.selectpicker').selectpicker('refresh');
			// console.log('team:',this.team,'byteam:',this.byteam,'jo:',this.jo,'task_status:',this.task_status);
			
			if(this.filterby == 'bybrand') {
				if(this.selectedBrand) {
					var data = { 
						type: this.filterby,
						team: this.team ,
						brand: this.selectedBrand.id,
						jo: this.selectedjo	
					}
				}
				else {
					var data = { 
						type: this.filterby,
						team: this.team ,
						jo: this.selectedjo	
					}
				}
			}
			else {
				var data = { 
						type: this.filterby,
						team: this.team ,
						jo: this.selectedjo	
				}
			}
			axios.post('/api/testFunc', data) 
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
					if(task.status == 'Completed') {
              task = Object.assign(task, {style : {
                  base: {
                  fill: '#A3CB38',
                  stroke: '#fff'
                  }
              }});
          }

          else if(task.status == 'Overdue') {
              task = Object.assign(task, {style : {
                  base: {
                  fill: '#fc5c65',
                  stroke: '#fff'
                  }
              }});
          }
          
          else if(task.status == 'Due Today' || task.status == 'Due Tomorrow') {
              task = Object.assign(task, {style : {
                  base: {
                  fill: '#ffc048',
                  stroke: '#fff'
                  }
              }});
          }
          
          else if(task.status == 'Active') {
              task = Object.assign(task, {style : {
                  base: {
                  fill: '#45aaf2',
                  stroke: '#fff'
                  }
              }});
          }
					task.start = ''+task.start;
					this.tasks.push(task)
				});
				this.show = true;
				// console.log(this.tasks);
			})
			.catch(error => {
				console.error(error);
			})
		},

		refreshPicker() {
			this.selectedjo = '';
			this.initializeTask();
		},

		filterStatus() {
			// this.tasks = [];
			// this.show = false;
			// this.tasks = [];
			// this.show = false;
			// // this.tasks.forEach((task, index) => {
			// 	// if(task.status != this.task_status) {
			// 	// 	this.tasks.splice(index, 1);
			// 	// }
			// // });
			// this.tasks = [];
			// // this.setTrue();
			// this.show = true;
		},

		setTrue() {
			this.show = true;
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

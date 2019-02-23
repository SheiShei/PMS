<template>
    <transition name="fade">            
        <div class="overlay">
            <div class="close-mod-btn">
                <button @click="$router.go(-1)" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="" @submit.prevent="addTask">
            <div class="newTaskForm" style="">
                <div class="row">
                    <div class="col-md-6">
                        <h4><span class="fa fa-tasks"></span> NEW TASK: </h4>
                    </div>
                    <!-- <div class="col-md-6 text-right">
                        <a href="" @click.prevent="$router.go(-1)" class="btn btn-simple btn-close"><i class="fa fa-close"></i></a> 
                    </div> -->
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Task Name: </label>
                    </div>
                    <div class="col-md-9">
                        <input v-model="taskData.name" required type="text" class=" my-input my-inp-blk">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Desc: </label>
                    </div>
                    <div class="col-md-9">
                        <textarea v-model="taskData.desc" class="my-text-area my-inp-blk" rows="4"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Attach File/s: </label>
                    </div>
                    <div class="col-md-9">
                        <input @change="attachFiles" type="file" class="my-input my-inp-blk" multiple>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6" v-if="boardMembers">
                        <label for="">Assign To: </label>
                        <select required v-model="taskData.assign_to" class="my-input my-inp-blk" >
                            <option value="">Unassign</option>
                            <option v-for="(user) in boardMembers" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-3">
                        <label for="">Points: </label>
                        <input v-model="taskData.points" type="number" class="my-input my-inp-blk" min="0" max="9">
                    </div> -->
                    <div class="col-md-6">
                        <label for="">Due: </label>
                        <!-- <input v-model="taskData.due" type="date" class="my-input my-inp-blk"> -->
                        <date-picker @change="changeDateFormat" v-model="taskData.due" format="YYYY-MM-DD" :not-before="new Date().setDate(new Date().getDate())" :not-after="new Date().setDate(new Date().getDate()+7)" lang="en"></date-picker>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <button @click="$router.go(-1)" class="btn btn-danger btn-block">Cancel</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block">Add to Board</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </transition>
</template>
<script>
import DatePicker from 'vue2-datepicker'
import {mapGetters} from 'vuex';
export default {
    components: {
        DatePicker 
    },
    data() {
        return {
            attachments: [],
            taskData: {
                name: '',
                desc: '',
                points: 1,
                due: '',
                assign_to: ''
            },
        }
    },
    computed: {
        ...mapGetters({
                boardMembers: 'boardMembers',
                usData: 'getCusData'
            }),
    },
    methods: {
        attachFiles(e) {
            let selectedFiles=e.target.files;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                this.attachments.push(selectedFiles[i]);
            }
        },

        addTask() {
            let task = new FormData;
            for(let i=0; i<this.attachments.length;i++){
                task.append('files[]',this.attachments[i]);
            }

            task.append('name',this.taskData.name);
            task.append('due',this.taskData.due);
            task.append('points',this.taskData.points);
            task.append('assign_to',this.taskData.assign_to);
            task.append('desc',this.taskData.desc);
            task.append('sprint_id',this.$route.params.sprint_id);
            task.append('us_id',this.$route.params.us_id);
            task.append('board_id',this.$route.params.board_id);

            this.$store.dispatch('addSprintTask', task)
                .then((response) => {
                    this.$store.commit('addUSSprintTask', response);
                    this.$toaster.success('Task Added succesfully!.')
                    this.$router.push({name: 'test_sprint', params: {board_id: this.$route.params.board_id, sprint_id: this.$route.params.sprint_id}});
                    // let listDiv = document.querySelector('.list-body');
                    // listDiv.scrollTo(0, listDiv.scrollHeight);
                })
        },

        changeDateFormat() {
            // this.taskData.due = new Date(this.taskData.due).toISOString().slice(0, 10).replace('T', ' ');
            this.taskData.due = moment(this.taskData.due).format('YYYY-MM-DD')
        }
        
    }
}
</script>

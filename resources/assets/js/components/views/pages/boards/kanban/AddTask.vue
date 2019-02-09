<template>
    <transition name="fade">            
        <div class="overlay">
            <form action="" @submit.prevent="addTask">
            <div class="newTaskForm" style="">
                <div class="row">
                    <div class="col-md-6">
                        <h4><span class="fa fa-tasks"></span> NEW TASK: </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <router-link :to="{ name: 'kanboard'}" class="btn btn-simple btn-close"><i class="fa fa-close"></i></router-link> 
                    </div>
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
                    <div class="col-md-6" v-if="board">
                        <label for="">Assign To: </label>
                        <select required v-model="taskData.assign_to" class="my-input my-inp-blk" >
                            <option value="">Unassign</option>
                            <option v-for="user in board.bu" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Due: </label>
                        <date-picker @change="changeDateFormat" v-model="taskData.due" format="YYYY-MM-DD" :not-before="new Date().setDate(new Date().getDate()+1)" lang="en"></date-picker>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'kanboard'}" class="btn btn-danger btn-block">Cancel</router-link>
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
import {mapGetters} from 'vuex';
import DatePicker from 'vue2-datepicker'
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
            }
        }
    },
    computed: {
        ...mapGetters({
                board: 'getCBoard'
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
            task.append('list_id',this.$route.params.list_id);
            task.append('board_id',this.$route.params.board_id);

            this.$store.dispatch('addTask', task)
                .then(() => {
                    this.$toaster.warning('Task Added succesfully!.')
                    this.$router.push({name: 'kanboard', params: {board_id: this.$route.params.board_id}});
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

<template>
    <div class="row" id="addtaskdiv">
                            <div class="col-md-12">
                                <div class="card taskcard" v-for="(task, index) in tasks" :key="task.id">
                                    <span class="pull-right" @click="deleteTaskForm(index)" style="cursor:pointer"><i class="fa fa-times"></i></span>
                                    <h5 class="text-gray"><span class="fa fa-tasks"></span> Task #{{index+1}}</h5>
                                    <!-- <div class="card-body"> -->
                                        <div class="form-row">
                                            <div class="col-md-7">
                                                <label for="">Decription </label>
                                                <textarea type="text" v-model="task.name" class="btn-block" placeholder="" ></textarea>
                                                <!-- <label for="">Attach File: </label>
                                                <input class="btn-block" type="file" name="" id="" multiple> -->
                                                    <!-- <input type="text" v-model="task.about" class="form-control" placeholder="About"> -->
                                                <!-- </div> -->
                                            </div>
                                            <div class="col-md-5">
                                                <label for=""><span class="fa fa-user-o"></span> Assign to </label>
                                                <select class="btn-block" name="" id="">
                                                    <option value="">Shooky</option>
                                                    <option value="">Chimmy</option>
                                                    <option value="">RJ</option>
                                                </select>
                                                <label for="" style="margin-top: 8px"><span class="fa fa-file-o"></span> Attach File</label>
                                                <input class="btn-block" type="file" name="" id="" multiple>
                                            </div>
                                        </div>
                                        
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
</template>

<script>
export default {
    data(){
        return{
            tasks: [{
                name: '',
                about: ''
            }]
        }
    },
    methods: {
        addNewTask(){
            this.tasks.push({
                name: '',
                about: ''
            })
            this.scrollToEnd()
        },
        deleteTaskForm(index){
            this.tasks.splice(index,1)
        },
        scrollToEnd(){
            var taskdiv = document.querySelector("#addtaskdiv")
            // var scrollHeight = taskdiv.scrollHeight + 200
            taskdiv.scrollTop = taskdiv.scrollHeight

        }
    },
    // mounted(){
    //     this.scrollToEnd();
    // },
    updated(){
        // scrollToEnd()
    }
}
</script>

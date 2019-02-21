<template>
    <!--VIEW TASK-->
            <transition name="fade">
                <div class="overlay" v-if="usData">
                    <router-view :sprintPermission="sprintPermission" :usPermission="usPermission" :taskPermission="taskPermission"></router-view>
                    <div class="close-mod-btn">
                        <router-link :to="{ name: 'test'}" class="btn btn-simple btn-just-icon btn-default"><i class="fa fa-close"></i></router-link>
                    </div>
                    <!-- <div class="row"> -->
                        <!-- <div class="col-md-12 text-right">
                            <router-link :to="{ name: 'test'}" class="btn btn-simple btn-close"><i class="fa fa-close"></i></router-link>
                        </div> -->
                    <!-- </div> -->
                    <div class="taskView" style="">
                        
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <h4>
                                    <!-- <span class="fa fa-tasks" @click="usPermission.modify ? editUSname = !editUSname : ''"></span> 
                                    <span v-if="!editUSname" @click="usPermission.modify ? editUSname = !editUSname : ''">{{ usData.name }}</span>
                                    <span v-if="editUSname"><input @input="inpdebounce" v-model="usData.name" class="my-input my-inp-blk" style="width: 75%" type="text"></span> -->
                                    <span class="fa fa-list-ul"></span> 
                                    <span>{{ usData.name }} <small class="text-gray">( {{ usData.points }} pts )</small></span>
                                    <!-- <span v-if="editUSname"><input @input="inpdebounce" v-model="usData.name" class="my-input my-inp-blk" style="width: 75%" type="text"></span> -->
                                </h4>

                                <p class="text-success no-margin" v-if="editUSDetails"><small>You're on EDIT MODE</small></p>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                <h4 class="">
                                    <!-- <span class="pull-right"><router-link :to="{ name: 'test'}" class="btn btn-simple btn-close"><i class="fa fa-close"></i></router-link></span>
                                    <span v-if="usPermission.delete" class="pull-right"><a href="" @click.prevent="deleteUS" class="btn btn-simple btn-close" title="Delete This User Story"><i class="fa fa-trash-o"></i></a></span> -->
                                    <span></span>
                                    <!-- <span class=""><router-link :to="{ name: 'test'}" class="btn btn-simple btn-close"><i class="fa fa-close"></i></router-link></span> -->
                                    <span v-if="!editUSDetails"><a href="" @click.prevent="editUSDetails=!editUSDetails" class="btn btn-simple btn-close" title="Edit Details"><span class="fa fa-pencil"></span></a></span>
                                    <span v-else><a href="" @click.prevent="editUSDetails=!editUSDetails" class="btn btn-simple btn-close" title="Save and Close"><span class="fa fa-check text-success"></span></a></span>
                                    <span class=""><a href="" @click.prevent="deleteUS" class="btn btn-simple btn-close" title="Delete This User Story"><i class="fa fa-trash-o"></i></a></span>
                                </h4>
                            </div>
                        </div>
                        <div class="row" v-if="!editUSDetails">
                            <div class="col-md-12">
                                <!-- <h6><b>ABOUT</b></h6>
                                <hr />
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><span @click="usPermission.modify ? editUSpoints = !editUSpoints : ''" class="fa fa-trophy text-warning"></span> <span v-if="!editUSpoints" @click="usPermission.modify ? editUSpoints = !editUSpoints : ''">{{ usData.points }}</span> 
                                            <span v-if="editUSpoints">
                                                <select @change="updateUS" required v-model="usData.points" class="my-input my-inp-blk" style="width: 30%">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="8">8</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="40">40</option>
                                                </select>
                                            </span>  pts</p>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p v-if="!editUSdesc" @click="usPermission.modify ? editUSdesc = !editUSdesc : ''" :style="usData.description ? '' : 'color: #6B808C'" >{{ usData.description ? usData.description : 'Empty space is boring... go on be descriptive...' }}</p>
                                        <p v-else><textarea @input="inpdebounce" @blur="editUSdesc = !editUSdesc" v-model="usData.description" class="my-text-area my-inp-blk" rows="4"></textarea></p>
                                    </div> -->
                                <p>{{ usData.description }}</p>
                            </div>
                        </div>
                        <div class="row" v-if="editUSDetails">
                            <div class="col-md-8">
                                <div class="">
                                    <label for="" class="control-label text-gray">User Story Name:</label>
                                    <input @input="inpdebounce" v-model="usData.name" class="my-input my-inp-blk" type="text">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="" class="control-label">Points:</label>
                                    <select @change="updateUS" required v-model="usData.points" class="my-input my-inp-blk">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>


                                <!-- <input @input="inpdebounce" v-model="usData.name" class="my-input my-inp-blk" style="width: 75%" type="text">
                                <textarea @input="inpdebounce" @blur="editUSdesc = !editUSdesc" v-model="usData.description" class="my-text-area my-inp-blk" rows="4"></textarea>
                                <select @change="updateUS" required v-model="usData.points" class="my-input my-inp-blk" style="width: 30%">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="8">8</option>
                                </select> -->
                            </div>
                        </div>
                        <div class="row" v-if="editUSDetails">
                            <div class="col-md-12">
                                <div class="">
                                    <label for="" class="control-label">Description:</label>
                                    <textarea @input="inpdebounce" @blur="editUSdesc = !editUSdesc" v-model="usData.description" class="my-text-area my-inp-blk" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- <hr/>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="txt-bold no-margin">Subtasks&nbsp;<small v-if="usData.tasks.length">({{ usData.tasks.length }})</small>
                                    <span class=""></span>
                                </h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <a style="cursor: pointer"><router-link :to="{name: 'us_addtask', params: {us_id: $route.params.us_id}}" class="btn-default btn-simple btn-sm"><span class="fa fa-plus"></span> Add Sub-Task</router-link></a>
                            </div>
                        </div> -->


                        <br/> 
                        <div class="row">
                            <div class="col-md-12">

                                <!-- <h6><b>Sub-tasks</b>&nbsp;<small v-if="usData.tasks.length">({{ usData.tasks.length }})</small>
                                    <span class="pull-right"><a style="cursor: pointer"><router-link :to="{name: 'us_addtask', params: {us_id: $route.params.us_id}}" class="btn-default btn-simple btn-sm"><span class="fa fa-plus"></span> Add Sub-Task</router-link></a></span>
                                </h6> -->
                                <!-- <hr /> -->
                                <div class="taskchart shadow brl-gray">
                                    <div class="row">
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <h6 class="nm-top txt-bold">Subtasks&nbsp;<small v-if="usData.tasks.length">({{ usData.tasks.length }})</small>
                                    
                                </h6>
                            </div>
                            <div class="col-md-6 col-xs-6 col-sm-6 text-right">
<!-- <span class="text-right"> -->
                                        <a v-if="taskPermission.add" class="no-margin" style="cursor: pointer" title="Add Subtask"><router-link :to="{name: 'us_addtask', params: {us_id: $route.params.us_id}}" class="btn btn-success btn-xs no-margin">+ Add New</router-link></a>
                                    <!-- </span>                            -->
                                     </div>
                        </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <p v-if="taskPermission.add" style="cursor: pointer"><router-link :to="{name: 'us_addtask', params: {us_id: $route.params.us_id}}" class="btn-default btn-simple btn-sm"><span class="fa fa-plus"></span> Add Sub-Task</router-link></p> -->
                                        <!-- <p style="cursor: pointer"><router-link :to="{name: 'us_addtask', params: {us_id: $route.params.us_id}}" class="btn-default btn-simple btn-sm"><span class="fa fa-plus"></span> Add Sub-Task</router-link></p> -->
                                        <div>
                                            <div class="us-tasks-container">
                                                <div class="us-tasks-wrapper" v-for="task in usData.tasks" :key="task.id">
                                                    <!-- <div class="us-task-name"> -->
                                                        <!-- <ul>
                                                            <li class="us-task-name" style="padding-left: 0; ">
                                                                <router-link v-if="taskPermission.view" :to="{name: 'us_viewtask', params: {task_id: task.id}}" :title="task.name" style="color: #27568e">{{ task.name | taskLength }}</router-link>
                                                                <a v-if="!taskPermission.view" @click.prevent href="" style="color: #27568e">{{ task.name | taskLength }}</a>
                                                            </li>
                                                            
                                                            <li v-if="taskPermission.delete" @click="deleteUStask(task.id)" class="pull-right us-task-del"><span class="fa fa-trash"></span></li> -->
                                                        <!-- <ul> -->
                                                        <router-link :to="{name: 'us_viewtask', params: {task_id: task.id}}" :title="task.name" tag="ul">
                                                            <li class="us-task-name" style="padding-left: 0; ">
                                                                <!-- <span class="fa fa-circle-thin"></span> -->
                                                                <router-link :to="{name: 'us_viewtask', params: {task_id: task.id}}" :title="task.name" ><span class="fa fa-circle"></span> {{ task.name | taskLength }}</router-link></li>
                                                            
                                                            <li @click.stop="deleteUStask(task.id)" class="pull-right us-task-del"><span class="fa fa-trash"></span></li>
                                                            <li class="us-task-assigned pull-right" :title="'Assigned to: ' + task.assigned_to.name">
                                                                <div>
                                                                    <span>
                                                                        <img :src="task.assigned_to.picture" alt="">
                                                                    </span>
                                                                    <p style="font-size: 11px; padding: 0 20px;">{{ task.assigned_to.name | unLength }}</p>
                                                                </div>
                                                            </li>
                                                            
                                                        </router-link>
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <br/>
                            </div>
                        </div>

                    </div>
                </div>
            </transition>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    props: ['usPermission', 'taskPermission', 'sprintPermission'],
    data() {
        return {
            editUSname: false,
            editUSdesc: false,
            editUSpoints: false,
            editUSDetails: false
        }
    },
    created() {
        this.getUSData();
    },
    mounted() {
        this.stopUSEvents();
        this.listenUSEvents();
    },
    filters: {
        taskLength(name) {
            return name.slice(0, 35);
        },
        unLength(un) {
            return un.slice(0, 15);
        }
    },
    computed: {
        ...mapGetters({
                usData: 'getCusData'
            }),
    },
    methods: {
        getUSData() {
            axios.post('/api/getUSData', {us_id: this.$route.params.us_id})
                .then((response) => {
                    // console.log(response);
                    // this.usData = response.data;
                    this.$store.commit('setCusData', response.data);
                })
                .catch((error) => {
                    console.error(error);
                    
                })
        },

        updateUS() {
            let data = {
                name: this.usData.name,
                desc: this.usData.description,
                points: this.usData.points,
                us_id: this.$route.params.us_id,
                board_id: this.$route.params.board_id
            }
            axios.patch('/api/updateUS', data)
                .then((response) => {
                    // console.log(response);
                    this.$store.commit('updateUS', response.data)
                })
                .catch((error) => {
                    console.error(error);
                    
                })
        },
        
        inpdebounce: _.debounce(function(e) {
            this.updateUS()
        }, 1000),

        deleteUStask(id) {
            this.$store.dispatch('deleteSprintTask', {id: id, board_id: this.$route.params.board_id})
                .then((response) => {
                    this.$store.commit('deleteCusTask', response)
                    this.$toaster.warning('Task deleted succesfully!.')
                })
        },

        deleteUS() {
            this.$router.push({name: 'd_conf', params: {us_id: this.usData.id}})
        },

        listenUSEvents() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('DeleteUSEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteUS', e.us_id);
                })
                .listen('DeleteListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteCusTask', e.task_id);
                })
                .listen('UpdateUSEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('setCusData', e.us);
                })
                .listen('AddListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addCusTask', e.task);
                })
        },

        stopUSEvents() {
            Echo.leave('list.'+this.$route.params.board_id)
        }
    }
}
</script>


<style lang="scss" scoped>
// TASK VIEW
   
    .us-tasks-container {
        position: relative;
        white-space: nowrap;
        height: auto;
        display: block;
        width: inherit;
    }
    .us-tasks-container * {
        box-sizing: border-box;
    }
    .us-tasks-wrapper {
        overflow: hidden;
        width: inherit;
    }
    .us-tasks-wrapper > ul {
        // border-left: 2px solid #43A0B9;
        // border-bottom: 1px solid hsla(0,0%,90%,.6);
        // box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        // border: 1px dashed transparent;
        // border-radius: 5px;
        background: #fff;
        margin-right: 2px;
        margin-bottom: 4px!important;
        width: inherit;
        padding: 0 20px;
        transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -webkit-transition: all 0.2s ease-in-out;
    }
    .us-tasks-wrapper > ul:hover {
        // box-shadow: 0 4px 10px 0 rgba(0,0,0,.1);
        // border: 1px solid rgb(212, 212, 212);
        //  border-left: 2px solid rgb(177, 177, 177);
         background-color: rgb(247, 247, 247);
         li > a{
             color: rgb(57, 176, 255);
         }
//   border-right: 2px solid rgb(177, 177, 177);

    }

    .us-tasks-wrapper > ul > li {
        font-size: 13px;
        display: inline-block;
        position: relative;
        line-height: 35px;
        height: 35px;
        color: #4d4d4d;
        vertical-align: middle;
        letter-spacing: .8px;
        list-style: none;
        a{
            color: #6a6c6f;
            transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            -webkit-transition: all 0.2s ease-in-out;
        }
    }

    li.us-task-name {
        // width: 200px;
        overflow: hidden;
    }

    li.us-task-assigned {
        // width: 115px;
        overflow: hidden;
    }

    .us-task-assigned span {
        border-radius: 50%;
        float: left;
        text-align: center;
        height: 20px;
        width: 20px;
        margin-right: 10px;
        color: #6a6c6f;
        font-size: 13px;
    }

    @media  only screen and (max-width: 1172px) {
        .us-task-assigned p {
            display: none;
        }
    }

    @media  only screen and (max-width: 839px) {
        .us-task-assigned, .us-task-del {
            display: none !important;
        }
    }
    
    .us-task-assigned img {
        border-radius: 50%;
        width: 100%!important;
        height: 100%!important;
    }

    .us-task-del > span {
        border-radius: 100px;
        padding: 8px;
    }
    .us-task-del >span:hover {
        background-color: #cecccc;
    }
</style>

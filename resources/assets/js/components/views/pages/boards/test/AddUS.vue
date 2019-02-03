<template>
    <transition name="fade">            
        <div class="overlay">
            <form action="" @submit.prevent="addUS">
            <div class="newTaskForm" style="">
                <div class="row">
                    <div class="col-md-6">
                        <h4><span class="fa fa-tasks"></span> Add User Story: </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <router-link :to="{ name: 'test'}" class="btn btn-simple btn-close"><i class="fa fa-close"></i></router-link> 
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <label for="nus">Name</label>
                            <input v-model="us.name" required id="nus" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <label for="dus">Description</label>
                            <textarea v-model="us.desc" required id="dus" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Points</label>
                            <select  v-model="us.points" required class="form-control" id="exampleFormControlSelect1">
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
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'test'}" class="btn btn-danger btn-block">Cancel</router-link>
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
export default {
    data() {
        return {
            us: {
                name: '',
                desc: '',
                points: '1'
            }
        }
    },
    computed: {
        ...mapGetters({
            }),
    },
    methods: {
        addUS() {
            this.us.sprint_id = this.$route.params.sprint_id;
            this.$store.dispatch('newUS', this.us)
                .then(() => {
                    // alert('Success')
                    this.$router.push({name: 'test'});
                })
        }
    }
}
</script>
<template>
    <transition name="fade">            
        <div class="overlay">
            <form action="" @submit.prevent="newsprint">
            <div class="newTaskForm" style="">
                <div class="row">
                    <div class="col-md-6">
                        <h4><span class="fa fa-tasks"></span> New Sprint: </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <router-link :to="{ name: 'scrumboard', params: {board_id: $route.params.board_id}}" class="btn btn-simple btn-close"><i class="fa fa-close"></i></router-link> 
                    </div>
                </div>
                <br />
                <div class="row">
                    <!-- <div class="col-md-3">
                        <label for="">Sprint Name: </label>
                    </div> -->
                    <div class="col-md-12">
                        <input v-model="name" placeholder="Sprint Name" required type="text" class=" my-input my-inp-blk">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                        <label for="">from: </label>
                        <input v-model="now" type="date" class="my-input my-inp-blk">
                    </div>
                    <div class="col-md-6">
                        <label for="">to: </label>
                        <input v-model="plus" type="date" class="my-input my-inp-blk">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'scrumboard', params: {board_id: $route.params.board_id}}" class="btn btn-danger btn-block">Cancel</router-link>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block">Create</button>
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
            now: (new Date).toISOString().slice(0,10),
            plus: new Date,
            name: ''
        }
    },

    mounted() {
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }

        this.plus = this.plus.addDays(30).toISOString().slice(0,10);
    },

    computed: {
        ...mapGetters({
                scrumLists: 'getScrumLists',
            }),
    },

    methods: {
        newsprint() {
            let data = {
                id: this.$route.params.board_id,
                name: this.name,
                start: this.now,
                end: this.plus
            }
            this.$router.push({name: 'scrumboard', params: {board_id: this.$route.params.board_id}});
            this.$store.dispatch('addsprint', data)
                .then(() => {
                    this.$toaster.success('Sprint Created succesfully!.');
                })
        },
    }
}
</script>

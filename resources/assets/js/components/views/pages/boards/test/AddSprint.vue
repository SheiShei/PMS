<template>
    <transition name="fade">            
        <div class="overlay">
            <div class="close-mod-btn">
                <router-link :to="{ name: 'test', params: {board_id: $route.params.board_id}}" class="btn btn-simple btn-just-icon btn-default"><i class="fa fa-close"></i></router-link>
            </div>
            <form action="" @submit.prevent="newsprint">
            <div class="newTaskForm" style="">
                <div class="row">
                    <div class="col-md-12">
                        <h4><span class="fa fa-refresh"></span> New Sprint</h4>
                        <hr/>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-3">
                        <label for="">Sprint Name: </label>
                    </div> -->
                    <div class="col-md-12">
                        <label for="sprntnm" class="control-label">Sprint Name:</label>
                        <input id="sprntnm" v-model="name" oninvalid="this.setCustomValidity('Sprint Name is required!')" oninput="this.setCustomValidity('')" pattern="^((?!Backlog).)*$" required type="text" class="my-input my-inp-blk">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        <label for="sprntgls" class="control-label">Sprint Goals (optional):</label>
                        <textarea id="sprntgls" v-model="goals" class="my-text-area my-inp-blk" placeholder="Describe what should be achieved at the end of this Sprint" rows="3"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        <label for="sprntintrvl">Sprint Interval &nbsp;</label>
                        <date-picker id="sprntintrvl" v-model="interval" range lang="en" format="YYYY-MM-DD" :not-before="new Date()" :not-after="new Date().setDate(new Date().getDate()+30)" confirm @input="handleIntervalChange"></date-picker>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'test', params: {board_id: $route.params.board_id}}" class="btn btn-danger btn-block">Cancel</router-link>
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
import DatePicker from 'vue2-datepicker'
import {mapGetters} from 'vuex';
export default {
    components: {
        DatePicker 
    },
    data() {
        return {
            name: '',
            goals: '',
            interval: '',
            // custom lang
            lang: {
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
                placeholder: {
                date: 'Select Date',
                dateRange: 'Select Date Range'
                }
            },
        }
    },

    mounted() {
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }

        let plus = new Date;

        this.interval = [new Date, new Date(String(plus.addDays(14).toISOString().slice(0,10)))];
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
                goals: this.goals,
                start: this.now,
                end: this.plus,
                interval: this.interval
            }
            this.$router.push({name: 'test', params: {board_id: this.$route.params.board_id}});
            this.$store.dispatch('addsprint', data)
                .then(() => {
                    this.$toaster.success('Sprint Created succesfully!.');
                })
        },
        handleIntervalChange() {
            console.log(this.interval);
            
        }
    }
}
</script>
<style lang="scss" scoped>
.mx-datepicker{
    width: 100%;
}
</style>

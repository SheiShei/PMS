<template>
    <div class="table-responsive" style="margin-top: 10px; max-height: 65vh; overflow:auto">
        <table class="table table-bordered table-brands">
            <thead>
                <tr>
                    <th class="">Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date Created</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody is="transition-group" name="list-complete">
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
import _ from 'lodash'
export default {

    props: ['data'],
    data() {
        return {
            
        }
    },

    methods: {
        getUsersData() {
            let data = this.data
            this.$store.dispatch('setUsers', data);
        },

        search: _.debounce(function (e) {
            this.getUsersData();
        }, 500),
    }
}
</script>

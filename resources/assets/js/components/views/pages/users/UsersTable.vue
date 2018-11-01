<template>
    <div class="mybox-body white-white-bg">
        <!-- top -->
        <div class="row">
            <div class="col-md-6">
                <span>Filter role:</span>
                <select v-model="data.filter" @change="getUsersData" class="my-input" name="" id="">
                    <option value="">All</option>
                    <option value="admin">Admin</option>
                    <option value="acma">ACMA</option>
                    <option value="employee">Employee</option>
                    <option value="client">Client</option>
                </select>
            </div>
            <div class="col-md-6 text-right">
                <input @input="search()" v-model="data.search" type="search" class="my-input" placeholder="Search...">
                <span class="fa fa-search"></span>
            </div>
        </div>
        <!-- end of top -->

        <!-- table -->
        <div class="table-responsive" style="margin-top: 10px; max-height: 65vh; overflow:auto">
            <table class="table table-bordered table-brands">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="">Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Date Created</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody >
                    <slot></slot>
                </tbody>
            </table>
        </div>
        <!-- end of table -->
    </div>
</template>

<script>
import {mapActions} from 'vuex';
import _ from 'lodash'
export default {
    data() {
        return {
            data: {
                filter: '',
                search: '',
            }
        }
    },

    methods: {
        getUsersData() {
            let data = this.data
            this.$store.dispatch('setUsers', {url : '/api/shittycaptivateusers', data});
        },

        search: _.debounce(function (e) {
            this.getUsersData();
        }, 500),
    }
}
</script>

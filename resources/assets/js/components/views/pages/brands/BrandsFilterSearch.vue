<template>
    <div class="mybox-body">
        <div class="row">
            <div class="col-md-6">
                <span>Sort by:</span>
                <select v-model="data.filter" @change="getsData()" class="my-input" name="" id="">
                    <!-- <option disabled="" value="" selected="">--Select--</option> -->
                    <option v-bind:value="{position: 'asc', category:'name'}">Name (A - Z)</option>
                    <option v-bind:value="{position: 'desc', category:'name'}">Name (Z - A)</option>
                    <option v-if="data.notArchive" v-bind:value="{position: 'asc', category:'created_at'}">Date (Ascending)</option>
                    <option v-if="data.notArchive" v-bind:value="{position: 'desc', category:'created_at'}">Date (Descending)</option>
                    <option v-if="!data.notArchive" v-bind:value="{position: 'asc', category:'deleted_at'}">Deleted (Ascending)</option>
                    <option v-if="!data.notArchive" v-bind:value="{position: 'desc', category:'deleted_at'}">Deleted (Descending)</option>
                </select>
            </div>
            <div class="col-md-6 text-right">
                <input @input="search()" v-model="data.search" type="search" class="my-input" placeholder="Search...">
                <span class="fa fa-search"></span>
            </div>
        </div>
                    
        <div class="table-responsive" style="margin-top: 10px; max-height: 35vh; overflow:auto">
            <table class="table table-bordered table-brands">
                <thead>
                    <th>Brand Name</th>
                    <th>Date Added</th>
                    <th>Total JO</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                   <slot></slot>
                </tbody>
            </table>
        </div> 
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
         getsData() {
          let data = this.data
            this.$store.dispatch('setBrands', {url : '/api/getbrands', data});
       
        },
        search: _.debounce(function (e) {
            this.getsData();
        }, 500),
    }
}
</script>

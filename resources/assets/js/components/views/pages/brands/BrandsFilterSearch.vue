<template>
    <div class="table-responsive" style="margin-top: 10px; max-height: 35vh; overflow:auto">
        <table class="table table-bordered table-brands">
            <thead>
                <tr>
                    <th>Brand Name</th>
                    <th>Logo</th>
                    <th>Date Added</th>
                    <th>Total JO</th>
                    <th>Total Workbook</th>
                    <th>Actions</th>
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

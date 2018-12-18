<template>
    <section class="main-main-container" style="" v-if="jos && cUser">
        <div class="title-head">
            <h2><span class="fa fa-copy"></span> Job Orders <small>List</small></h2>
        </div>
        <div class="col-md-9">
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>JOB ORDERS LIST</strong></h6>
                </div>
                <div class="mybox-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <span>Sort by:</span>
                                <select @change="searched" v-model="sort" class="my-input">
                                    <option value="created_at.desc">Date (Descending)</option>
                                    <option value="created_at.asc">Date (Ascending)</option>
                                    <option value="name.asc">Name (Ascending)</option>
                                    <option value="name.desc">Name (Descending)</option>
                                </select>
                            </div>
                            <div class="col-md-6 text-right">
                                <input v-model="search" @input="searched" type="search" class="my-input" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive" style="margin-top: 10px; height: 60vh; overflow:auto">
                        <table class="table table-bordered table-brands">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center">ID</th> -->
                                    <th class="">Date Created</th>
                                    <th>Title</th>
                                    <th>Team</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="height: 10vh; overflow:auto">
                                <tr v-for="jo in jos" :key="jo.id">
                                    <!-- <td class="text-center">{{ jo.id }}</td> -->
                                    <td>{{ jo.created_at }}</td>
                                    <td>{{ jo.name }}</td>
                                    <td v-if="jo.type == 1">Creatives</td>
                                    <td v-if="jo.type == 2">Web</td>
                                    <td>{{ jo.brand.name }}</td>
                                    <td>
                                        <span v-if="jo.status == 1" class="label label-warning">Active</span>
                                        <span v-if="jo.status == 2" class="label label-success">Completed</span>
                                        <span v-if="jo.status == 3" class="label label-danger">Blocked</span>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button @click="view(jo.id, jo.type)" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <!-- <button @click="update(jo.id, jo.type)" type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button> -->
                                        <button v-if="jo.created_by == cUser.id" @click="deleteJO(jo.id)" type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mybox-footer">

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>NEW JOB ORDER</strong></h6>
                </div>
                <div class="mybox-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="note">Select a JO type to create a new Job Order form.</p>
                            <router-link :to="{name: 'new_jo_web'}" class="btn btn-sm btn-info btn-md full-btn">+ Create New Web JO</router-link>
                            <router-link :to="{name: 'new_jo_creative'}" class="btn btn-sm btn-info btn-md full-btn">+ Create New Creatives JO</router-link>
                        </div>
                                    
                    </div> 
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
    .userslist{
        justify-content: space-evenly;
    }
    .userlist-ft{
        justify-content: center !important;
    }
    .ul-item{
        display: inline-block !important;
    }
    .ul-item > input span {
        display: block !important;
    }
    .full-btn{
        width: 100%;
    }
</style>

<script>
import {mapGetters} from 'vuex';
export default {
    data() {
        return {
            search: '',
            sort: 'created_at.desc'
        }
    },
    computed: {
        ...mapGetters({
                jos: 'getJOs',
                cUser: 'currentUser'
            }),
    },
    created() {
        const data = {
            search: '',
            sort: 'created_at.desc'
        }
        this.$store.dispatch('getJobOrders', data);
    },

    methods: {
        view(id, type) {
            if(type == 1) {
                this.$router.push({name: 'viewjocreative', params: {jo_id: id}});
            }
            else{
                this.$router.push({name: 'viewjoweb', params: {jo_id: id}});
            }
        },

        // update(id, type) {
        //     if(type == 1) {
        //         this.$router.push({name: 'updatecrea', params: {jo_id: id}});
        //     }
        //     else{
        //         this.$router.push({name: 'updateweb', params: {jo_id: id}});
        //     }
        // },

        deleteJO(id) {
            let _this = this;
            this.$store.dispatch('deleteJO', id)
                .then ((response) => {
                    _this.$toaster.warning('JO Deleted!.')
                })
        },

        searched: _.debounce(function (e) {
            this.$store.dispatch('getJobOrders', {search: this.search, sort: this.sort});
            // console.log('shei');
            
        }, 500),
    }
}
</script>



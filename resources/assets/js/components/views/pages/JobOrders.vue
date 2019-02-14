<template>
    <section class="main-main-container" style="" v-if="jos && cUser">
        <div class="title-head">
            <h2><span class="fa fa-copy"></span> Job Orders</h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-9">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="nm-top"><span class="txt-bold"> <span class="fa fa-copy text-info"></span> JOB ORDERS LIST</span>
                                    | <span><small>| <a @click.prevent="archiveJO" href="">Archive</a></small></span></h6>
                                </div>
                                <div class="col-md-8 text-right">
                                    <select @change="searched" v-model="data.sort" class="my-thin-select">
                                        <option value="name.asc">Name (Ascending)</option>
                                        <option value="name.desc">Name (Descending)</option>
                                        <option v-if="data.notArchive" value="created_at.desc">Date (Descending)</option>
                                        <option v-if="!data.notArchive" value="deleted_at.desc">Deleted (Descending)</option>
                                        <option v-if="data.notArchive" value="created_at.asc">Date (Ascending)</option>
                                        <option v-if="!data.notArchive" value="deleted_at.asc">Deleted (Ascending)</option>
                                    </select>
                                    <input v-model="data.search" @input="searched" type="search" class="my-thin-input" placeholder="Search...">
                                    &nbsp;&nbsp;<span class="fa fa-search text-gray"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive" style="margin-top: 10px;">
                                        <table class="table table-bordered table-brands">
                                            <thead>
                                                <tr>
                                                    <th class="">Date Created</th>
                                                    <th>Title</th>
                                                    <th>Team</th>
                                                    <th>Brand</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody name="list-complete" is="transition-group">
                                                <tr v-for="jo in jos" :key="jo.id" class="list-complete-item">
                                                    <td>{{ jo.created_at }}</td>
                                                    <td>{{ jo.name }}</td>
                                                    <td v-if="jo.type == 1">Creatives</td>
                                                    <td v-if="jo.type == 2">Web</td>
                                                    <td>{{ jo.brand.name }}</td>
                                                    <td>
                                                        <span v-if="jo.status == 1" class="label label-info">Active</span>
                                                        <span v-if="jo.status == 2" class="label label-success">Completed</span>
                                                        <span v-if="jo.status == 3" class="label label-danger">Blocked</span>
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <button @click="view(jo.id, jo.type)" v-if="data.notArchive" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- <button @click="update(jo.id, jo.type)" type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button> -->
                                                        <button v-if="jo.created_by == cUser.id && data.notArchive" @click="deleteJO(jo.id)" type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                        <button v-if="!data.notArchive" type="button" rel="tooltip" @click="restoreJO(jo.id)" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Restore">
                                                            <i class="fa fa-refresh"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-3">
                        <div class="taskchart shadow">
                            <p class="txt-bold nm-top"><span class="fa fa-plus-square-o text-info"></span> Create New Job Order</p>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="note">Select a JO type to create new Job Order form.</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <router-link :to="{name: 'new_jo_web'}" type="button" rel="tooltip" class="btn btn-info btn-md btn-block">
                                                Web JO
                                            </router-link>
                                        </div>
                                        <div class="col-md-12">
                                            <router-link :to="{name: 'new_jo_creative'}" type="button" rel="tooltip" class="btn btn-info btn-md btn-block">
                                                Creatives JO
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div> 
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
// import JOfilter from "./joborders/JOfilter.vue";

export default {
    // components:{
    //     JOfilter: JOfilter
    // },
    data() {
        return {
        data:{
            sort: 'created_at.desc',
            search: '',
            notArchive: true
        }
        }
    },
    computed: {
        ...mapGetters({
                jos: 'getJOs',
                cUser: 'currentUser'
            }),
    },
    created() {
        const data = this.data;
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


        deleteJO(id) {
            let _this = this;
            this.$store.dispatch('deleteJO', id)
                .then ((response) => {
                    _this.$toaster.warning('JO Deleted!.')
                })
        },

        archiveJO() {
           // let _this = this;
            this.data.notArchive = !this.data.notArchive;
            if(this.data.notArchive==true){ this.data.sort = 'created_at.desc' }
            else{ this.data.sort = 'deleted_at.desc'};
            let data = this.data;
            this.$store.dispatch('getJobOrders', data); 
            console.log('archive');
                   },

        restoreJO(id) {
            this.$store.dispatch('restoreJO', id)
                .then(() => {
                    this.$toaster.success('Job Order restored succesfully!.')
                })
                .catch(() => {
                    alert('Something went wrong, try reloading the page');
                })
        },
        searched: _.debounce(function (e) {
            this.$store.dispatch('getJobOrders', {search: this.data.search, sort: this.data.sort, notArchive: this.data.notArchive});
            // console.log('shei');
            
        }, 500),

       
    }
}
</script>



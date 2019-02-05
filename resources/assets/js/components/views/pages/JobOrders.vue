<template>
    <section class="main-main-container" style="" v-if="jos && cUser">
        <div class="title-head">
            <h2><span class="fa fa-copy"></span> Job Orders</h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="nm-top"><span class="txt-bold"> <span class="fa fa-copy"></span> JOB ORDERS LIST</span></h6>
                                </div>
                                <div class="col-md-8 text-right">
                                    <select @change="searched" v-model="sort" class="my-input my-thin-select">
                                        <option value="created_at.desc">Date (Descending)</option>
                                        <option value="created_at.asc">Date (Ascending)</option>
                                        <option value="name.asc">Name (Ascending)</option>
                                        <option value="name.desc">Name (Descending)</option>
                                    </select>
                                    <input v-model="search" @input="searched" type="search" class="my-thin-input" placeholder="Search...">
                                    &nbsp;&nbsp;<span class="fa fa-search text-gray"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive mt-4" style="margin-top: 10px; max-height: 60vh; overflow:auto">
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
                                            <tbody style="height: 10vh; overflow:auto" is="transition-group" name="list-complete">
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
                                                        <button @click="view(jo.id, jo.type)" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button v-if="jo.created_by == cUser.id" @click="deleteJO(jo.id)" type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="no-margin txt-bold"><span class="fa fa-plus-square-o text-info"></span> Create New Job Order</p>
                                    <hr/>
                                    <p class="note">Select a JO type to create new Job Order form.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link :to="{name: 'new_jo_web'}" class="btn btn-sm btn-info btn-md full-btn">Web JO</router-link>
                                </div>
                                <div class="col-md-6">
                                    <router-link :to="{name: 'new_jo_creative'}" class="btn btn-sm btn-info btn-md full-btn">Creatives JO</router-link>
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



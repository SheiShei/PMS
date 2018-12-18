<template>
   <section class="main-main-container" style="">
    <div class="title-head">
        <h2><span class="fa fa-briefcase"></span> Brand's Profile <small></small></h2>
    </div>

        <div class="col-md-3">
            <div class="mybox">
               
                <div class="mybox-body white-white-bg">
                    <div class="br-prof text-center">
                        <p  class="info-name">{{brandProfile.name}}</p>
                        <img style="height: 60px; margin-bottom: 5px;" :alt="brandProfile.name+' logo'" :src="'./images/logo/'+brandProfile.logo">
                    </div>
                    <hr />
                    <p class="other-info"><span class="">Brand Owner: </span>{{brandProfile.tandem.name}}</p>
                    <p class="other-info"><span>Client: </span>{{brandProfile.contact_person}}</p>
                    <p class="other-info"><span>Telephone: </span>{{brandProfile.telephone}}</p>
                    <p class="other-info"><span>Mobile: </span>{{brandProfile.mobile}}</p>
                    <p class="other-info"><span>Description: </span>{{brandProfile.about}}</p>
                </div>
                <div class="mybox-footer text-center">
                    <button class="btn btn-info btn-sm full-btn"><span class="fa fa-book"></span> View Workbook</button>
                </div>
            </div>
        </div>

         <div class="col-md-9" v-if="brandJOs">
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>OVERVIEW</strong></h6>
                </div>
                <div class="mybox-body white-white-bg">
                    <h6><strong>JOB ORDERS</strong></h6>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Sort by:</span>
                            <select @change="getBrandJOs" v-model="jofilter" class="my-input">
                                <option value="created_at.desc">Date (Descending)</option>
                                <option value="created_at.asc">Date (Ascending)</option>
                                <option value="name.asc">Name (Ascending)</option>
                                <option value="name.desc">Name (Descending)</option>
                            </select>
                        </div>
                        <div class="col-md-6 text-right">
                            <input @input="searched" v-model="josearch" type="search" class="my-input" placeholder="Search...">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin-top: 10px; max-height: 30vh; overflow:auto">
                        <table class="table table-bordered table-brands">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center">ID</th> -->
                                    <th class="">Date Created</th>
                                    <th>Title</th>
                                    <th>Team</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="height: 10vh; overflow:auto">
                                <tr v-for="jo in brandJOs" :key="jo.id">
                                    <!-- <td class="text-center">1</td> -->
                                    <td>{{ jo.created_at }}</td>
                                    <td>{{ jo.name }}</td>
                                    <td v-if="jo.type == 1">Creatives</td>
                                    <td v-if="jo.type == 2">Web</td>
                                    <td>
                                        <span v-if="jo.status == 1" class="label label-warning">Active</span>
                                        <span v-if="jo.status == 2" class="label label-success">Completed</span>
                                        <span v-if="jo.status == 3" class="label label-danger">Blocked</span>
                                    </td>
                                    <td class="td-actions text-right" v-if="cUser">
                                        <button @click="view(jo.id, jo.type)" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <!-- <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
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
                    <hr />
                    <h6><strong>HISTORY of ACTIVITIES</strong></h6>
                </div>
                <div class="mybox-footer">
                </div>
            </div>
        </div>
</section>
</template>

<style scoped>
.br-prof > img h5{
    display: inline-block;
    position: inline-block;
}
.other-info{
    font-size: 13px;
}
.other-info > span{
    font-weight: bold;
}
.info-name{
    font-weight: bold;
    font-size: 13px;
}
.full-btn{
    width: 100%;
}
</style>

<script>
import {mapGetters} from 'vuex';

export default {
    data () {
        return {
            id: this.$route.params.brandId,
            josearch: '',
            jofilter: 'created_at.desc',
            brandJOs: null
        }
    },
    created() {
        // this.data.id = this.$route.params.brandId;
        let data = this.data;
        this.$store.dispatch('getOnebrand',this.id)
            .then (() => {
                this.getBrandJOs()
            }) 
    },
    computed: {
        ...mapGetters({
                brandProfile: 'getOnebrand',
                cUser: 'currentUser'
            }),
    },
    methods: {
        getBrandJOs() {
            let data = {
                id: this.$route.params.brandId,
                search: this.josearch,
                sort: this.jofilter
            }
            this.$store.dispatch('brandJos', data)
                .then (response => {
                    this.brandJOs = response
                })
        },

        searched: _.debounce(function (e) {
            this.getBrandJOs();
        }, 500),

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
            this.$store.dispatch('deleteBrandJo', id)
                .then (() => {
                    _this.$toaster.warning('JO Deleted!.')
                })
        },
    }

    
}
</script>
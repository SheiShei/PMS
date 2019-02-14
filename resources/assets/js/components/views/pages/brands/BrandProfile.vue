<template>
<section class="main-main-container" style="">
    <div class="title-head">
        <h2><span class="fa fa-briefcase"></span> Brand's Profile <small></small></h2>
    </div>
    <div class="container-fluid">
        <div class="main2">
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="taskchart shadow" v-if="brandProfile">
                        <p class="txt-bold no-margin">{{brandProfile.name}}</p>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img class="text-center img-raised" style="max-width: 50%; margin: 10px auto" :alt="brandProfile.name+' logo'" :src="brandProfile.logo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="note">{{brandProfile.about}}</p>
                                <br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p><small><span class="fa fa-user-o"></span> Brand Owner: </small></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <p>{{brandProfile.acma.name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p><small><span class="fa fa-address-book-o"></span> Contact Person:</small></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <p>{{brandProfile.contact_person}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p><small><span class="fa fa-phone"></span> Telephone:</small></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <p>{{brandProfile.telephone}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p><small><span class="fa fa-mobile"></span> Mobile:</small></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <p>{{brandProfile.mobile}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="taskchart shadow" v-if="brandJOs">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="nm-top"><span class="txt-bold"> <span class="fa fa-copy text-info"></span> JOB ORDERS LIST</span></h6>
                            </div>
                            <div class="col-md-8 text-right">
                                <select @change="getBrandJOs" v-model="jofilter" class="my-input my-thin-select">
                                    <option value="created_at.desc">Date (Descending)</option>
                                    <option value="created_at.asc">Date (Ascending)</option>
                                    <option value="name.asc">Name (Ascending)</option>
                                    <option value="name.desc">Name (Descending)</option>
                                </select>
                                <input @input="searched" v-model="josearch" type="search" class="my-thin-input" placeholder="Search...">
                                &nbsp;&nbsp;<span class="fa fa-search text-gray"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" style="margin-top: 10px; max-height: 30vh; overflow:auto">
                                    <table class="table table-bordered table-brands">
                                        <thead>
                                            <tr>
                                                <th class="">Date Created</th>
                                                <th>Title</th>
                                                <th>Team</th>
                                                <th>Status</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody name="list-complete" is="transition-group" style="height: 10vh; overflow:auto">
                                            <tr v-for="jo in brandJOs" :key="jo.id" class="list-complete-item">
                                                <td>{{ jo.created_at }}</td>
                                                <td>{{ jo.name }}</td>
                                                <td v-if="jo.type == 1">Creatives</td>
                                                <td v-if="jo.type == 2">Web</td>
                                                <td>
                                                    <span v-if="jo.status == 1" class="label label-info">Active</span>
                                                    <span v-if="jo.status == 2" class="label label-success">Completed</span>
                                                    <span v-if="jo.status == 3" class="label label-danger">Blocked</span>
                                                </td>
                                                <td class="td-actions text-right" v-if="cUser">
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
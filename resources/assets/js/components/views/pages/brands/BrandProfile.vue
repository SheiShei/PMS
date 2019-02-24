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
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" v-if="cUser.role.id == 2">
                                <router-link :to="{name: 'add_workbook'}" class="btn btn-success btn-md btn-block">Create New Workbook</router-link>
                            </div>
                        </div>
                    </div>
                    <br/>
                </div>
                <div class="col-md-8">
                    <div class="taskchart shadow" v-if="brandJOs">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="nm-top"><span class="txt-bold"> <span class="fa fa-copy text-info"></span> JOB ORDERS LIST</span>
                                | <span><small> <a @click.prevent="archiveJO" href="">Archive</a></small></span></h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <router-link :to="{name: 'new_jo_web'}" type="button" rel="tooltip" class="btn btn-info btn-xs">
                                    New Web JO
                                </router-link>
                                <router-link :to="{name: 'new_jo_creative'}" type="button" rel="tooltip" class="btn btn-info btn-xs">
                                    New Creatives JO
                                </router-link>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <select @change="getBrandJOs" v-model="jofilter" class="my-input my-thin-select">
                                    <option v-if="notArchive" value="created_at.desc">Date (Descending)</option>
                                    <option v-if="!notArchive" value="deleted_at.desc">Date Deleted (Descending)</option>
                                    <option v-if="notArchive" value="created_at.asc">Date (Ascending)</option>
                                    <option v-if="!notArchive" value="deleted_at.asc">Date Deleted (Ascending)</option>
                                    <option value="name.asc">Name (Ascending)</option>
                                    <option value="name.desc">Name (Descending)</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                                <input @input="searched" v-model="josearch" type="search" class="my-thin-input" placeholder="Search...">
                                &nbsp;&nbsp;<span class="fa fa-search text-gray"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <div class="table-responsive" style="margin-top: 10px; max-height: 30vh; overflow:auto"> -->
                                <div class="v2-table" style="margin-top: 10px;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th class="">Date Due</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody name="list-complete" is="transition-group" style="height: 10vh; overflow:auto">
                                            <tr v-for="jo in brandJOs" :key="jo.id" class="list-complete-item">
                                                <td><span class="fa fa-copy"></span>&nbsp;{{ jo.name }}</td>
                                                <td><span class="fa fa-clock-o text-gray"></span>&nbsp;{{ jo.duedate }}</td>
                                                <td v-if="jo.type == 1">Creatives</td>
                                                <td v-if="jo.type == 2">Web</td>
                                                <td>
                                                    <span v-if="jo.status == 1" class="label label-info">Active</span>
                                                    <span v-if="jo.status == 2" class="label label-danger">Overdue</span>
                                                    <span v-if="jo.status == 3" class="label label-warning">Pending</span>
                                                    <span v-if="jo.status == 4" class="label label-success">Completed</span>
                                                </td>
                                                <td class="td-actions text-right" v-if="cUser">
                                                    <button v-if="(jo.created_by == cUser.id || cUser.role.id == 1) && notArchive" @click="view(jo.id, jo.type)" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button v-if="(jo.created_by == cUser.id || cUser.role.id == 1) && notArchive" @click="deleteJO(jo.id)" type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                    <button v-if="(jo.created_by == cUser.id || cUser.role.id == 1) && !notArchive" @click="restoreJO(jo.id)" type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p v-if="brandJOs==0" class="note">No Job Order to show</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br/>

                    <div class="taskchart shadow" v-if="brandJOs">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="nm-top"><strong><span class="fa fa-book"></span> Workbooks</strong>&nbsp;<span><small>| <a @click.prevent="changeArchive" href="">Archive</a></small></span></h6>
                                <hr/>
                            </div>
                            <div class="col-md-8 text-right">
                                    <select @change="getAllWorkbooks" v-model="data.status" class="my-input my-thin-select" name="" id="">
                                        <option value="" selected>Reviewed & For Review</option>
                                        <option value="reviewed">Reviewed</option>
                                        <option value="for_reviewed">For Review</option>
                                    </select>
                                    <input @input="searchDeb" v-model="data.search" type="search" class="my-input my-thin-input" placeholder="Search...">
                                    &nbsp;<span class="fa fa-search text-default"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p v-if="brandProfile.workbooks==0" class="note">No Workbook to show</p>
                                <div style="max-height: 30vh; overflow-y: auto">
                                        <div class="torev2" v-for="workbook in brandProfile.workbooks" :key="workbook.id">
                                            <a href="" @click.prevent="$router.push({name:'review_workbook', params: {wb_id: workbook.id}})" class="torev2">
                                                <div class="torevdiv2">
                                                    <div class="torev-left">
                                                        <div class="torev-icon">
                                                            <i alt="" class="fa fa-book medium-avatar"></i>
                                                        </div>
                                                    </div>  
                                                    <div class="torev-right">
                                                        <h6 class="wb-title txt-bold"><a>{{ workbook.name }}</a> <span v-if="workbook.reviewed_at" title="Reviewed by Client" class="fa fa-check-circle text-success"></span></h6> 
                                                        <p><small>by: {{ workbook.created_by.name }} . {{ workbook.created_at | moment('ll') }} . {{ workbook.brand.name }}</small></p>
                                                        <p v-if="workbook.reviewed_at" class="no-margin"><small>
                                                            <fa-rating :glyph="star"
                                                                :read-only="true"
                                                                :item-size="12" 
                                                                :spacing="3"  
                                                                inactive-color="#e2e2e2" 
                                                                active-color="#ffc815"
                                                                :border-width=2
                                                                border-color="#fff"
                                                                :increment="0.01"
                                                                v-model="workbook.overall_rating"
                                                                >
                                                            </fa-rating>
                                                        </small></p>
                                                        <p v-if="data.isArchive" class="hidden-lg hidden-md"><span><a @click.stop="rWB(workbook.id)" href="#child" class="btn btn-info btn-simple btn-xs">Restore</a></span></p>
                                                        <p v-else class="hidden-lg hidden-md"><span><a @click.stop="dWB(workbook.id)" href="#child" class="btn btn-danger btn-simple btn-xs">Archive</a></span></p>
                                                    </div>
                                                    <div class="very-right hidden-sm hidden-xs text-right">
                                                        <a v-if="data.isArchive" @click.stop="rWB(workbook.id)" href="#child" title="Archive" class="btn btn-info btn-simple btn-xs">
                                                            <span class="fa fa-undo"></span> Restore
                                                        </a>
                                                        <a v-else @click.stop="dWB(workbook.id)" href="#child" title="Archive" class="btn btn-danger btn-simple btn-xs">
                                                            <span class="fa fa-trash-o"></span> Archive
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
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
import {StarRating} from 'vue-rate-it';
import {HeartRating} from 'vue-rate-it';
import {FaRating} from 'vue-rate-it';
import {ImageRating} from 'vue-rate-it';
import Star from 'vue-rate-it/glyphs/star';
export default {
    components:{
        StarRating,
        HeartRating,
        FaRating
    },
    data () {
        return {
            id: this.$route.params.brandId,
            josearch: '',
            jofilter: 'created_at.desc',
            notArchive: true,
            brandJOs: null,
            data: {
                search: '',
                brand: this.$route.params.brandId,
                status: '',
                isArchive: false
            },
        }
    },
    created() {
        // this.data.id = this.$route.params.brandId;
        this.star = Star
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
                sort: this.jofilter,
                notArchive: this.notArchive
            }
            this.$store.dispatch('brandJos', data)
                .then (response => {
                    this.brandJOs = response
                })
        },
        archiveJO() {
           // let _this = this;
            this.notArchive = !this.notArchive;
            if(this.notArchive==false){
            this.jofilter= 'deleted_at.desc';
            }
            else{
            this.jofilter= 'created_at.desc';
            }
            this.getBrandJOs();
                   },

        restoreJO(id) {
            this.$store.dispatch('restorebrandJO', id)
                .then(() => {
                    this.$toaster.success('Job Order restored succesfully!.')
                })
                .catch(() => {
                    alert('Something went wrong, try reloading the page');
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

        getAllWorkbooks() {
            this.$store.dispatch('getWorkbooks', this.data)
                .then((response) => {
                    this.brandProfile.workbooks = response;
                })
        },
        searchDeb: _.debounce(function() {
            this.getAllWorkbooks();
        }, 500),
        changeArchive() {
            this.data.isArchive = !this.data.isArchive;
            this.getAllWorkbooks();
        },
        dWB(wid) {
            this.$store.dispatch('deleteWB', {id: wid})
                .then(() => {
                    var index = _.findIndex(this.brandProfile.workbooks, {id: wid})
                    this.brandProfile.workbooks.splice(index, 1);
                    this.$toaster.warning('Workbook Deleted!.')
                })
        },
        rWB(wid) {
            this.$store.dispatch('restoreWB', {id: wid, data: this.data})
                .then((response) => {
                    this.brandProfile.workbooks = response;
                    this.$toaster.info('Workbook Restored.')
                })
        }
    }

    
}
</script>
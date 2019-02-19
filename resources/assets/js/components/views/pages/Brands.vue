<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-briefcase"></span> Brands</h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="nm-top"><span class="txt-bold">
                                        <span class="fa fa-briefcase"></span> BRANDS LIST 
                                        <small v-if="user_info.role_id==1">| <a @click.prevent="archiveBrands" href="">View Archive</a></small></span>
                                    </h6>
                                </div>
                                <div class="col-md-8 text-right">
                                    <select v-model="data.filter" @change="getsData()" class="my-input my-thin-select" name="" id="">
                                        <option v-bind:value="{position: 'asc', category:'name'}">Name (A - Z)</option>
                                        <option v-bind:value="{position: 'desc', category:'name'}">Name (Z - A)</option>
                                        <option v-if="data.notArchive" v-bind:value="{position: 'asc', category:'created_at'}">Date (Ascending)</option>
                                        <option v-if="data.notArchive" v-bind:value="{position: 'desc', category:'created_at'}">Date (Descending)</option>
                                        <option v-if="!data.notArchive" v-bind:value="{position: 'asc', category:'deleted_at'}">Deleted (Ascending)</option>
                                        <option v-if="!data.notArchive" v-bind:value="{position: 'desc', category:'deleted_at'}">Deleted (Descending)</option>
                                    </select>
                                    <input @input="search()" v-model="data.search" type="search" class="my-input my-thin-input" placeholder="Search...">
                                    <span class="fa fa-search text-gray"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <brands-filter-search :data="data">
                                        <tr v-for="brand in brands" :key="brand.id" class="list-complete-item">
                                            <td>{{ brand.name }}</td>
                                            <td>{{  brand.created_at | moment("MMM D, YYYY") }}</td>
                                            <td>{{brand.jos.length}}</td>
                                            <td>{{brand.workbooks.length}}</td>
                                            <td class="td-actions">
                                                <router-link  v-if="data.notArchive" :to="{name: 'brand_profile', params: {brandId: brand.id},props:{brandinfos: brandinfos}}" type="button" @click="getData(brand)" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                                    <i class="fa fa-eye"></i></router-link>
                                                <router-link v-if="data.notArchive" :to="{name: 'update_brand', params: {brand_Id: brand.id }}" type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </router-link>
                                                <button v-if="data.notArchive && user_info.role_id==1" type="button" rel="tooltip"  @click="deleteBrand(brand.id)" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                                <button v-if="!data.notArchive && user_info.role_id==1" type="button" rel="tooltip" @click="restoreBrand(brand.id)" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Restore">
                                                    <i class="fa fa-refresh"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </brands-filter-search>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div v-if="user_info.role_id==1" class="taskchart shadow mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="txt-bold nm-top"><span class="fa fa-plus-square-o text-success"></span> Add New Brand:</p>
                                    <hr/>
                                    <router-link :to="{name: 'new_brand'}" tag="button" class="btn btn-block btn-md btn-success">Add Brand</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="taskchart shadow">
                            <p class="txt-bold nm-top"><span class="fa fa-plus-square-o text-info"></span> Create New Job Order</p>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="note">Select a JO type to create new Job Order form.</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <router-link :to="{name: 'new_jo_web'}" type="button" rel="tooltip" class="btn btn-info btn-sm full-btn">
                                                Web JO
                                            </router-link>
                                        </div>
                                        <div class="col-md-6">
                                            <router-link :to="{name: 'new_jo_creative'}" type="button" rel="tooltip" class="btn btn-info btn-sm full-btn">
                                                Creatives JO
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <br/>
                        <div class="taskchart shadow">
                            <p class="txt-bold nm-top"><span class="fa fa-copy text-info"></span> Active Job Orders&nbsp;<span><small>| <a @click.prevent="archiveJO" href="">Archive</a></small></span></p>
                            <hr/>
                            <div class="row" v-if="jos">
                                <div class="col-md-12">
                                    <ul class="jo-list">
                                        <li v-for="jo in jos" :key="jo.id" v-if="jo.status == 1">
                                            <router-link v-if="jo.type == 1" :to="{name: 'viewjocreative', params: {jo_id: jo.id}}">
                                                <span class="fa fa-file-o"></span>
                                                {{ jo.name }}
                                            </router-link>
                                            <router-link v-if="jo.type == 2" :to="{name: 'viewjoweb', params: {jo_id: jo.id}}">
                                                <span class="fa fa-file-o"></span>
                                                {{ jo.name }}
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div> 
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <router-link :to="{name: 'all_jo_list'}" class="btn btn-sm btn-info btn-md btn-simple">See All Job Order Forms</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                      
            </div>
           
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
import BrandsFilterSearch from "./brands/BrandsFilterSearch.vue";
import AddBrand from "./brands/AddBrand.vue";
import UpdateBrand from "./brands/UpdateBrand.vue";
import BrandProfile from "./brands/BrandProfile.vue";


export default {
    components:{
        BrandsFilterSearch: BrandsFilterSearch,
        AddBrand: AddBrand,
        UpdateBrand: UpdateBrand,
        BrandProfile: BrandProfile
        
    },

    data() {
        return {
            jo: '',
            disabled: true,
            data: {
                filter: {position: 'desc', category:'created_at'},
                search: '',
                notArchive: true
                
            },
            brandinfos: {},
            ndata: {
            search: '',
            sort: 'created_at.desc',
            notArchive: true
                    }
           // errors: [],
            
        }
    },

    computed: {
         ...mapGetters({
                brands: 'brandsList',
                jos: 'getJOs',
                user_info: 'getuser_info',
            }),

        redirectJO() {
            if(this.jo === 'web' ){
                this.$router.push({name: 'new_jo_web'});
            }
            else if(this.jo === 'creatives') {
                this.$router.push({name: 'new_jo_creative'});
            }
        },

        isNull() {
            if(this.jo){
                this.disabled = false;
            }
        }

    },
    created() {
        let data = this.data;
        this.$store.dispatch('setBrands', {url : '/api/getbrands', data});
        const ndata = {
            search: '',
            sort: 'created_at.desc',
            notArchive: true
        }
        this.$store.dispatch('getJobOrders', ndata);
        this.$store.dispatch('getuser_info');

    }, 

    methods: {
         getsData() {
             
            let data = this.data
            this.$store.dispatch('setBrands', {url : '/api/getbrands', data});

        },
         getData(branddata) {
             this.brandinfos=branddata;
            

        },

        deleteBrand(id) {
            this.$store.dispatch('deleteBrand', id)
                .then(() => {
                    this.$toaster.warning('Brand deleted succesfully, see Archive List to restore!!.')
                })
                .catch(() => {
                    alert('Something went wrong, try reloading the page');
                })
        },
        archiveBrands() {
            this.data.notArchive = !this.data.notArchive;
            if(this.data.notArchive==true){ this.data.filter = {position: 'desc', category:'created_at'} }
            else{ this.data.filter = {position: 'desc', category:'deleted_at'}};
            let data = this.data;
            this.$store.dispatch('setBrands', {url : '/api/getbrands', data});
        },
        restoreBrand(id) {
            this.$store.dispatch('restoreBrand', id)
                .then(() => {
                    this.$toaster.success('Brand restored succesfully!.')
                })
                .catch(() => {
                    alert('Something went wrong, try reloading the page');
                })
        },
         archiveJO() {
           // let _this = this;
            let ndata = this.ndata;
            this.ndata.notArchive = !this.ndata.notArchive;
            this.$store.dispatch('getJobOrders', ndata); 
            console.log('archive');
                   },
    }
}
</script>

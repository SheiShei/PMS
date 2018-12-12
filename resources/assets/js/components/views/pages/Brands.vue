<template>
    <section class="main-main-container" style="">

        <div class="title-head">
            <h2><span class="fa fa-suitcase"></span> Brands <small>Panel</small></h2>
        </div>

        <div class="first-column col-md-8 col-sm-12"> 
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>SUMMARY </strong></h6>
                </div>
                <div class="mybox-body">
                    <div class="mycard mycard-full-info">
                        <div class="mc-head">
                            <p>ON SERVICE</p>
                        </div>
                        
                        <div class="mc-body">
                            <div class="mc-icon">
                                <i class="fa fa-folder-open-o"></i>
                            </div>
                            <div class="mc-num">
                                <h3 class="">53</h3>
                            </div>
                        </div>
                    </div>
                    <div class="mycard mycard-full-danger">
                        <div class="mc-head">
                            <p> CLOSED </p>
                        </div>
                        
                        <div class="mc-body">
                            <div class="mc-icon">
                                <i class="fa fa-handshake-o"></i>
                            </div>
                            <div class="mc-num">
                                <h3 class="">50</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mycard mycard-full-success">
                            <div class="mc-head">
                                <p> TOTAL </p>
                            </div>
                            
                            <div class="mc-body">
                                <div class="mc-icon">
                                    <i class="fa fa-copy"></i>
                                </div>
                                <div class="mc-num">
                                    <h3 class="">175</h3>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>BRANDS OVERVIEW</strong>&nbsp;<span><small>| <a @click.prevent="archiveBrands" href="">Archive</a></small></span></h6>
                </div>
                <brands-filter-search :data="data">
                                <tr v-for="brand in brands" :key="brand.id">
                                    <td>{{brand.id}}</td>
                                    <td>{{brand.name}}</td>
                                    <td>November 9, 2018</td>
                                    <td>9</td>
                                    <td class="td-actions">
                                        <router-link  v-if="data.notArchive" :to="{name: 'brand_profile', params: {brandId: brand.id }}" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                            <i class="fa fa-eye"></i></router-link>
                                        <button v-if="data.notArchive" type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button v-if="data.notArchive" type="button" rel="tooltip"  @click="deleteBrand(brand.id)" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        <button v-if="!data.notArchive" type="button" rel="tooltip" @click="restoreBrand(brand.id)" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Restore">
                                            <i class="fa fa-refresh"></i>
                                         </button>
                                    </td>
                                </tr>
                </brands-filter-search>       
             </div>
                <div class="mybox-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <router-link :to="{name: 'new_brand'}" class="btn btn-sm btn-info pull-right">+ New Brand</router-link>
                        </div>
                    </div> 
                </div>
            </div>
        
        <div class="sec-column col-md-4 col-sm-12">
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>ACTIVE JOB ORDERS</strong></h6>
                </div>
                <div class="mybox-body white-bg" v-if="jos">
                    <div class="row">
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
                </div> 
                <div class="mybox-footer">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <router-link :to="{name: 'all_jo_list'}" class="btn btn-sm btn-info btn-md btn-simple">See All Job Order Forms</router-link>
                        </div>
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>                                     
            </div>
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>NEW JOB ORDER</strong></h6>
                </div>
                <div class="mybox-body white-bg">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="note">Select a JO type to create new Job Order form.</p>
                            <!-- <div class="form-group">
                                <div class="btn-group bootstrap-select">
                                    <select v-model="jo" @change="isNull()" class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                        <option disabled="">-- JO Form Type --</option>
                                        <option value="web">JO (Web)</option>
                                        <option value="creatives">JO (Creatives)</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link :to="{name: 'new_jo_web'}" type="button" rel="tooltip" class="btn btn-info btn-xs full-btn">
                                        Web JO
                                    </router-link>
                                </div>
                                <div class="col-md-6">
                                    <router-link :to="{name: 'new_jo_creative'}" type="button" rel="tooltip" class="btn btn-info btn-xs full-btn">
                                        Creatives JO
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
                <!-- <div class="mybox-footer">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <router-link :to="{name: 'new_jo_web'}" class="btn btn-sm btn-info btn-md">+ Create New JO</router-link>
                            <a @click.prevent="redirectJO" :disabled="disabled"  class="btn btn-sm btn-info btn-md">+ Create New JO</a>
                        </div>
                    </div>
                </div>                                      -->
            </div>
        </div>

    </section>
</template>

<script>
import {mapGetters} from 'vuex';
import BrandsFilterSearch from "./brands/BrandsFilterSearch.vue";
import AddBrand from "./brands/AddBrand.vue";


export default {
    components:{
        BrandsFilterSearch: BrandsFilterSearch,
        AddBrand: AddBrand
    },

    data() {
        return {
            jo: '',
            disabled: true,
            data: {
                filter: {position: 'asc', category:'name'},
                search: '',
                notArchive: true,
                id:''
            },
           // errors: [],
            
        }
    },

    computed: {
         ...mapGetters({
                brands: 'brandsList',
                jos: 'getJOs'
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
        this.$store.dispatch('getTandemsList');
        const ndata = {
            search: '',
            sort: 'created_at.desc'
        }
        this.$store.dispatch('getJobOrders', ndata);
    }, 

    methods: {
         getsData() {
             
            let data = this.data
            this.$store.dispatch('setBrands', {url : '/api/getbrands', data});

        },

        deleteBrand(id) {
            this.$store.dispatch('deleteBrand', id)
                .then((response) => {
                    this.$toaster.warning('Brand deleted succesfully, see Archive List to restore!!.')
                })
                .catch((error) => {
                    alert('Something went wrong, try reloading the page');
                })
        },
        archiveBrands() {
            this.data.notArchive = !this.data.notArchive;
            let data = this.data;
            this.$store.dispatch('setBrands', {url : '/api/getbrands', data});
        },
        restoreBrand(id) {
            this.$store.dispatch('restoreBrand', id)
                .then((response) => {
                    this.$toaster.success('Brand restored succesfully!.')
                })
                .catch((error) => {
                    alert('Something went wrong, try reloading the page');
                })
        }
    }
}
</script>

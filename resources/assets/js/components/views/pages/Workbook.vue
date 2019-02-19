<template>
    <section class="main-main-container">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook <small></small></h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="nm-top"><strong><span class="fa fa-book"></span> WORKBOOKS LIST</strong>&nbsp;<span><small>| <a @click.prevent="changeArchive" href="">Archive</a></small></span></h6>
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
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="max-height: 75vh; overflow-y: auto" v-if="workbooks">
                                        <div class="torev2" v-for="workbook in workbooks" :key="workbook.id">
                                            <a v-if="cuser.role.id == 4" href="" @click.prevent="$router.push({name:'review_workbook', params: {wb_id: workbook.id}})" class="torev2">
                                                <div class="torevdiv2">
                                                    <div class="torev-left">
                                                        <div class="torev-icon">
                                                            <i alt="" class="fa fa-book medium-avatar"></i>
                                                        </div>
                                                    </div>  
                                                    <div class="torev-right">
                                                        <h6 class="wb-title txt-bold"><a>{{ workbook.name }}</a> <span v-if="workbook.reviewed_at" title="Reviewed by Client" class="fa fa-check-circle text-success"></span></h6> 
                                                        <p><small>by: {{ workbook.created_by.name }} . {{ workbook.created_at | moment('ll') }} . {{ workbook.brand.name }}</small></p>
                                                        <p class="hidden-lg hidden-md"><span><a class="btn btn-danger btn-simple btn-xs">Archive</a></span></p>
                                                    </div>
                                                    <div class="very-right hidden-sm hidden-xs text-right">
                                                        <a @click.stop href="#child" title="Archive" class="btn btn-danger btn-simple btn-xs">
                                                            <span class="fa fa-trash-o"></span> Archive
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                            <a v-else href="" @click.prevent="$router.push({name:'view_workbook', params: {wb_id: workbook.id}})" class="torev2">
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
                                                                :increment="1"
                                                                v-model="overallrating"
                                                                >
                                                            </fa-rating>
                                                        </small></p>
                                                        <p class="hidden-lg hidden-md"><span><a class="btn btn-danger btn-simple btn-xs">Archive</a></span></p>
                                                    </div>
                                                    <div class="very-right hidden-sm hidden-xs text-right">
                                                        <a @click.stop href="#child" title="Archive" class="btn btn-danger btn-simple btn-xs">
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
                    <div class="col-md-4" v-if="cuser.role.id == 2">
                        <div class="taskchart shadow">
                            <p class="txt-bold"><span class="fa fa-plus-square-o text-success"></span> Create New</p>
                            <hr>
                            <router-link :to="{name: 'add_workbook'}" class="btn btn-success btn-md btn-block">Create Workbook</router-link>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

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
    data() {
        return {
            data: {
                search: '',
                brand: '',
                status: '',
                isArchive: false
            },
            thumbsUp: 'star',
            overallrating: 4 //samplelangto
        }
    },

    created() {
        this.getAllWorkbooks();
        this.star = Star
    },

    mounted() {
        // let oldSuccessLabel = this.$awn.options // Save original option
        // this.$awn.options.labels.confirm = 'Tell us what you think!' // Set my specific, one-time option
        // this.$awn.options.icons.confirm = 'star' // Set my specific, one-time option
        // this.$awn.confirm("To ensure that we are doing everything that we can to exceed your expectations, please take a moment to RATE and COMMENT any suggestions you have.", this.onOk())
        // this.$awn.options = oldSuccessLabel // Restore the original option
        
    },

    computed: {
        ...mapGetters({
                workbooks: 'getWorkbookList',
                cuser: 'currentUser'
            }),
    },
    methods: {
        getAllWorkbooks() {
            this.$store.dispatch('getWorkbooks', this.data);
        },
        searchDeb: _.debounce(function() {
            this.getAllWorkbooks();
        }, 500),
        changeArchive() {
            this.data.isArchive = !this.data.isArchive;
            this.getAllWorkbooks();
        },
    }
}
</script>


<style scoped lang="scss">
.wb-list-div{
    display: inline-flex;
    width: 100%;
    position: relative;
    p {
        margin: 0 0 4px;
    }
    // padding: 20px 20px;
    div.img{
        display: inline-block;
        width: 20%;
        padding: 10px 10px;
        img{
            height: 70px;
            margin: 5px auto;
        }
    }
    .wb-details{
        display: inline-block;
        width: 80%;
        padding: 10px 10px;
        .wb-title{
            margin-bottom: 3px;
            font-weight: bold;
            font-size: 15px;
        }
        .wb-title:hover{
            text-decoration: underline;
        }
    }
}
.wb-brand{
            margin-bottom: 0;
            font-size: 11px;
            margin:0 auto; 
        }

.wb-list-div:hover{
    background-color: #edf2f3;
}

.wb-list-div:hover .wb-delete{
    display: block;
}
.wb-delete{
    display: none;
    position: absolute; 
    top: 0; 
    right: 0;
}
.boxheadv2{
    padding: 5px 10px;
    h6{
        margin-top:4px;
    }
    select{
        border: 1px solid #efefef;
        padding: 4px;
        color: #9e9e9e;
        border-radius: 3px;
    }
    input[type="text"]{
        padding: 5px;
        line-height: normal;
        border: 1px solid #efefef;
        color: #9e9e9e;
        border-radius: 3px;
    }
    input[type="text"]::placeholder{
        color: #9e9e9e;
    }
}

</style>

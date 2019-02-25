<template>
        <div class="container-fluid">
            <div class="main2" v-if="workbook">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="taskchart shadow brl-gray">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="no-margin txt-bold">
                                        <!-- <span class="fa fa-book text-info"></span> -->
                                        {{ workbook.name }}
                                        <span v-if="workbook.reviewed_at" class="fa fa-check-circle text-success"></span>
                                    </p>
                                    <p class="no-margin text-gray">
                                        <small>
                                        <span class="fa fa-user-o text-default"></span>
                                        {{ workbook.created_by.name }} . 
                                        <!-- <span class="fa fa-clock-o text-default"></span> -->
                                        {{ workbook.created_at | moment('calendar') }}
                                        </small>
                                    </p>
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
                                    <p v-if="workbook.reviewed_at" class="no-margin text-gray"><i>Reviewed by {{ workbook.brand.name }} . {{ workbook.reviewed_at | moment('calendar') }}</i></p>
                                    <p v-else class="no-margin text-gray"><i>Waiting for review</i></p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <!-- <button v-if="!revMode" class="btn btn-default btn-sm">Close</button> -->
                                    <button v-if="revMode" @click="revMode=!revMode" class="btn btn-default btn-sm">Cancel</button>
                                    <button v-if="!revMode && workbook.reviewed_at" @click="revMode=!revMode" class="btn btn-success btn-sm">Add Revision</button>
                                    <button v-if="revMode" @click="SubmitRevision" class="btn btn-success btn-sm">Submit Revision <span class="fa fa-check"></span></button>
                                </div>
                            <br/>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-5">

                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <button @click="prevSlide" :disabled="currentSlide === 0" class="btn btn-default btn-sm">
                                        <span class="fa fa-caret-left"></span>
                                        <!-- Previous -->
                                    </button>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                                    <h6 class="txt-bold text-default">{{ currentSlide+1 }} of {{ workbook.files.length }}</h6>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <button @click="nextSlide" :disabled="currentSlide === workbook.files.length-1" class="btn btn-default btn-sm">
                                        <!-- Next -->
                                        <span class="fa fa-caret-right"></span>
                                    </button>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12 wb-ratings">
                                    <!-- <p class="txt-bold">
                                        <span class="fa fa-star-o"></span> 
                                        About 
                                    </p> -->
                                    <!-- <p class="txt-bold">
                                        <span class="fa fa-align-left"></span> 
                                        About
                                    </p> -->
                                    
                                    <p class="txt-bold">
                                        <span class="fa fa-star-o"></span> 
                                        Client's Rate:
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="text-center">
                                                <fa-rating :glyph="star"
                                                    :read-only="true"
                                                    :item-size="35" 
                                                    :spacing="3"  
                                                    inactive-color="#e2e2e2" 
                                                    active-color="#ffc815"
                                                    :border-width=2
                                                    border-color="#fff"
                                                    :increment="1"
                                                    v-model="getCurrentImage.revisions[0].rating">
                                                </fa-rating>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <p class="txt-bold">
                                        <span class="fa fa-comment-o"></span> 
                                        Comment:
                                    </p>
                                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio facere perspiciatis sint illo velit quidem tenetur, similique numquam recusandae officiis expedita provident ab dolorem quisquam accusamus totam omnis accusantium ipsum</p> -->
                                    <p>{{ getCurrentImage.revisions[0].comment }}</p>
                                </div>
                            </div>
                            <br/>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <transition name="slide">
                        <div v-if="revMode" class="taskchart shadow" style="margin-bottom: 20px">
                            <p class="txt-bold">
                                <span class="fa fa-rotate-left"></span> 
                                Revision for File ({{ currentSlide+1 }} of {{ workbook.files.length }})
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <div class="taskchart shadow" style="margin-bottom: 20px"> -->
                           
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="fileinput fileinput-new text-left btn-block" data-provides="fileinput">
										<div class="row">
										<div class="col-md-6">
											<span class="btn btn-success btn-md btn-block btn-file">
												<span class="fileinput-new"><span class="fa fa-camera"></span> Upload File</span>
												<span class="fileinput-exists"><span class="fa fa-camera"></span> Change</span>
												<input type="file" @change="onChanged" name="..." id="newrevimage"  format="jpeg" ><div class="ripple-container"></div></span>
											<a id="linkToClick" v-show="false" href="" class="btn btn-md btn-default btn-block fileinput-exists" data-dismiss="fileinput"> Remove</a>
                                            <p class="txt-bold"> 
                                        <span class="fa fa-edit"></span> 
                                        Caption
                                    </p>
                                    <textarea v-model="getCurrentImage.newRev.caption" rows="5" class="my-text-area my-inp-blk"></textarea>
										</div>
                                        <div class="col-md-6">
                                            <div v-if="!getCurrentImage.newRev.new_filename" class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                            <!-- <div class="fileinput-new thumbnail img-raised"> -->
                                                <img v-if="getCurrentImage.newRev.new_filename" :src="'/storage/workbook/'+getCurrentImage.newRev.new_filename" style="width:100%"/>
                                            <!-- </div> -->
                                        </div>
										</div>
										<!-- <div class="fileinput-new thumbnail img-raised">
											<img src="" style="max-width: 100%" alt="...">
										</div> -->
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    
                                </div>
                            </div>
                        <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        </transition>

                        <div class="taskchart shadow">
                            <p class="txt-bold">
                                        <span class="fa fa-pencil"></span> 
                                        Caption
                                    </p>
                                    <p class="text-default">{{ getCurrentImage.revisions[0].caption }}</p>
                                    <hr/>
                            <!-- <p class="txt-bold no-margin">
                                <span class="fa fa-image"></span> 
                                Attached File
                            </p>
                            <hr> -->
                                    <a>
                                        <img :src="getCurrentImage.revisions[0].new_filename" :alt="getCurrentImage.revisions[0].original_filename"  :title="getCurrentImage.revisions[0].original_filename" class="img-rounded img-responsive img-raised" style="max-width: 100%">
                                    </a>
                            <br/>
                        </div>

                        <!-- <div v-if="getCurrentImage.revisions.length!=1" class="taskchart shadow mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><span class="fa fa-circle text-gray"></span>
                                    &nbsp;<span class="txt-bold">Revision {{getCurrentImage.revisions.length}}</span>&nbsp;
                                    <span v-if="getCurrentImage.revisions[0].rating!=null" v-for="n in getCurrentImage.revisions[0].rating" :key="n.id" class="fa fa-star text-warning"></span>
                                    <span v-if="getCurrentImage.revisions[0].rating==null" v-for="m in 5" :key="m.id" class="fa fa-star-o"></span>
                                &nbsp;.
                                    <small>{{getCurrentImage.revisions[0].created_at | moment("MMM D, YYYY")}}.&nbsp;
                                        <a style="cursor: pointer" v-if="!openDetails" @click="openDetails=!openDetails">View Details</a>
                                    <a v-if="openDetails" style="cursor: pointer" @click="openDetails=!openDetails">Close Details</a>
                                    <span class="text-gray"><i>{{getCurrentImage.revisions[0].comment}}</i></span></small>
                                    </p>
                                </div>
                            </div>
                            <div class="row" v-for="(bago, ind) in getCurrentImage.revisions.length" :key="bago.id" v-if="openDetails">
                                <div v-if="ind!=0" class="col-md-12">
                                    <p class="text-gray">Caption <span class="fa fa-pencil"></span> . {{ getCurrentImage.revisions[ind].caption }}</p>
                                    <img :src="getCurrentImage.revisions[ind].new_filename" :alt="getCurrentImage.revisions[ind].original_filename"  :title="getCurrentImage.revisions[ind].original_filename" class="img-rounded img-responsive img-raised" style="max-width: 50%; margin: 0 auto">
                                </div>
                            </div>
                        </div> -->
                        <a style="cursor: pointer" v-if="!openDetails" @click="openDetails=!openDetails">View Details</a>
                                    <a v-if="openDetails" style="cursor: pointer" @click="openDetails=!openDetails">Close Details</a>
                        <div v-if="getCurrentImage.revisions.length!=1 && index" class="taskchart shadow mt-4" v-for="(rev, index) in getCurrentImage.revisions" :key="rev.id">
                            <!-- <div v-if="index"> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><span class="fa fa-circle text-gray"></span>
                                        &nbsp;<span class="txt-bold">Revision {{ getCurrentImage.revisions.length-index }}</span>&nbsp;
                                        <span v-for="(n, i) in rev.rating" :key="i" class="fa fa-star text-warning"></span>&nbsp;.
                                        <small>{{ rev.created_at | moment('calendar') }}.&nbsp;
                                        <span class="text-gray"><i>"{{ rev.comment }}"</i></span></small>
                                        </p>
                                    </div>
                                </div>
                                <div class="row" v-if="openDetails">
                                    <div class="col-md-12">
                                        <p class="text-gray">Caption <span class="fa fa-pencil"></span> . {{ rev.caption }}</p>
                                        <img :src="rev.new_filename" :alt="rev.original_filename"  :title="rev.original_filename" class="img-rounded img-responsive img-raised" style="max-width: 50%; margin: 0 auto">
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                        

                        <br/>
                    </div>
                </div>
                
            </div>
        </div>
</template>


<script>
import {StarRating} from 'vue-rate-it';
import {HeartRating} from 'vue-rate-it';
import {FaRating} from 'vue-rate-it';
import {ImageRating} from 'vue-rate-it';
import Star from 'vue-rate-it/glyphs/star';
import Vue from 'vue'
// import StarRating from 'vue-rate-it';
export default {
    components:{
        StarRating,
        HeartRating,
        FaRating
    },
    props: ['workbook'],
    data() {
        return {
            openDetails: false,
            revMode: false,
            thumbsUp: 'star',
            rating: 3,
            overallrating: 3, //samplelangto
            currentSlide: 0,
            
            change_workbook: {
                name: '',
                caption: '',
                brand: '',
                files: '',
            },
            // id: this.$route.params.wb_id,
            haschange: false,
        }
    },
    computed: {
        getCurrentImage(){
            return this.workbook.files[this.currentSlide]            
        }
    },
    methods: {
        nextSlide(){
            if(this.revMode) {
                document.getElementById('newrevimage').value=[];
                document.getElementById('linkToClick').click();
            }
            
            let max = this.workbook.files.length - 1
            let current = this.currentSlide
            if(current != max) this.currentSlide++
        },
        prevSlide(){
            if(this.revMode) {
                document.getElementById('newrevimage').value=[];
                document.getElementById('linkToClick').click();
            }
            let min = 0
            let current = this.currentSlide
            if(current >= min) this.currentSlide--
        },
        onChanged (event) {
            // this.change_workbook.files = event.target.files
            // console.log(this.brand.logo);
            // this.haschange=true;
            let newrevfile = event.target.files;
            let form = new FormData;
            if(!newrevfile.length){
                return false;
            }
            form.append('file', newrevfile[0]);

            const config = { headers : {'Content-Type': 'multipart/form-data'} }
            axios.post('/api/uploadWorkbookFiles', form, config)
                .then(response => {
                    // console.log(response);
                    // Vue.set(state.scrumLists[sprint_index].us, us_index, data);
                    // Vue.set(this.workbook.files[this.currentSlide].newRev.new_filename, response.data.new_filename);
                    this.getCurrentImage.newRev.new_filename = response.data.new_filename;
                    this.getCurrentImage.newRev.original_filename = response.data.original_filename;
                })
                .catch(error => {
                    console.error(error);
                    
                })
            
        },
        UpdateWorkbook(id) {
            let form = new FormData;
            form.append('id', id);
            if(this.haschange==true)
            {
                form.append('files', this.change_workbook.files[0]);
                // console.log('in if',this.change_workbook.files[0]);
            }
            form.append('name', this.change_workbook.name);
            form.append('caption', this.change_workbook.caption);
            // form.append('brand', this.change_workbook.brand);
            // form.append('file_id', this.change_workbook.file_id);
            
            // console.log(form.append();

            this.$store.dispatch('UpdateWorkbook', form)
                .then(() => {
                        this.revMode=false;
                        this.$store.commit('setCWorkbook', this.$route.params.wb_id)
                        this.$toaster.success('Revision added succesfully!.')
                })
                .catch((error) => {
                    console.log(error)
                    //   this.errors = error;
                })
        },
        SubmitRevision() {
            axios.post('/api/SubmitRevision', this.workbook)
                .then(response => {
                    // console.log(response);
                    this.$store.commit('setWorkbooks', response.data)
                    this.$store.commit('setCWorkbook', this.$route.params.wb_id)
                    this.workbook.files.forEach(file => {
                        file.newRev = {
                            new_filename: '',
                            original_filename: '',
                            caption: ''
                        }
                    });
                    this.revMode=false;
                    this.$toaster.success('Revision added succesfully!.')
                })
                .catch(error => {
                    console.error(error);
                    
                })
        }

    },
    created(){
        this.star = Star;
        this.$store.dispatch('getCWorkbook',this.$route.params.wb_id)
            .then((response) => {
                // console.log(this.tandemList)
                this.change_workbook.caption = response.data.caption;
            })

    },
}
</script>
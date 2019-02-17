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
                                    <p v-if="workbook.reviewed_at" class="no-margin text-gray"><i>Reviewed by {{ workbook.brand.name }} on {{ workbook.reviewed_at | moment('calendar') }}</i></p>
                                    <p v-else class="no-margin text-gray"><i>Waiting for review</i></p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-default btn-sm">Close Workbook</button>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-5">
                        <div class="taskchart shadow">
                            <div class="row hidden-xs">
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
                        <br/>
                    </div>
                    <div class="col-md-7">
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
            thumbsUp: 'star',
            rating: 3,
            currentSlide: 0,
            images:[
                {
                    name: 'nightsky3.jpg',
                    src: '/images/nightsky3.jpg',
                    acmaCaption: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique minus commodi animi i assumenda atque odio?',
                    comment: 'comment 1'
                },
                {
                    name: 'default.png',
                    src: '/images/default.png',
                    acmaCaption:'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique minus commodi animi i assumenda atque odio?',
                    comment: 'comment 2'
                }

            ]
        }
    },
    computed: {
        getCurrentImage(){
            return this.workbook.files[this.currentSlide]            
        }
    },
    methods: {
        nextSlide(){
            let max = this.workbook.files.length - 1
            let current = this.currentSlide
            if(current != max) this.currentSlide++
        },
        prevSlide(){
            let min = 0
            let current = this.currentSlide
            if(current >= min) this.currentSlide--
        },
    },
    created(){
        this.star = Star
    }
}
</script>
<template>
    <section class="main-main-container">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook</h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="taskchart shadow brl-gray">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="no-margin txt-bold">
                                        <!-- <span class="fa fa-book text-info"></span> -->
                                        Potato Corner Review
                                    </p>
                                    <p class="no-margin text-gray">
                                        <small>
                                        <span class="fa fa-user-o text-default"></span>
                                        Aya . 
                                        <!-- <span class="fa fa-clock-o text-default"></span> -->
                                        Jan 3, 2019 . 4:30PM 
                                        </small>
                                    </p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-success btn-sm">Submit My Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-7">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <button @click="prevSlide" :disabled="currentSlide === 0" class="btn btn-default btn-sm">
                                        <span class="fa fa-caret-left"></span>
                                        <!-- Previous -->
                                    </button>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                                    <h6 class="txt-bold text-default">{{ currentSlide+1 }} of {{ images.length }}</h6>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <button @click="nextSlide" :disabled="currentSlide === images.length-1" class="btn btn-default btn-sm">
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
                                        <span class="fa fa-pencil"></span> 
                                        Caption
                                    </p>
                                    <p>{{ getCurrentImage.acmaCaption}}</p>
                                    <!-- <hr/>
                                    

                                    <p class="txt-bold no-margin">
                                <span class="fa fa-image"></span> 
                                Attached File
                            </p>
                            <hr> -->
                                    <a>
                                        <img :src="getCurrentImage.src" :alt="getCurrentImage.name"  :title="getCurrentImage.name" class="img-rounded img-responsive img-raised" style="max-width: 100%">
                                    </a>

                                    <!-- <p class="txt-bold">
                                        <span class="fa fa-star-o"></span> 
                                        Rate 
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="text-center">
                                                <fa-rating :glyph="star" 
                                                    :item-size="35" 
                                                    :spacing="3"  
                                                    inactive-color="#e2e2e2" 
                                                    active-color="#ffc815"
                                                    border-width="2"
                                                    border-color="#fff"
                                                    :increment="1"
                                                    v-model="rating">
                                                </fa-rating>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <p class="txt-bold">
                                        <span class="fa fa-comment-o"></span> 
                                        Comment
                                    </p>
                                    <textarea class="my-text-area btn-block" name="" id="" rows="4" max-rows="5" placeholder="Say something about this..."></textarea> -->
                                </div>
                            </div>
                            <br/>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-5">
                        <div class="taskchart shadow">
                            <!-- <p class="txt-bold no-margin">
                                <span class="fa fa-image"></span> 
                                Attached File
                            </p>
                            <hr>
                                    <a>
                                        <img :src="getCurrentImage.src" :alt="getCurrentImage.name"  :title="getCurrentImage.name" class="img-rounded img-responsive img-raised" style="max-width: 100%">
                                    </a> -->
                                    <p class="txt-bold">
                                        <span class="fa fa-star-o"></span> 
                                        Rate This
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="text-center">
                                                <fa-rating :glyph="star" 
                                                    :item-size="35" 
                                                    :spacing="3"  
                                                    inactive-color="#e2e2e2" 
                                                    active-color="#ffc815"
                                                    border-width="2"
                                                    border-color="#fff"
                                                    :increment="1"
                                                    v-model="rating">
                                                </fa-rating>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <p class="txt-bold">
                                        <span class="fa fa-comment-o"></span> 
                                        Comment
                                    </p>
                                    <textarea class="my-text-area btn-block" name="" id="" rows="5" max-rows="5" placeholder="Say something about this..."></textarea>
                            <br/>
                        </div>
                        <br/>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
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
    data() {
        return {
            thumbsUp: 'star',
            rating: 3,
            currentSlide: 0,
            images:[
                {
                    name: 'nightsky3.jpg',
                    src: '/images/nightsky3.jpg',
                    acmaCaption: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique minus commodi animi i assumenda atque odio?'
                },
                {
                    name: 'default.png',
                    src: '/images/default.png',
                    acmaCaption:'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique minus commodi animi i assumenda atque odio?'
                }

            ]
        }
    },
    computed: {
        getCurrentImage(){
            return this.images[this.currentSlide]            
        }
    },
    methods: {
        nextSlide(){
            let max = this.images.length - 1
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
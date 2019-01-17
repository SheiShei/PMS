<template>
    <section class="main-main-container" style="background-color: #fefefe">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook</h2>
        </div>
        
        <!-- <div class="mybox" style="margin: 20px;">
            <div class="mybox-head">
                <h6><strong>Mockup for Potato Corner's Website</strong>
                </h6>
                <p><small>by Aya, Sent January 10, 2019</small></p>
            </div>
            <div class="mybox-body white-white-bg">
                <div class="wb-viewPerPost">
                    <div class="wb-imageView">
                        <img src="/images/nightsky3.jpg" style="max-width: 100%" alt="nightsky3.jpg">
                    </div>
                    <div class="wb-detailsPost">
                        <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates ducimus, ea hic natus corporis ullam et repellendus vero. Delectus dolor nesciunt inventore, cum possimus animi enim quos?
                        </p>
                        <hr>
                        <p><span class="fa fa-commenting-o"></span> Comment:</p>
                        <textarea class="my-text-area btn-block" name="" id="" rows="3" max-rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div> -->

        <transition name="fade" id="galleryView">    
        <!-- <div class="overlay">    -->
            <div class="gallery">
                <!-- <div style="padding-top: 30px"> -->
                    <!-- <p class="text-white">{{ currentSlide+1 }} of {{ images.length }}</p> -->
                    <!-- <router-link :to="{ name: 'kanboard'}" style="margin-top: 30px" class="btn btn-eks btn-danger btn-simple" title="Close image viewer"><span class="fa fa-close"></span></router-link> -->
                <!-- </div> -->

                <div class="wb-title">
                    <div>
                        <img src="/images/agenda_icon_by_Freepik.png" alt="" height="50px">
                    </div>
                    <div class="details">
                        <h5>Potato Corner Website Mockups</h5>
                        <p>Prepared by: Aya, September 5, 2018</p>
                        <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt dolorum eum quia deleniti tempore facilis sunt assumenda eius incidunt? Tempora, eveniet! Tempora ut fuga in nisi voluptatem expedita nesciunt ipsam?</p> -->
                    </div>
                    <div>
                        <button class="btn btn-sm btn-success btn-round hidden-sm hidden-xs">Submit My Review <span class="fa fa-check"></span></button>
                        <button class="btn btn-xs btn-success btn-round hidden-lg hidden-md"><span class="fa fa-check"></span></button>
                    </div>
                    
                </div>
                <div class="wb-viewPerPost">
                    <div class="wb-imageView">
                        <div style="display: inline-flex; margin: auto; ">
                        <div class="left-button">
                            <button @click="prevSlide" :disabled="currentSlide === 0" class="btn btn-primary btn-simple btn-md"><span class="fa fa-chevron-left"></span></button>
                        </div>
                        <div class="center-image">
                            <!-- <p>{{ currentSlide+1 }} of {{ images.length }}</p> -->
                            <img :src="getCurrentImage.src" :alt="getCurrentImage.name"  :title="getCurrentImage.name" style="/*max-width: 100%*/">
                        </div>
                        <div class="right-button">
                            <button @click="nextSlide" :disabled="currentSlide === images.length-1" class="btn btn-primary btn-simple btn-md"><span class="fa fa-chevron-right"></span></button>
                        </div>
                        </div>
                    </div>
                    <div class="wb-detailsPost">
                        <!-- <p class="text-success">{{ currentSlide+1 }} of {{ images.length }}</p> -->
                        <p><span class="text-info txt-bold">{{ currentSlide+1 }} of {{ images.length }}.</span> 
                        {{ getCurrentImage.acmaCaption}}
                            <!-- <span>
                                <strong>{{ currentSlide+1 }} of {{ images.length }}.&nbsp;&nbsp;</strong>
                            </span> -->
                        <!-- {{ getCurrentImage.acmaCaption}} -->
                        </p>
                        <hr>
                        <p><span class="fa fa-commenting-o"></span> Comment:</p>
                        <textarea class="my-text-area btn-block" name="" id="" rows="5" max-rows="5"></textarea>
                    </div>
                </div>

                <!-- <img :src="getCurrentImage.src" :alt="getCurrentImage.name"  :title="getCurrentImage.name" style="margin: 0 auto" height="100px"> -->
                <!-- <p>{{ getCurrentImage.acmaCaption}}</p> -->
                <div>
                    <!-- <button @click="prevSlide" :disabled="currentSlide === 0" class="btn btn-primary btn-simple btn-md"><span class="fa fa-arrow-left"></span> PREV</button> -->
                    <!-- <a class="btn btn-primary btn-simple btn-md" :href="getCurrentImage.src" title="Download" download><span class="fa fa-download"></span></a> -->
                    <!-- <button @click="nextSlide" :disabled="currentSlide === images.length-1" class="btn btn-primary btn-simple btn-md">NEXT <span class="fa fa-arrow-right"></span></button> -->
                </div>
            </div>
        <!-- </div> -->
    </transition>
    </section>
</template>


<script>
export default {
    data() {
        return {
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
    }
}
</script>

<style lang="scss" scoped>
.wb-title{
    padding: 10px 20px;
    display: flex;
    // background-color: #367e8e;
    background-color: #2a889e;
    border-left: 3px dashed #a0c1c5;
    // border-left: 6px solid rgb(0, 162, 255);
    div > img{
        display: inline-block;
        margin-right: 5px;
    }
    div.details{
        display: inline-block;
        margin-left: 5px;
        h5,p{
            margin: 0;
        }
        h5{
            font-weight: bold;
            font-size: 15px;
            text-transform: uppercase;
            color: white;
        }
        p{
            font-size: 12px;
            color: whitesmoke;
        }
    }
    div > button{
        // display: inline-block;
        // float: right;
        position: absolute;
        right: 0;
        margin: 8px 10px;
    }
}
.btn-eks{
      position: absolute;
      top: 2px;
      right: 0;
  }
.gallery{
      width: 100%;
    //   background-color: rgba(0,0,0,0.6);
    //   height: 100%;
      margin: auto;
    //   text-align: center;
      padding: 30px auto;
  }

.wb-viewPerPost{
    display: flex;
    // width: 100%;
    position: relative;
    margin: 20px 10px;
}
.left-button{
    // width: 5%;
    display: inline-flex;
    margin-right: 5px;
    button{
        vertical-align: middle;
        
    }
}
.right-button{
    // width: 5%;
    display: inline-flex;
    margin-left: 5px;
    button{
        vertical-align: middle;
    }
}
.center-image{
    // width: 90%;
    // display: inline-flex;
    img{
        vertical-align: middle;
        width:100%;
        
    }
}
.wb-imageView{
    display: inline-block;
    // width: 100%;
    // height: 50vh;
    width: 60%;
    padding: 20px 15px;
    text-align: center;
    margin: auto;
    background-color: #f1f2f3;
    .center-image{
        img{
        margin: 0 auto;
        // border-radius: 2px;
        transition: 0.3s display;
        max-width: 100%;
        }
    }
}
.wb-detailsPost{
    display: inline-block;
    position: relative;
    width: 40%;
    padding: 15px;
}
.mybox-v2{
    .mybox-head{
        border: none;
    }
    .mybox-body{
        padding: 0
    }
}

@media screen and (max-width: 768px){
    .wb-viewPerPost{
        display: block;
    }
    .wb-imageView{
        display: block;
        width: 100%;
    }
    .wb-detailsPost{
        display: block;
        width: 100%;
    }
}
</style>


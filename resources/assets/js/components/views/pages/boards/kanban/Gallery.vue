<template>
    <!--OPEN GALLERY-->
    <transition name="fade" id="galleryView">    
        <div class="overlay">   
            <div class="gallery">
                <div style="padding-top: 30px">
                    <p class="text-white">{{ currentSlide+1 }} of {{ images.length }}</p>
                    <router-link :to="{ name: 'kanboard'}" style="margin-top: 30px" class="btn btn-eks btn-danger btn-simple" title="Close image viewer"><span class="fa fa-close"></span></router-link>
                </div>
                <img :src="getCurrentImage.src" :alt="getCurrentImage.name"  :title="getCurrentImage.name" style="margin: 0 auto" height="70%">
                <div>
                    <button @click="prevSlide" :disabled="currentSlide === 0" class="btn btn-primary btn-simple btn-md"><span class="fa fa-arrow-left"></span> PREV</button>
                    <a class="btn btn-primary btn-simple btn-md" :href="getCurrentImage.src" title="Download" download><span class="fa fa-download"></span></a>
                    <button @click="nextSlide" :disabled="currentSlide === images.length-1" class="btn btn-primary btn-simple btn-md">NEXT <span class="fa fa-arrow-right"></span></button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            currentSlide: 0,
            images: [
                {
                    name: 'image1',                        
                    src:'/images/sample.jpg'
                },
                {
                    name: 'image2',
                    src:'/images/nightsky3.jpg'
                },
                {
                    name: 'image3',
                    src:'/images/mfilogo.png'
                }
            ],
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


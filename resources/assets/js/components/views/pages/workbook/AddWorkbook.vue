<template>
    <section class="main-main-container">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook <small></small></h2>
        </div>
    <div class="row">
        <!-- <div class="col-md-1"></div> -->
        <div class="col-md-11">
        <div class="mybox" style="margin: 20px">
            <div class="mybox-head">
                <h6><strong>NEW WORKBOOK</strong></h6>
            </div>
            <div class="mybox-body white-white-bg">
                <div class="row">
                    <div class="col-md-5">
                        <h6><strong><small>DETAILS</small></strong></h6>
                        <p class="plabel"><small>Title:</small></p>
                        <p class=""><input type="text" class="my-input btn-block"></p>
                        <p class="plabel"><small>Brand:</small></p>
                        <p>
                        <select name="" id="" class="my-input btn-block">
                            <option value="">---</option>
                            <option value="">Brand 2</option>
                        </select>
                        </p>
                        <p class="plabel"><small>Description</small></p>
                        <textarea class="my-text-area btn-block" name="" id="" rows="3"></textarea>
                    </div>
                    <div class="col-md-7" >
                        <h6><strong><small>UPLOAD FILES</small></strong></h6>
                        <vue-clip @change="shei" :options="options" class="uploader">
                            <template slot="clip-uploader-action">
                                <div class="uploader-action text-center">
                                    <div class="dz-message">
                                        
                                        <p><span class="fa fa-upload"></span></p>
                                        <p>Drag and drop files here
                                            or browse</p>
                                        
                                    </div>
                                </div>
                            </template>
                            <template slot="clip-uploader-body" slot-scope="props">
                                <div>
                                <div v-for="file in props.files" :key="file.index" class="uploader-files">
                                    <div class="file-avatar">
                                        <img v-bind:src="file.dataUrl" />
                                    </div>

                                    <!--If not image-->
                                    <!-- <div class="file-avatar">
                                        <a href="/storage/task/1547207600PortfolioMAPEH.pptx" download="" class="ataskment-thumb"><span><b>pptx</b></span></a>
                                    </div> -->
                                    <div class="file-details">
                                        <div class="file-name">
                                            <!-- <p class="text-right"><span class=""><a href="" class="btn btn-danger btn-simple btn-xs text-right">
                                                x
                                            </a></span></p> -->
                                            <p>{{ file.name }} - <span><button class="btn btn-simple btn-danger btn-xs">Remove</button></span></p>
                                            
                                        </div>
                                        <div class="file-progress" v-if="file.status!=='error'&&file.status!=='success'">
                                            <span class="progress-indicator" style="color: green"
                                            :style="{width: file.progress + '%'}">

                                            </span>
                                        </div>
                                        <!-- <div class="file-meta" >
	                                        <span class="file-size">{{ file.size }}</span>
	                                        <span class="file-status">{{ file.status }}</span>
                                        </div> -->
                                        <div class="file-description">
                                            <textarea class="my-text-area btn-block" name="" rows="2" placeholder="Write a caption..."></textarea>
                                        </div>
                                        <!-- <div>
                                            <a href="" class="btn btn-danger btn-simple btn-xs">
                                                Remove
                                            </a>
                                        </div> -->
                                    </div>
                                    
                                </div>
                                </div>
                            </template>
                        </vue-clip>
                    </div>
                </div>
            </div>
            <div class="mybox-footer text-right">
                <button class="btn btn-sm btn-success">Save Workbook</button>
            </div>
        </div>
        </div>
    </div>
    </section>
</template>

<script>
import Vue from 'vue';
import VueClip from 'vue-clip';
Vue.use(VueClip);
export default {
    data(){
        return{
            options:{
				url: 'http://captivate.test/upload',
                paramName: 'file'
			}
        }
    },

    methods: {
        shei() {
            console.log('sehi');
            
        }
    }
}
</script>

<style scoped lang="scss">
.uploader-action{
    display: block;
    width: 100%;
    background-color: #f9f9f9;
    border: 2px dashed #cecccc;
    padding: 20px 30px 1px 30px;
    p > span{
        color: #b2bfcc;
        font-size: 40px;
    }
    margin: 10px auto;
}

.uploader-files{
    display: flex;
    position: relative;
    width: 100%;
    margin: 5px auto;
    
}

.file-avatar{
    display: inline-block;
    vertical-align: middle;
    width: 25%;
}

.file-details{
    display: inline-block;
    vertical-align: middle;
    width: 75%;
    .file-name{
        white-space:pre-line;
    }
    .file-description{
        vertical-align: baseline;
        width: 100%;
    }
}

@media only screen and (max-width: 760px){
    .uploader-files, .file-avatar, .file-details{
        display: block;
    }
    .file-details{
        display: block;
        text-align: center;
        width: 100%;
    }
    .file-avatar{
        margin: auto;
    }
}

.upload-action.is-dragging {
    background: green;
  }
    .wb-form{
        padding: 20px;
        margin: 20px auto;
        h5{
            margin: 0;
            margin-bottom: 5px;
            input{
                border: 1px solid white;
            }
            input:focus{
                border: 1px solid #c7c7c7;
            }
        }
    }
    .wb-form-head{
        width: 100%;
        position: relative;
    }
    p.plabel{
        margin-bottom: 0;
    }
    .main-main-container{
        overflow-x: hidden;
    }
.ataskment-thumb{
    margin-right: 10px;
    color: #6b808c;
    background-color: #e0e0e0;
      display: block;
      font-size: 18px;
      font-weight: 700;
      height: 100%;
      line-height: 80px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
    //   width: 100%;
}
</style>

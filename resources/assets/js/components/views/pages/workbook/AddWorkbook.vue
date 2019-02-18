<template>
    <section class="main-main-container">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook <small></small></h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="taskchart shadow">
                            <div class="row">
                                <form @submit.prevent="saveWorkbook">
                                <div class="col-md-12">
                                    <h6 class="nm-top txt-bold"><span class="fa fa-plus-square-o"></span> NEW WORKBOOK</h6>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group is-empty">
                                                <label class="control-label">Title</label>
                                                <input required v-model="workbook.name" type="text" class="form-control">
                                                <span class="material-input"></span>
                                            </div> 
                                            <br/>
                                            <div class="form-group">
                                                <label for="" class="control-label">Brand</label>
                                                <div class="">
                                                    <div class="btn-group bootstrap-select">
                                                        <select v-model="workbook.brand" required name="brandowner" class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                                            <option disabled="" value="" selected="">--Select Brand--</option>
                                                            <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
                                                        </select>
                                                    </div>
                                                </div>   
                                            </div>
                                            <br/>
                                            <div class="form-group">
                                                <label class="control-label" style="color: #535353">Description:</label>
                                                <textarea v-model="workbook.desc" type="text" row="6" class="form-control" placeholder="Write something about this workbook..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-7" >
                                            <h6><strong><small>UPLOAD FILES</small></strong></h6>
                                            <vue-clip :options="options" class="uploader" :on-complete="complete">
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
                                                        <div v-for="file in files" :key="file.index" class="uploader-files">
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
                                                                    <textarea v-model="file.caption" class="my-text-area btn-block" name="" rows="2" placeholder="Write a caption..."></textarea>
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
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" :disabled="files.length ? false : true" class="btn btn-md btn-success">Save Workbook <span class="fa fa-check"></span></button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Vue from 'vue';
import VueClip from 'vue-clip';
import {mapGetters} from 'vuex';

Vue.use(VueClip);
export default {
    data(){
        return{
            options:{
				url: '/api/uploadWorkbookFiles',
                paramName: 'file',
                headers: window.axios.defaults.headers.common,
                acceptedFiles: 'image/*'
            },
            workbook: {
                name: '',
                desc: '',
                brand: '',
                files: []
            },
            files: []
        }
    },
    created() {
        this.$store.dispatch('onCreateWorkbook')
            .then(() => {
                $(this.$el).find('.selectpicker').selectpicker('refresh');
            })
        const data = {
            filter: {position: 'desc', category:'created_at'},
            search: '',
            notArchive: true
        }
        this.$store.dispatch('setBrands', {url : '/api/getbrands', data});

    },
    computed: {
        ...mapGetters({
                user: 'currentUser',
                brands: 'brandsList'
            }),
    },
    methods: {
        saveWorkbook() {
            var newfiles = [];
            this.files.forEach(file => {
                let newfile = {
                    caption: file.caption,
                    response: file.response
                }

                newfiles.push(newfile);
            });
            this.workbook.files = newfiles;

            this.$store.dispatch('newWorkbook', this.workbook)
                .then(() => {
                    this.files = []
                    this.workbook.files = []
                    this.workbook.name = ''
                    this.workbook.desc = ''
                    this.workbook.brand = ''
                    
                    this.$toaster.success('Workbook created succesfully!')
                })
        },
        complete (file, status, xhr) {
            file.response = JSON.parse(xhr.response)
            file.caption = ''
            this.files.push(file);
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

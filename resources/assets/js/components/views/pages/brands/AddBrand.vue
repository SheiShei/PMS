<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-files-o"></span> Brands<small> Panel</small></h2>
        </div>

        <div class="col-md-1"></div>
            <div class="first-column col-md-10">
                <form class="form" @submit.prevent="addNewBrand()">
                    <div class="mybox">
                        <div class="mybox-head">
                            <h6><strong>New Brand</strong></h6>
                        </div>
                        <div class="mybox-body white-bg">
                                    <!--  -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group row is-empty">
                                        <label for="brandname" class="col-md-6 col-sm-6">Brand Name:</label>
                                        <input  v-model="brand.name"  required type="text" class="col-md-6 col-sm-6 my-input" placeholder="">
                                    </div>

                                    <hr class="divider">

                                    <div class="form-group row">
                                        <label for="" class="col-md-6 col-sm-6">Client / Contact Person:</label>
                                        <input v-model="brand.contact_person" required type="text" class="col-md-6 col-sm-6 my-input" placeholder="">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-6">Telephone:</label>
                                        <input v-model="brand.telephone" required type="text" class="col-md-6 col-sm-6 my-input" placeholder="">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-6">Mobile Phone:</label>
                                        <input  v-model="brand.mobile" required type="text" class="col-md-6 col-sm-6 my-input" placeholder="">
                                    </div>

                                    <hr class="divider">

                                    <div class="form-group row">
                                        <label for="" class="col-md-6 col-sm-6">Brand Owner</label>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="btn-group bootstrap-select">
                                                <select  name="brandowner" v-model="brand.tandem_id" class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
  
                                                    <option v-for="tandem in tandemsList" :key="tandem.id" :value="tandem.id">{{tandem.name}}</option>
                                                    
                                                </select>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="" class="col-md-4">Logo (optional):</label>
                                        
                                        <div class="col-md-8">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-raised">
                                                    <img src="/images/logooo2.png" alt="..." height="50">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-raised" style=""></div>
                                                <div>
                                                    <span class="btn btn-sm btn-raised btn-round btn-default btn-file btn-info">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="hidden"><input type="file" @change="onLogoChanged" format="jpeg" name="...">
                                                        <div class="ripple-container"></div>
                                                    </span>
                                                    <a href="#pablo" class="btn btn-xs btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4">About:</label>
                                        <textarea v-model="brand.about" type="text" row="5" class="col-md-8 my-text-area" placeholder=""></textarea>
                                    </div>                 
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                                    
                        </div>
                        <div class="mybox-footer text-right">
                            <button type="submit" class="btn btn-success btn-md">Save Brand</button>
                        </div>
                    </div>
                </form>
            </div>
        <div class="col-md-1"></div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';

export default {

   data(){
       return {
           brand:{
               name: '',
               contact_person: '',
               telephone: '',
               mobile: '',
               tandem_id: '',
               logo: '',
               about: ''               
           },
           ///errors: []
       
       }

   },

   created() {
       this.getTandemsList();
   },

computed: {
         ...mapGetters({
                brandsList: 'brandsList',
                tandemsList: 'getTandemsList'
            }),
},
methods: {
    getTandemsList() {
        this.$store.dispatch('getTandemsList');
    },
    addNewBrand() {
            this.$store.dispatch('addBrand', this.brand)
                .then((response) => {
                    // console.log(response)
                     this.errors = [];
                    this.brand.name = '';
                    this.brand.contact_person = '';
                    this.brand.telephone = '';
                    this.brand.mobile = '';
                    this.brand.tandem_id = '';
                    this.brand.logo = 'logooo2.png';
                    this.brand.about = ''
                    this.$toaster.success('New Brand added!.')
                })

                .catch((error) => {
                    // console.log(error)
                    this.errors = error;
                })
        },
    onLogoChanged (event) {
        this.brand.logo = event.target.files[0]
        },

    onUpload() {
        const formData = new FormData()
        formData.append('myFile', this.brand.logo, this.brand.logo.name)
        //axios.post('api/uploadfile', formData)
        return formData;
        //console.log(formData)
            }

        } 
}
</script>

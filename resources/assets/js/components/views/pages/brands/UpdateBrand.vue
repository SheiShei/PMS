<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-files-o"></span> Brands</h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="nm-top txt-bold"><span class="fa fa-edit"></span> Edit Brand Info</h6>
                                </div>
                            </div>
                            <hr/>
                            <form class="form" @submit.prevent="UpdateBrand()">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group is-empty">
                                                    <label class="control-label">Brand Name:</label>
                                                    <input v-model="brand.name"  required type="text" class="form-control">
                                                    <span class="material-input"></span>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group is-empty">
                                                    <label class="control-label">Client / Contact Person:</label>
                                                    <input v-model="brand.contact_person" required type="text" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group is-empty">
                                                    <label class="control-label">Telephone:</label>
                                                    <input v-model="brand.telephone" pattern="[0-9]{3}[ -][0-9]{4}" type="tel" title="eg. 456-5645" placeholder="XXX-XXXX" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group is-empty">
                                                    <label class="control-label">Mobile Phone:</label>
                                                    <input v-model="brand.mobile" pattern="09[0-9]{9}" type="tel" placeholder="09XXXXXXXXX" title="09+9 digits" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label" style="color: #535353">About:</label>
                                                <textarea v-model="brand.about" type="text" row="5" class="form-control" placeholder=""></textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Brand Owner:</label>
                                                    <div class="">
                                                        <div class="btn-group bootstrap-select">
                                                            <select name="brandowner" v-model="brand.acma_id" class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                                                <option selected v-for="tandems in tandemList" :key="tandems.id">{{tandems.name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Logo (optional):</label>
                                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail img-raised">
                                                            <img :alt="brand.name+' logo'" :src="brand.logo" height="50">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised" style=""></div>
                                                        <div>
                                                            <span class="btn btn-sm btn-raised btn-default btn-file btn-info btn-simple">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="hidden"><input type="file" @change="onLogoChanged" format="jpeg" name="...">
                                                                <div class="ripple-container"></div>
                                                            </span>
                                                            <a href="#pablo" class="btn btn-xs btn-danger btn-simple fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-success btn-md">Update Brand Info <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';

export default {


   data(){
       return {
             brand:{
               id: this.$route.params.brand_Id,
               name: '',
               contact_person: '',
               email: '',
               password: '',
               telephone: '',
               mobile: '',
               acma_id: '',
               logo: '',
               about: ''               
           },
           haslogo: false,
          
       
       }

   },
   created() {
       this.$store.dispatch('getTandemsList');  
        this.$store.dispatch('getOnebrand',this.brand.id)
            .then((response) => {
                const brandData = response;
                this.brand.name = brandData.name;
                this.brand.contact_person = brandData.contact_person;
                this.brand.telephone = brandData.telephone;
                this.brand.email = brandData.email;
                this.brand.mobile = brandData.mobile;
                this.brand.acma_id = brandData.acma_id;
                this.brand.logo = brandData.logo;
                this.brand.about = brandData.about;
                $(this.$el).find('select[name=brandowner]').val(this.brand.acma_id);
                $(this.$el).find('.selectpicker').selectpicker('refresh');
                // console.log(this.brand.logo);
            })
        
        // console.log(this.data.id);   
    },

    computed: {
         ...mapGetters({
                tandemList: 'getTandemsList',
                brandProfile: 'getOnebrand'
            })  
    },

    methods: {
        UpdateBrand() {
            let form = new FormData;
            form.append('id', this.brand.id);
            if(this.haslogo==true)
            {
                form.append('logo', this.brand.logo[0]);
                console.log('in if',this.brand.logo[0]);
            }
            else{
                form.append('logo', this.brand.logo);
                }
            form.append('name', this.brand.name);
            form.append('email', this.brand.email);
            form.append('password', this.brand.password);
            form.append('telephone', this.brand.telephone);
            form.append('contact_person', this.brand.contact_person);
            form.append('mobile', this.brand.mobile);
            form.append('acma_id', this.brand.acma_id);
            form.append('about', this.brand.about);
            // console.log(form.append();

            this.$store.dispatch('UpdateBrand', form)
                .then(() => {
                        this.$router.replace({ name: 'brands'});
                        this.$toaster.success('Brand updated succesfully!.')
                })
                .catch((error) => {
                    console.log(error)
                    //   this.errors = error;
                })
        },
        onLogoChanged (event) {
                this.brand.logo = event.target.files
                // console.log(this.brand.logo);
                this.haslogo=true;
        }
    },
}
</script>

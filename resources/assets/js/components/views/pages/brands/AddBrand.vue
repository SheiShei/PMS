<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-files-o"></span> Brands</h2>
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
                                <div class  ="col-md-6 col-sm-12">
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
                                        <input v-model="brand.telephone" pattern="[0-9]{3}[ -][0-9]{4}" type="tel" class="col-md-6 col-sm-6 my-input" title="eg. 456-5645" placeholder="XXX-XXXX">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-6">Mobile Phone:</label>
                                        <input  v-model="brand.mobile" pattern="09[0-9]{9}" type="tel" class="col-md-6 col-sm-6 my-input" placeholder="09XXXXXXXXX" title="09+9 digits">
                                    </div>

                                    <hr class="divider">

                                    <div class="form-group row">
                                        <label for="" class="col-md-6 col-sm-6">Email :</label>
                                        <input v-model="brand.email" required type="email" class="col-md-6 col-sm-6 my-input" placeholder="">
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-6 col-sm-6">Password: </label> 
                                        <input v-model="brand.password" required minlength="6" :type="pwdType" class="col-md-6 col-sm-6 my-input" placeholder="">
                                        <!-- <span class="password-eye" @click="passwordType">
                                                <i class="fa fa-eye fa-sm"></i>
                                            </span> -->
                                    </div>

                                    <hr class="divider">

                                    <div class="form-group row">
                                        <label for="" class="col-md-6 col-sm-6">Brand Owner</label>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="btn-group bootstrap-select">
                                                <select  required name="brandowner" v-model="brand.tandem_id" class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                                    <option disabled="" value="" selected="">--Select--</option>
                                                    <option v-for="tandem in tandemList" :key="tandem.id" :value="tandem.id">{{tandem.name}}</option>
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

   data() {
       return {
            brand:{
                name: '',
                contact_person: '',
                telephone: '',
                mobile: '',
                tandem_id: '',
                logo: '',
                about: '',
                email: '',
                password: ''             
            },
            pwdType: 'password'
       }
   },
    created() {
        this.$store.dispatch('getTandemsList')
            .then(() => {
                // console.log(this.tandemList)
                $(this.$el).find('.selectpicker').selectpicker('refresh');
            })
    },
     computed: {
         ...mapGetters({
                tandemList: 'getTandemsList'
            })
        },
   
    methods: {
        addNewBrand() {
            // console.log('asdasd');
            let form = new FormData;
            form.append('logo', this.brand.logo[0]);
            form.append('name', this.brand.name);
            form.append('telephone', this.brand.telephone);
            form.append('contact_person', this.brand.contact_person);
            form.append('mobile', this.brand.mobile);
            form.append('tandem_id', this.brand.tandem_id);
            form.append('about', this.brand.about);
            form.append('email', this.brand.email);
            form.append('password', this.brand.password);

            this.$store.dispatch('addBrand', form)
            .then(() => {
                        this.brand.name='';
                        this.brand.contact_person='';
                        this.brand.telephone='';
                        this.brand.mobile='';
                        this.brand.tandem_id='';
                        this.brand.about='';
                        this.brand.logo='';
                        this.brand.email='';
                        this.brand.password='';
                        this.$router.replace({ name: 'brands'});
                        this.$toaster.success('Brand added succesfully!')

                    });
        },

        onLogoChanged (event) {
            this.brand.logo = event.target.files
             console.log(this.brand.logo[0]);
        },

        passwordType(){
            this.pwdType = this.pwdType=== 'password' ? 'text' : 'password'
        }
    }
}
</script>

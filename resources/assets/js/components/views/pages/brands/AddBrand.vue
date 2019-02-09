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
                                    <h6 class="nm-top txt-bold"><span class="fa fa-plus-square-o"></span> New Brand</h6>
                                </div>
                            </div>
                            <hr/>
                            <form class="form" @submit.prevent="addNewBrand()">
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
                                                            <select  required name="brandowner" v-model="brand.tandem_id" class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                                                <option disabled="" value="" selected="">--Select--</option>
                                                                <option v-for="tandem in tandemList" :key="tandem.id" :value="tandem.id">{{tandem.name}}</option>
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
                                                            <img src="/images/logooo2.png" alt="..." height="50">
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
                                        <br/>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="note">NOTE: Fill up to create this brand's client account.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group is-empty">
                                                    <label class="control-label">Email:</label>
                                                    <input v-model="brand.email" required type="email" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group is-empty">
                                                    <label class="control-label">Password:</label>
                                                    <input v-model="brand.password" required minlength="6" :type="pwdType" class="form-control">
                                                    <span class="material-input"></span>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-success btn-md">Save Brand <span class="fa fa-check"></span></button>
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

   data() {
       return {
            brand:{
                name: '',
                contact_person: '',
                email:'',
                password: '',
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
            form.append('email', this.brand.email);
            form.append('password', this.brand.password);
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
                        this.brand.email='';
                        this.brand.password='';
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
            // console.log(this.brand.logo);
        },

        passwordType(){
            this.pwdType = this.pwdType=== 'password' ? 'text' : 'password'
        }
    }
}
</script>

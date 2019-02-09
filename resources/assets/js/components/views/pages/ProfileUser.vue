<template>
    <section class="main-main-container">
        
<div class="profile-page">

	<div class="page-header header-filter" data-parallax="true" :style="{ 'background-image': 'url('+user_info.bg_image+')' }"></div>

	<div class="main main-raised">
		<div class="profile-content" style="padding: 0 20px">
            <div class="">

                <div class="row">
	                <div class="col-md-4 col-xs-12 col-xs-offset-0 col-md-offset-0">
        	           <div class="profile">
	                        <div class="avatar">
	                            <img :src="user_info.picture" :alt="user_info.name+' Photo'" class="img-circle img-responsive img-raised">
	                        </div>
	                         <div class="name">
	                            <h4><b>{{user_info.name}}</b></h4>
								<p v-if="user_info.role_id==1" ><small> Admin </small></p>
								<p v-if="user_info.role_id==2"><small> ACMA </small></p>
								<p v-if="user_info.role_id==3 && user_info.department_id==1" ><small>Employee | Web Team</small></p>
								<p v-if="user_info.role_id==3 && user_info.department_id==2" ><small>Employee | Creatives Team</small></p>								<p v-if="user_info.role_id==4"><small> Client </small></p>
                                <hr/>

                                <!--For ACMA--> 
								
                                <div v-if="user_info.role_id==2 || user_info.role_id==1" class="text-left work-summary">
                                    <div class="ws-wrapper">
                                        <div class="ws-info">
                                            <div class="ws-info-title">
                                                <p>Total Brands Handled</p>
                                            </div>
                                            <div class="ws-info-icon">
                                                <i class="fa fa-suitcase"></i>
                                            </div>
                                        </div>
                                        <div class="ws-number text-info">
                                            <p>1439</p>
                                        </div>
                                    </div>
                                    <div class="ws-wrapper">
                                        <div class="ws-info">
                                            <div class="ws-info-title">
                                                <p>Total JO Created</p>
                                            </div>
                                            <div class="ws-info-icon">
                                                <i class="fa fa-file-text-o"></i>
                                            </div>
                                        </div>
                                        <div class="ws-number text-info">
                                            <p>95</p>
                                        </div>
                                    </div>
                                    <div class="ws-wrapper">
                                        <div class="ws-info">
                                            <div class="ws-info-title">
                                                <p>Total Workbooks Created</p>
                                            </div>
                                            <div class="ws-info-icon">
                                                <i class="fa fa-book"></i>
                                            </div>
                                        </div>
                                        <div class="ws-number text-info">
                                            <p>1439</p>
                                        </div>
                                    </div>
                                </div>
								
								

								<!--For Regular Employee -->
								
								<div v-if="user_info.role_id==3" class="text-left work-summary">
                                    <div class="ws-wrapper">
                                        <div class="ws-info">
                                            <div class="ws-info-title">
                                                <p>Total Tasks</p>
                                            </div>
                                            <div class="ws-info-icon">
                                                <i class="fa fa-tasks"></i>
                                            </div>
                                        </div>
                                        <div class="ws-number text-info">
                                            <p>0</p>
                                        </div>
                                    </div>
                                    <div class="ws-wrapper">
                                        <div class="ws-info">
                                            <div class="ws-info-title">
                                                <p>Active Tasks</p>
                                            </div>
                                            <div class="ws-info-icon">
                                                <i class="fa fa-hourglass-2"></i>
                                            </div>
                                        </div>
                                        <div class="ws-number text-info">
                                            <p>0</p>
                                        </div>
                                    </div>
                                </div>
								

								<!--For Client-->
								
								<div v-if="user_info.role_id==4" class="text-left work-summary">
									<div class="ws-wrapper">
                                        <div class="ws-info">
                                            <div class="ws-info-title">
                                                <p>Total Received Workbooks</p>
                                            </div>
                                            <div class="ws-info-icon">
                                                <i class="fa fa-book"></i>
                                            </div>
                                        </div>
                                        <div class="ws-number text-info">
                                            <p>4</p>
                                        </div>
                                    </div>
                                    <div class="ws-wrapper">
                                        <div class="ws-info">
                                            <div class="ws-info-title">
                                                <p>Reviewed Workbook</p>
                                            </div>
                                            <div class="ws-info-icon">
                                                <i class="fa fa-gavel"></i>
                                            </div>
                                        </div>
                                        <div class="ws-number text-info">
                                            <p>14</p>
                                        </div>
                                    </div>
                                </div>
				              

                               
	                        </div>
	                    </div>
    	            </div>
                    <div class="col-md-8 col-xs-12" style="padding: 10px 20px">
                        


                        <div class="card card-nav-tabs card-plain">
								<div class="header header-info">
									<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<ul class="nav nav-tabs" data-tabs="tabs">
												<!-- <li class="active"><a href="#notifs" data-toggle="tab" aria-expanded="false">
                                                    <span class="fa fa-bell"></span>&nbsp;
                                                    Notifications</a></li> -->
												<li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-gear"></span>&nbsp;
                                                    Account Settings<div class="ripple-container"></div></a></li>
												<!-- <li><a href="#history" data-toggle="tab">History</a></li> -->
											</ul>
										</div>
									</div>
								</div>
								<div class="card-content">
									<div class="tab-content text-center">
										<!-- <div class="tab-pane" id="notifs">
											<p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
										</div> -->
										<div class="tab-pane active" id="settings">
											<div class="settingssec text-left">
												<form @submit.prevent="updatemyself()">
												<div class="row">
													
													<div class="col-md-4">
														<div class="form-group is-empty">
															<label class="control-label text-grey">Name</label>
															<input v-model="data.name" required type="text" class="form-control" >
															<span class="material-input"></span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group is-empty">
															<label class="control-label text-gray">Email</label>
															<input v-model="data.email" required type="email"  class="form-control" >
															<span class="material-input"></span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group is-empty">
															<label class="control-label text-gray">Password</label>
															<input v-model="data.password" minlength="6" type="password" class="form-control">
															<span class="material-input"></span>
														</div>
													</div>
												
												</div>

												<div class="row">
													<div class="col-md-4">

														<div class="form-group is-empty">
															<label class="control-label text-grey">Avatar</label>
															<br/>
															<a class="btn btn-info btn-simple btn-xs text-center" @click="toggleShow">Update Avatar</a>
															
															<my-upload field="img"
																@crop-success="cropSuccess"
        														@crop-upload-success="cropUploadSuccess"
        														@crop-upload-fail="cropUploadFail"
																:width="300"
																:height="300"
																url="http://httpbin.org/post"
																:params="params"
																:headers="headers"
																:noRotate="false"
        														lang-type="en"
																:value.sync="show"
																img-format="png"></my-upload>
															<img :src="user_info.picture" class="img-raised img-circle" v-if="imgDataUrl==''">
															<img :src="imgDataUrl" class="img-raised img-circle">
															<!-- :src="imgDataURL" -->
														</div>
													</div>
													<div class="col-md-8">
														<div class="fileinput fileinput-new text-left" data-provides="fileinput">
															<div class="form-group is-empty">
																<label class="control-label text-grey">Background Image</label>
															</div>
															<div>
																<span class="btn btn-raised btn-info btn-simple btn-xs btn-default btn-file">
																	<span class="fileinput-new">Update Background Image</span>
																	<span class="fileinput-exists">Update Background Image</span>
																	<input type="file" name="..." @change="bg_image" format="jpeg" ><div class="ripple-container"></div></span>
																<br>
																<!-- <a href="#pablo" class="btn btn-xs btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> -->
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
															<div class="fileinput-new thumbnail img-raised">
																<img :src="user_info.bg_image" style="height: 200px; width: auto" alt="...">
															</div>
														</div>
													</div>
												</div>
												<hr>

												<div class="row">
													<div class="col-md-12 text-right">
														<button type="reset" @click="clearImgDataUrl" class="btn btn-sm btn-danger">Cancel</button>
														<button class="btn btn-sm btn-success" >Save Changes</button>
													</div>
												</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>


	                </div>
                </div>



				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						
					</div>
                </div>
                <div class="tab-content">
			        <div class="tab-pane active work" id="work">
				     
			        </div>
                    
			    </div>
            </div>
        </div>
	</div>

</div>



    </section>
</template>

<script>
import 'babel-polyfill'; 
import {mapGetters} from 'vuex';
import myUpload from 'vue-image-crop-upload';
	
export default{
	components:{
		'my-upload': myUpload
	},
	data(){
		return{
			data:{
				id: '',
				name: '',
				email: '',
				password: '',
				pw:'',
				bg_image: '',
			},
			hasBG: false,
			errors:[],
			show: false,
            params: {
                token: '123456798',
                name: 'avatar'
            },
            headers: {
                smail: '*_~'
            },
            imgDataUrl: '' //the datebase64 url of created image
		}
	},
	created() {
		this.$store.dispatch('getuser_info')
		.then((response) => {
				const user_data = response;
				this.data.id= user_data.id;
                this.data.name = user_data.name;
				this.data.email = user_data.email;
				this.data.pw= user_data.password;
				this.data.bg_image= user_data.bg_image;
                // console.log(this.brand.logo);
            })
	},

	computed: {
         ...mapGetters({
                user_info: 'getuser_info'
			}),
	},

	methods:{
		updatemyself(){
			let form = new FormData;
            form.append('id', this.data.id);
            if(this.hasBG==true)
            {
                form.append('bg_image', this.data.bg_image[0]);
            }
            else{
                form.append('bg_image', this.data.bg_image);
                }
            form.append('name', this.data.name);
			form.append('email', this.data.email);
			if(this.data.password=='')
			{
         	form.append('password', this.data.pw);
            // console.log(form.append();
			}
			else{
				form.append('password', this.data.password);
			}
			
			this.$store.dispatch('updatemyself', form)
			 .then((response) => {
					
                    this.$toaster.success('Info updated succesfully!.')
					//this.getsData();
                })

                .catch((error) => {
                    // console.log(error)
                    this.errors = error;
                })

		},
		bg_image(event){
			  this.data.bg_image = event.target.files
                console.log(this.data.bg_image[0]);
                this.hasBG=true;

		},
		getsData() {
             
            this.$store.dispatch('getuser_info')
				.then((response) => {
				const user_data = response;
				this.data.id= user_data.id;
                this.data.name = user_data.name;
				this.data.email = user_data.email;
				this.data.pw= user_data.password;
				this.data.bg_image= user_data.bg_image;
                // console.log(this.brand.logo);
            })
        },

		clearImgDataUrl(){
			this.imgDataUrl = '';
		},
		toggleShow() {
				this.show = !this.show;
			},
		cropSuccess(imgDataUrl, field){
				console.log('-------- crop success --------');
				this.imgDataUrl = imgDataUrl;
				console.log('laman ng imgdataURL', this.imgDataUrl);
			},
			/**
			 * upload success
			 *
			 * [param] jsonData  server api return data, already json encode
			 * [param] field
			 */
		cropUploadSuccess(jsonData, field){
				console.log('-------- upload success --------');
				console.log('this is the file here method:', jsonData);
				console.log('field: ', field);
			},
			/**
			 * upload fail
			 *
			 * [param] status    server api return error status, like 500
			 * [param] field
			 */
		cropUploadFail(status, field){
				console.log('-------- upload fail --------');
				console.log('status: ',status);
				console.log('field: ' + field);
			}
	},
	// events:{
	// 	cropSuccess(imgDataUrl, field){
	// 			console.log('-------- crop success --------');
	// 			this.imgDataUrl = imgDataUrl;
	// 		},
	// 		/**
	// 		 * upload success
	// 		 *
	// 		 * [param] jsonData  server api return data, already json encode
	// 		 * [param] field
	// 		 */
	// 		cropUploadSuccess(jsonData, field){
	// 			console.log('-------- upload success --------');
	// 			console.log('this is the file here event' +jsonData);
	// 			console.log('field: ' + field);
	// 		},
	// 		/**
	// 		 * upload fail
	// 		 *
	// 		 * [param] status    server api return error status, like 500
	// 		 * [param] field
	// 		 */
	// 		cropUploadFail(status, field){
	// 			console.log('-------- upload fail --------');
	// 			console.log(status);
	// 			console.log('field: ' + field);
	// 		}
	// }

}
</script>



<style lang="scss" scoped>
.ws-wrapper{
    display:flex;
    position: relative;
    height: 40px; 
    padding: 8px 12px;
    overflow: hidden;
    margin-bottom: 5px;
    .ws-info{
        display: inline-block;
        width: 70%;
        overflow: hidden;
        .ws-info-title{
            font-size: 12px;
            p{
                margin: 5px 10px;
            }
        }
        .ws-info-icon{
            margin-top: -7px;
            margin-left: -20px;
            font-size: 45px;
            color: #e3ecec;
            position: absolute;
            left: 0;
            top: 6px;
            z-index: -1;
            transition: 0.6s ease-in-out all;
            -webkit-transition: 0.6s ease-in-out all;
        }
    }
    .ws-number{
        display: inline-block;
        width:30%;
        text-align: right;
        font-size: 26px;
        p{
           margin-top: 5px;
        }
    }
}

.ws-wrapper:hover{
    .ws-info-icon{
        // font-size: 60px;
        margin-left: 4px;
    }
}





.profile-page .page-header {
    height: 230px;
}
.header-filter::before {
    background-color: rgba(0, 0, 0, 0.3);
}

.name > h4{
    margin-top: 20px;
    margin-bottom: 2px;
}

</style>

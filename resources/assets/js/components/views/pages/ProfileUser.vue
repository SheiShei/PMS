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
								<p v-if="user_info.role.id===1" ><small> Admin </small></p>
								<p v-if="user_info.role.id===2"><small> ACMA </small></p>
								<p v-if="user_info.role.id===3 && user_info.department_id===1" ><small>Employee | Web Team</small></p>
								<p v-if="user_info.role.id===3 && user_info.department_id===2" ><small>Employee | Creatives Team</small></p>								<p v-if="user_info.role.id==4"><small> Client </small></p>
                                <hr/>

                                <!--For ACMA--> 
								
                                <div v-if="user_info.role.id===2" class="text-left work-summary">
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
                                            <p>{{dashboard_acma.handled_brands}}</p>
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
                                            <p>{{dashboard_acma.jo_created}}</p>
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
                                            <p>{{dashboard_acma.workbookss}}</p>
                                        </div>
                                    </div>
                                </div>
								
								

								<!--For Regular Employee -->
								
								<div v-if="user_info.role.id===3" class="text-left work-summary">
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
                                            <p>{{dashboard_emp.totaltasks}}</p>
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
                                                <p>{{dashboard_emp.activetasks}}</p>
                                            
                                        </div>
                                    </div>
                                </div>
								

								<!--For Client-->
								
								<div v-if="user_info.role.id===4" class="text-left work-summary">
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
                                            <p>{{dashboard_client.total}}</p>
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
                                            <p>{{dashboard_client.reviewed}}</p>
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
																@close="toggleShow"
																:width="300"
																:height="300"
																url="http://httpbin.org/post"
																:params="params"
																:headers="{'X-Requested-With': 'XMLHttpRequest'}"
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
																<img v-if="user_info.bg_image" :src="user_info.bg_image" style="max-height: 200px; width: auto" alt="...">
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
	
export default {
	components:{
		'my-upload': myUpload
	},
	data() {
		return{
			data:{
				id: '',
				name: '',
				email: '',
				password: '',
				bg_image: '',
				picture: '',
				pic: ''

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
			imgDataUrl: '', //the datebase64 url of created image
			viewDnD: false
		}
	},
	created() {
		this.$store.dispatch('getuser_info')
		.then((response) => {
				const user_data = response;
				this.data.id= user_data.id;
                this.data.name = user_data.name;
				this.data.email = user_data.email;
				this.data.bg_image= user_data.bg_image;
				this.data.pic= user_data.picture;
            })
        this.$store.dispatch('dashboard_admin')
        this.$store.dispatch('dashboard_acma')
        this.$store.dispatch('dashboard_emp')
		this.$store.dispatch('dashboard_client')
		const token = this.$store.getters.currentUser;
		
		
	},

	computed: {
         ...mapGetters({
                user_info: 'currentUser',
				dashboard_acma: 'dashboard_acma',
				dashboard_emp: 'dashboard_emp',
				dashboard_client: 'dashboard_client',
				dashboard_admin: 'dashboard_admin',
			}),
	},

	methods:{
		updatemyself(){
			let form = new FormData;
            form.append('id', this.data.id);
            if(this.hasBG==true)
            {
				form.append('bg_image', this.data.bg_image[0]);
				console.log(this.data.bg_image[0]);
            }
            else{
				form.append('bg_image', this.data.bg_image);
				console.log(this.data.bg_image);
				
                }
            form.append('name', this.data.name);
            form.append('picture', this.data.picture);
            form.append('pic', this.data.pic);
			form.append('email', this.data.email);
			form.append('password', this.data.password);
			
			
			this.$store.dispatch('updatemyself', form)
			 .then((response) => {
					
                    this.$toaster.success('Info updated succesfully!.')
                })

                .catch((error) => {
                    // console.log(error)
                    this.errors = error;
                })

		},
		bg_image(event){
			  this.data.bg_image = event.target.files
                // console.log(this.data.bg_image[0]);
                // console.log(this.data.bg_image);
                this.hasBG=true;

		},
		// getsData() {
             
        //     this.$store.dispatch('getuser_info')
		// 		.then((response) => {
		// 		const user_data = response;
		// 		this.data.id= user_data.id;
        //         this.data.name = user_data.name;
		// 		this.data.email = user_data.email;
		// 		this.data.pw= user_data.password;
		// 		this.data.bg_image= user_data.bg_image;
        //         // console.log(this.brand.logo);
        //     })
        // },

		clearImgDataUrl(){
			this.imgDataUrl = '';
		},
		toggleShow() {
			this.show = !this.show;
		},
		cropSuccess(imgDataUrl, field){
			console.log('-------- crop success --------');
			this.imgDataUrl = imgDataUrl;
			this.data.picture = imgDataUrl;
		},
		/**
		 * upload success
		 *
		 * [param] jsonData  server api return data, already json encode
		 * [param] field
		 */
		cropUploadSuccess(jsonData, field){
			console.log('-------- upload success --------');
			console.log(jsonData);
			console.log('field: ' + field);
		},
		/**
		 * upload fail
		 *
		 * [param] status    server api return error status, like 500
		 * [param] field
		 */
		cropUploadFail(status, field){
			console.log('-------- upload fail --------');
			console.log(status);
			console.log('field: ' + field);
		},

		testAlert() {
			alert('sheira');
		}
	},
	events:{
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
				this.data.picture = jsonData.files.img;
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

.header-filter::before {
    background-color: rgba(0, 0, 0, 0.3);
}

.name > h4{
    margin-top: 20px;
    margin-bottom: 2px;
}

.profile-page .page-header {
    background-position: center;
}
</style>

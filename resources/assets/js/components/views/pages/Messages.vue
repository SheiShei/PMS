<template>
    <div>
        <section class="main-main-container">
            <div class="title-head">
                <h2><span class="fa fa-commenting-o"></span> Messages <small></small></h2>
            </div>
            <div class="col-md-9">
                <div class="mybox">
                    <div class="mybox-body msg-main-body white-white-bg">

                        <div class="contacts-cont">
                            <div class="cont-head" style="background-color: rgba(200, 200, 200, 0.2);">
                                <ul class="nav nav-pills nav-pills-primary">
                                    <li class="active"><a href="#pill2" class="btn-block" data-toggle="tab">
                                        <span class="fa fa-users"></span>
                                        <span class="hidden-sm hidden-xs">Group</span></a>
                                    </li>
	                                <li>
                                        <a href="#pill1" class="btn-block" data-toggle="tab">
                                            <span class="fa fa-user-o"></span>
                                            <span class="hidden-sm hidden-xs">People</span>
                                        </a>
                                    </li>
	                            </ul>
                            </div>

                            <div class="cont-body">
                                <div class="tab-content">

	                    	        <div class="tab-pane" id="pill1">

                                        <div class="cont-search">
                                            <form action="">
                                                <div class="input-group">
	        									    <div class="form-group is-empty">
                                                        <input type="search" value="" placeholder="Search people..." class="form-control">
                                                        <span class="material-input"></span>
                                                    </div>
                                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                                </div>
                                            </form>
                                        </div>

                                        <a href="" class="cont-name">
                                            <div class="media">
		        					            <a class="pull-left" href="#pablo">
		        						            <div class="avatar">
		        							            <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						            </div>
		        					            </a>
		        					            <div class="media-body">
		        						            <h4 class="media-head">John Camber <small class=""><span class="label label-success unread-label">2</span></small></h4>
		        						            <p class="prev-msg"> Don't forget, You're Aweso...</p>
                                                </div>
		        					        </div>
                                        </a>

                                        <a href="" class="cont-name">
                                            <div class="media">
                                                <a class="pull-left" href="#pablo">
                                                    <div class="avatar">
                                                        <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
                                                    </div>
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-head">John Camber <small class=""><span class="label label-success unread-label">2</span></small></h4>
                                                    <p class="prev-msg"> Don't forget, You're Aweso...</p>
                                                </div>
                                            </div>
                                        </a>
	                    	        </div>

	                    	        <div class="tab-pane active" id="pill2">
                                        <div class="cont-search">
                                            <form action="">
                                                <div class="input-group">
	        									    <div class="form-group is-empty"><input type="search" value="" placeholder="Search group..." class="form-control"><span class="material-input"></span></div>
                                                    <span class="input-group-addon">
	        									        <i class="fa fa-search"></i>
	        									    </span>
                                                </div>
                                            </form>
                                        </div>

                                        <a href="" class="cont-name">
                                            <div class="media">
		        					            <div class="media-body thread-head">
		        						            <h4 class="media-head">#thread1<small></small></h4>
		        					            </div>
		        					        </div>
                                        </a>

                                        <a href="" class="cont-name">
                                            <div class="media">
		        					            <div class="media-body thread-head">
		        						            <h4 class="media-head">#thread1<small></small></h4>
		        					            </div>
		        					        </div>
                                        </a>

                                        <a href="" class="cont-name">
                                            <div class="media">
		        					            <div class="media-body thread-head">
		        						            <h4 class="media-head">#thread1<small></small></h4>
		        					            </div>
		        					        </div>
                                        </a>

                                        <a href="" class="cont-name">
                                            <div class="media">
		        					            <div class="media-body thread-head">
		        						            <h4 class="media-head">#thread1<small></small></h4>
		        					            </div>
		        					        </div>
                                        </a>


                                        <div class="cont-footer">
                                            <button @click="showThreadForm = !showThreadForm" class="btn btn-xs btn-block btn-info">
                                                <span class="fa fa-plus fa-sm"></span>&nbsp;New Group Chat
                                            </button>
                                        </div>
                                    </div>
	                    	    </div>
                            </div>
	                    </div>

                        <div class="main-msg-body">
                            <div class="msg-head" style="background-color:rgb(13, 181, 202)">
                                <div class="msg-head-1">
                                    <div class="dropdown">
                                        <h4 class="media-head head-name">GO Team</h4>
                                    </div>
                                </div>

                                <div class="msg-head-2">
                                    <div class="dropdown pull-right">
		                                <button href="#" class="dropdown-toggle btn btn-simple btn-info btn-white btn-xs" data-toggle="dropdown" aria-expanded="true">
                                            <span class="fa fa-gears fa-xs"></span>
                                            <b class="caret"></b>
                                            <div class="ripple-container"></div>
                                        </button>
		                                <ul class="dropdown-menu dropdown-menu-right ">
		                                    <li><a href="#" data-toggle="modal" data-target="#membersAddModal" >New Member</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#membersEditModal" >Edit Members</a></li>
		                                    <li class="divider"></li>
		                                    <li><a href="#" data-toggle="modal" data-target="#confirmLeaveModal">Leave</a></li>
		                                </ul>
								    </div>

                                    <div class="dropdown pull-right">
                                        <button href="#pablo" class="dropdown-toggle btn btn-simple btn-info btn-white btn-xs" data-toggle="dropdown" aria-expanded="true">
                                            <span class="fa fa-user-o fa-xs"></span>
                                            <div class="ripple-container"></div>
                                        </button>
		                                <ul id="membersDrop" class="dropdown-menu dropdown-menu-left">
		                                    <li><p class="memDrop"><span class="fa fa-star-o"></span> Yanna</p></li>
		                                    <li class="divider"></li>
		                                    <li><p class="memDrop">Yanna</p></li>
		                                    <li><p class="memDrop">Bebex</p></li>
		                                    <li><p class="memDrop">Hux</p></li>
		                                    <li><p class="memDrop">Ken</p></li>
		                                    <li><p class="memDrop">Ching</p></li>
		                                </ul>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="msg-display">
                                <div class="msg-wrap">
                                    <div class="media">

                                        <div class="pull-left">
		        						    <div class="avatar ">
		        							    <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						    </div>
                                        </div>

		        					    <div class="media-body their-msg">
		        						    <p class="msg-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia eligendi magni, doloribus explicabo consectetur quibusdam eos facere ipsa amet debitis totam aliquid eius, eveniet sed mollitia dolore ratione possimus reiciendis.</p>
                                        </div>

                                        <div class="their-time-sent-div">
		        							<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
		        					    </div>

		        					</div>
                                </div>

                                <div class="msg-wrap">
                                    <div class="media">
		        					    <div class="pull-left">
		        						    <div class="avatar ">
		        							    <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						    </div>
                                        </div>
                                        <div class="media-body their-msg">
                                            <a href="images/sample.jpg" title="Click to download" download>
                                                <img src="images/sample.jpg" class="msg-img" alt="" sizes="" srcset="">
                                            </a>
		        					    </div>
                                        <div class="their-time-sent-div">
		        							<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
		        					    </div>
		        					</div>
                                </div>
                                   
                                <div class="msg-wrap">
                                    <div class="media">
                                        <div class="pull-right">
		        						    <div class="avatar ">
		        							    <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						    </div>
                                        </div>
		        					    <div class="media-body my-msg my-msg-file">
                                            <a href="images/sample.docx" class="text-white filedisp" download>
                                                <span class="fa fa-file-text-o"></span>&nbsp;filename.docx
                                            </a>
                                        </div>
                                        <div class="my-time-sent-div">
		        							<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
		        					    </div>
		        					</div>
                                </div>

                                <div class="msg-wrap">
                                    <div class="media">
                                        <div class="pull-right">
		        						    <div class="avatar ">
		        							    <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						    </div>
                                        </div>
		        					    <div class="media-body my-msg">
		        						    <p class="msg-text text-right">Okiee!</p>
		        					    </div>
                                        <div class="my-time-sent-div">
		        							<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
		        					    </div>
		        					</div>
                                </div>

                                <div class="msg-wrap">
                                    <div class="media">
		        					    <div class="pull-left">
		        						    <div class="avatar ">
		        							    <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						    </div>
                                        </div>
                                        <div class="media-body their-msg">
		        						    <p class="msg-text">Lorem ipsum dolor sit</p>
                                        </div>
                                        <div class="their-time-sent-div">
		        							<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
		        					    </div>
                                    </div>
                                </div>

                                <div class="msg-wrap">
                                    <div class="date-sent mr-auto ml-auto">
                                        September 7, 2018
                                    </div>
                                </div>

                                <div class="msg-wrap">
                                    <div class="media">
                                        <div class="pull-left">
		        						    <div class="avatar ">
		        							    <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						    </div>
                                        </div>
		        					    <div class="media-body their-msg">
		        						    <p class="msg-text">Lorem ipsum dolor sitlorem Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus optio eum rerum fugit a consequuntur sapiente quam dignissimos</p>
                                        </div>
                                        <div class="their-time-sent-div">
		        							<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
		        					    </div>
		        					</div>
                                </div>

                                <div class="msg-wrap">
                                    <div class="media">
                                        <div class="pull-left">
		        						    <div class="avatar ">
		        							    <img class="media-object" alt="Tim Picture" src="images/pp.jpg">
		        						    </div>
                                        </div>
		        					    <div class="media-body their-msg">
		        						    <a href="images/sample.docx" class="text-gray filedisp" download>
                                                <span class="fa fa-file-text-o"></span>&nbsp;filename.docx
                                            </a>
		        					    </div>
                                        <div class="their-time-sent-div">
		        							<p class="time-sent"><span class="fa fa-clock-o"></span>&nbsp;3:15 PM</p>
		        					    </div>
		        					</div>
                                </div>
                            </div>

                            <div class="msg-input">

                                <div v-if="showFileChoser" class="form-group is-empty msg-input-wrap">
                                    <div class="input-group btn-block">
                                        <div class="form-group form-file-upload is-fileinput" style="background-color: #EAF3F2; padding: 6px;">
								            <input type="file" id="inputFile3" multiple="" class="form-control">
								            <div class="input-group">
									            <input type="text" readonly="" class="form-control" placeholder="Chosen files will be displayed here...">
									            <span class="input-group-btn input-group-s">
										            <button type="button" class="btn btn-xs btn-round btn-info">
										                Choose file(s)
										            </button>
									            </span>
								            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group is-empty msg-input-wrap">
                                    <button @click="showFileChoser = !showFileChoser" type="button" class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center">
                                        <i class="fa fa-paperclip"></i>
                                    </button>
                                    <textarea class="form-control" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                                    <button  class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
                                </div>

                                <!--Leave Confirmation Modal -->
                                <div class="modal fade" id="confirmLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-small ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h5>Are you sure you want to leave this group? </h5>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button type="button" class="btn btn-simple" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-success btn-simple">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--./end -->
                                
                                <!-- Edit Members Modal-->
                                <div class="modal fade in" id="membersEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right: 17px;">
                                    <div class="modal-dialog modal-small">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                                                <h5 class="modal-title" id="myModalLabel"><span class="fa fa-edit"></span>&nbsp;Edit Members</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="instruction">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="">
                                                                <div class="form-group">
                                                                    <input type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                                                                </div>
                                                                <div class="choose-mem" style="max-height: 200px; overflow:auto">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="optionsCheckboxes">
                                                                            <span class="check"></span>
                                                                            Bryxx
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="optionsCheckboxes">
                                                                            <span class="check"></span>
                                                                            Yanna
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="optionsCheckboxes">
                                                                            <span class="check"></span>
                                                                            Yce
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="optionsCheckboxes">
                                                                            <span class="check"></span>
                                                                            Kent
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                 <div class="row">
                                                                    <div class="col-md-6">
                                                                        <button type="button" class="btn btn-sm btn-danger btn-block btn-simple">Remove</button>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <button type="button" class="btn btn-sm btn-success btn-block btn-simple">Set Admin</button>
                                                                    </div>
                                                                </div>

                                                            </form>       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button type="button" class="btn btn-default btn-round btn-sm" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--./end-->

                                <!-- New Member Modal-->
                                <div class="modal fade in" id="membersAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right: 17px;">
                                    <div class="modal-dialog modal-small">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                                                <h5 class="modal-title" id="myModalLabel"><span class="fa fa-edit"></span>&nbsp;Add Members</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="instruction">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                                                            </div>
                                                            <div class="choose-mem" style="max-height: 200px; overflow:auto">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="optionsCheckboxes">
                                                                        <span class="check"></span>
                                                                        Bryxx
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="optionsCheckboxes">
                                                                        <span class="check"></span>
                                                                        Yanna
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="optionsCheckboxes">
                                                                        <span class="check"></span>
                                                                        Yce
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="optionsCheckboxes">
                                                                        <span class="check"></span>
                                                                        Lyching
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="optionsCheckboxes">
                                                                        <span class="check"></span>
                                                                        Hux
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="optionsCheckboxes">
                                                                        <span class="check"></span>
                                                                        Kent
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <div class="row input-group pull-right">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-block btn-default btn-simple btn-sm" data-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-block btn-info btn-sm">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--./end-->

                            </div>
                        </div>

                    </div>
                       
                </div>
            </div>

            <div class="col-md-3">
                <div class="mybox" v-show="showThreadForm">
                    <div class="mybox-head">
                        <h6><strong>NEW GROUP CHAT</strong></h6>
                    </div>
                    <div class="mybox-body white-white-bg">
                        <div class="form-group is-empty">
                            <label class="control-label">Group Name</label> 
                            <input type="text" class="form-control"> 
                            <span class="material-input"></span>
                            <span class="material-input"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Share with</label> 
                            <div class="btn-group bootstrap-select">
                                <select class="selectpicker" v-model="privacy" data-style="btn btn-sm btn-info btn-simple" type="text">
                                    <!-- <option selected disabled="">Privacy</option> -->
                                    <option value="all">All</option>
                                    <option value="">Web Team</option>
                                    <option value="">Creatives Team</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                        </div>
                        <div v-if="privacy === 'custom'">
                            <div class="form-group">
                                <input type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                            </div>
                            <div class="choose-mem" style="max-height: 130px; overflow:auto">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes">
                                        <span class="check"></span>
                                        Bryxx
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes">
                                        <span class="check"></span>
                                        Yanna
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes">
                                        <span class="check"></span>
                                        Yce
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes">
                                        <span class="check"></span>
                                        Lyching
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes">
                                        <span class="check"></span>
                                        Hux
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes">
                                        <span class="check"></span>
                                        Kent
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mybox-footer">
                        <div class="row form-group text-center">
                            <div class="col-md-12">
                                <button @click="showThreadForm = !showThreadForm" class="btn btn-info btn-simple btn-sm" type="button" value="submit">Close</button>
                                <button class="btn btn-info btn-sm" type="button" value="">OK!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>

<script>
export default {
    data () {
        return {
            privacy:"",
            showThreadForm: false,
            showFileChoser: false
        }
    },
    updated () {
        // $(this.$refs.select).selectpicker('refresh')
        // let sel  = this.$refs.select;
        // console.log(this.$refs);
        console.log('updated');
	}
}
</script>

<style scoped>
    .msg-img{
        max-width: 100%;
        /* max-width: 415px; */
        width: auto;
    }
    .their-msg-img{
        float: left;
    }
    p.memDrop{
        /* padding: 3px 9px !important; */
        margin: 1px 0 0 13px;
    }
    .msg-input-wrap{
        display: inline-flex;
        width: 100%;
    }
    .msg-input-wrap > textarea{
        width:90%;
    }
    .msg-input-wrap > button{
        width: 10%;
    }
    .btn-white, .btn-white:hover, .btn-white:focus{
        color: white !important;
        background-color:transparent;
    }
    .date-sent{
        padding: 3px auto;
        text-align: center;
        /* color:white; */
        color: #bfbfbf;
        /* background-color: rgba(255,255,255,0.2); */
        /* border-top: 1px dashed white; */
    }
    .my-time-sent-div,
    .their-time-sent-div{
        display:none;

        /* position: inline-block; */
    }
    .my-time-sent-div{
        float:right;
    }
    .their-time-sent-div{
        float:left;
    }
    .media:hover > .my-time-sent-div,
    .media:hover > .their-time-sent-div
    {
        display:block;
        position: relative;
        /* display: table-row-group; */
        transition-timing-function: ease-in-out;
        /* position: inline-block; */
        
    }

    .time-sent{
        font-size: 12px;
        margin: 5px 7px;
        /* color: white; */
        color: #bfbfbf;
        vertical-align: middle !important;
    }
    .msg-wrap{
        /* width: 100%; */
        /* border-bottom: 1px solid gray; */
        /* display: block; */
        margin-top: 8px;
    }

    .their-msg{
        background-color: #f5f5f5;
        /* border: 1px solid gray; */
        border: 1px solid #dee5e6;
        border-radius: 25px;
        border-top-left-radius: 1px;
        /* padding: 9px 15px; */
        padding: 6px 13px;
        width:auto;
        max-width: 330px;
        word-wrap: break-word;
        float: left;
    }

    .their-msg > p{
        font-size: 12px;
        color:rgb(51, 51, 51);
        margin: 0;
    }

    .my-msg{
        background-color: rgb(13, 181, 202);
        vertical-align: middle;
        /* border: 1px solid gray; */
        width:auto;
        float:right;
        border-radius: 25px;
        border-top-right-radius: 1px;
        /* padding: 9px 15px; */
        padding: 6px 13px;
        max-width: 330px;
        word-wrap: break-word;
        /* float: right; */
    }

    .my-msg > p{
        font-size: 12px;
        /* color:rgb(51, 51, 51); */
        color:white;
        margin: 0;
    }

    /* .msg-my-msg{
        background-color: #e4dcdc;
        border: 1px solid gray;
        border-radius: 10px;
        padding: 6px;
        max-width: 50%;
    } */
    .avatar{
        height: 25px;
        width: 25px;
    }
    .media .avatar{
        margin-right: 3px;
    }
    .media-head{
        font-size: 13px;
        line-height: 1.55em;
        margin-top: 5px;
        margin-bottom: 1px;
        font-weight: bold;
        color: rgb(37, 37, 37);
    }
    .media p.prev-msg{
        font-size: 13px;
    }





    .msg-main-body{
        padding: 0;
        display: flex;
        /* height: 80vh; */
        height: 530px;
    }
    .contacts-cont{
        width: 40%;
        position: relative;
    }
    .cont-head{
        padding: 0;
        /* height: 10%; */
    }
    .cont-body{
        height: 83%;
        /* padding: 10px; */
        overflow-y: auto;
        overflow-x: hidden;
        /* overflow-wrap: break-word; */
    }
    .cont-footer{
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50px;
        padding: 3px 7px 5px 7px;
        /* background-color: #23c0d4; */
    }
    .cont-search{
        height: 7%;
        /* margin-bottom: 5px; */
        padding-top: 5px;
        /* padding-bottom: -5px; */
        padding-left: 13px;
        padding-right: 5px;
        /* background-color: rgb(197, 194, 194); */
    }

    .main-msg-body{
        width: 75%;
        border-left: 1px solid #e4dcdc;
        /* padding: 2px; */
        position: relative;
    }
    .msg-head{
        /* padding: 6px 10px; */
        display: flex;
        width: 100%;
        /* height: 10%; */
        /* color: white; */
        height: 45px;
        background-color: rgba(255, 255, 255, 0.2);
    }
    .msg-head-1{
        width: 50%;
        padding: 8px 10px;
        position: inline-block;
    }
    .msg-head-2{
        width: 50%;
        padding: 0px 10px;
        position: inline-block;
        /* justify-items: right;  */
    }

    .head-name{
        vertical-align: middle;
        /* margin: 14px 10px; */
        color: white;
    }
    .msg-display{
        display: relative;
        /* height: 78%; */
        height: 415px;
        width: 100%;
        background-color: rgba(255,255,255,0.3);
        overflow-x:hidden;
        overflow-y: auto;
        padding: 13px 5px;
    }
    .msg-input{
        vertical-align: middle;
        background-color: white;
        box-sizing: border-box;
        padding: 2px 10px;
        position: absolute;
        bottom: 0;
        /* right: 0; */
        /* height: 12%; */
        min-height: 70px;
        width: 100%;
        justify-items: self-start;
        /* background-color: rgb(231, 231, 231); */
        -webkit-box-shadow-top: 0 6px 10px 0 rgba(0, 0, 0, 0.14);
        box-shadow-top: 0 6px 10px 0 rgba(0, 0, 0, 0.14);
    }
    .msg-input > textarea{
        /* display: block; */
        /* height: 30px; */
        /* width: 70%;
        border-radius: 3px;
        border: 1px solid gray;
        padding: 3px 5px; */
    }
    /* .msg-input-wrap{
        height: 90px;
        padding: 4px 7px;
        width: 100%;
    } */
    .contact-list > li a{
        display: block;
        width: 100%;
        border-bottom: 1px solid gray;
    }
    .cont-name:hover .media{
        /* background-color: #f7f7f7; */
        background-color: #eeeeee;
    }


    .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover{
        background-color: #ffffff;
        color: #23c0d4;
        font-weight: bold;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .nav-pills:not(.nav-pills-icons) > li > a {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .nav-pills > li > a{
        color: #908f8f;
    }

    .nav-pills > li > a:hover{
        font-size: 13px;
        font-weight: 700;
        transition-timing-function: ease-in-out;
    }

    .thread-head{
        padding: 5px 12px;
    }
    .unread-label{
        padding: .2em .6em .3em;
    }
    ::-webkit-scrollbar-track{
        display: none;
    }
    .modal-content .modal-body {
        padding-top: 0px;
    }
    .filedisp{
        font-size: 13px;
        transition: font-size 0.7s;
        -webkit-transition: font-size 0.7s;
    }
    .filedisp:hover{
        font-size: 15px;
    }
    </style>


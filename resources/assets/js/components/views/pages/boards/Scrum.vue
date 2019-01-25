<template>
    <section class="main-main-container kanban-component" style="background-color: rgb(67, 160, 185);">
        <div class="board-background-image" style="background-image: url('/images/above-art1.jpg');">
            
            <div class="board-background-overlay">
            </div>

            <div class="board-wrapper" v-if="board">
                <router-view></router-view>

                <div class="board-header">
                    <div class="board-name">
                        <h4 class="" style=""><span class="fa fa-trello"></span>&nbsp;{{ board.name }}</h4>
                    </div>
                    <div class="board-info">
                        <button v-if="viewBAbout==false" @click="viewBAbout = !viewBAbout" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-info-circle fa-xs"></span> 
                            About <span class="fa fa-angle-down"></span>
                        </button>
                        <button v-else @click="viewBAbout = !viewBAbout" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-info-circle"></span> About <span class="fa fa-angle-up"></span>
                        </button>
                    </div>
                    <div class="board-info">
                        <button @click="viewMemmod = !viewMemmod" class="btn btn-white btn-simple btn-xs">
                            <span class="fa fa-user-plus fa-xs"></span> New Member
                        </button>
                    </div>
                    <div class="board-info">
                        <a @click.prevent="vFS = !vFS" class="btn btn-white btn-simple btn-xs"><span class="fa fa-"></span> {{ vFS ? 'Hide Closed Sprint' : 'Show Closed Sprint' }}</a>
                    </div>
                    <div class="board-info">
                        <a @click="viewBSettings = !viewBSettings" class="btn btn-white btn-simple btn-round btn-xs" title="Board Settings"><span class="fa fa-gears fa-xs"></span> Board Settings</a>
                    </div>
                </div>

                <div class="row" v-if="viewBAbout">
                    <div class="col-md-8 col-sm-12 text-white" style="white-space: pre-line">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem explicabo sint nisi accusantium excepturi libero temporibus adipisci fugiat ipsum magni.</p>
                        <hr/>
                        <p>Admin: 
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                        </p>
                        <br/>
                        <p>Product Owner: 
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                        </p>
                        <br/>
                        <p>Scrum Master: 
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                        </p>
                        <br/>
                        <p>Dev Team: 
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                            <span>
                                <a href="#" title="Samantha Millos" data-original-title="Samantha Millos" data-toggle="tooltip" data-placement="bottom">
                                    <img class="medium-avatar" src="/images/default.png" alt="Samantha Millos"/>
                                </a>
                            </span>
                        </p>  
                    </div>
                </div>

                <div v-show="viewBAbout==false">
                    <router-link :to="{name: 'scrumboard_newsprint'}" class="btn btn-success btn-sm"> + Add New Sprint</router-link>
                    <div v-if="vFS" id="scrumListDiv" class="board-body">
                        <sprint-card v-for="(sprint) in scrumLists" :key="sprint.id" :sprint="sprint"></sprint-card>
                    </div>
                    <div v-else id="scrumListDiv" class="board-body">
                        <sprint-card v-for="(sprint) in scrumLists" v-if="sprint.finished_at == null" :key="sprint.id" :sprint="sprint"></sprint-card>
                    </div>
                </div>

                <transition name="fade">    
                    <div class="overlay" v-show="viewBSettings">   
                        <div class="boardsettings">
                            <form>
                                <div class="row">
                                    <div class="col-md-11">
                                        <h4><span class="fa fa-gears"></span> Settings - Scrum Board 1 
                                        </h4>
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <a class="btn btn-danger btn-simple btn-round btn-xs btn-just-icon" @click="viewBSettings = !viewBSettings"><span class="fa fa-times-circle"></span></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="control-label text-grey"><span class="fa fa-trello"></span> Name:</label>
                                                <input type="text" value="Sample Scrum Board" class="my-input my-inp-blk">
                                                <label class="control-label text-grey"><span class="fa fa-align-left"></span> Description:</label>
                                                <textarea rows="3" class="my-text-area my-inp-blk">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae earum, natus culpa recusandae ipsa fugit nisi? Facilis, nihil dignissimos! Voluptatibus magni blanditiis placeat doloribus autem voluptate beatae earum iste tempore.
                                                </textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label text-grey"><span class="fa fa-image"></span> Background Image:</label>
                                                <div data-provides="fileinput" class="fileinput fileinput-new text-left">
                                                    <div>
                                                        <span class="btn btn-raised btn-block btn-xs btn-round btn-default btn-file">
                                                            <span class="fileinput-new">Change</span> 
                                                            <span class="fileinput-exists">Change</span> 
                                                            <input type="file" name="...">
                                                            <div class="ripple-container"></div>
                                                        </span>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised text-center" style="max-height: 100px; width: auto;"></div> 
                                                    <div class="fileinput-new thumbnail img-raised text-center">
                                                        <img src="/images/above-art1.jpg" alt="..." style="height: 100px; width: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label text-grey">
                                                    <span class="fa fa-unlock-alt"></span> 
                                                    Permissions:
                                                </label>
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
	                                                <div class="panel panel-default">
	                                                    <div class="panel-heading" role="tab" id="headingOne">
	                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="">
	                                                            <h4 class="panel-title">
	                                                                Product Owner Permissions
	                                                                <i class="fa fa-caret-down"></i>
	                                                            </h4>
	                                                        </a>
	                                                    </div>
	                                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="">
	                                                        <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On Sprints</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Comment
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On User Stories</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On Tasks</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Comment
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
                                                    <div class="panel panel-default">
	                                                    <div class="panel-heading" role="tab" id="headingTwo">
	                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="">
	                                                            <h4 class="panel-title">
	                                                                Scrum Master Permissions
	                                                                <i class="fa fa-caret-down"></i>
	                                                            </h4>
	                                                        </a>
	                                                    </div>
	                                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">
	                                                        <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On Sprints</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Comment
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On User Stories</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On Tasks</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Comment
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
                                                    <div class="panel panel-default">
	                                                    <div class="panel-heading" role="tab" id="headingThree">
	                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="">
	                                                            <h4 class="panel-title">
	                                                                Development Team Permissions
	                                                                <i class="fa fa-caret-down"></i>
	                                                            </h4>
	                                                        </a>
	                                                    </div>
	                                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false" style="">
	                                                        <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On Sprints</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Comment
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On User Stories</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="text-center">On Tasks</p>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            View
				            	                                            </label>
				                                                        </div>
							                                            <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Add
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Modify
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Comment
				            	                                            </label>
				                                                        </div>
                                                                        <div class="togglebutton">
				            	                                            <label>
				                	                                            <input type="checkbox" checked>
									                                            Delete
				            	                                            </label>
				                                                        </div>
                                                                    </div>
                                                                </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border-left: 1px solid #f8f8f8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-striped">
		                                            <thead style="position: sticky; top:0">
		                                                <tr>
		                                                    <th><span class="fa fa-user-o"></span> Member</th>
		                                                    <th>Role</th>
		                                                    <th>Set Role</th>
		                                                    <th class="text-right">Actions</th>
		                                                </tr>
		                                            </thead>
		                                            <tbody>
		                                                <tr>
		                                                    <td><span class="fa fa-star text-warning" rel="tooltip" title="Board Admin"></span>&nbsp;Andrew Mike</td>
		                                                    <td>Dev Team</td>
		                                                    <td>
                                                                <select name="" id="" class="my-thin-select">
                                                                    <option value="">Dev Team</option>
                                                                    <option value="">Scrum Master</option>
                                                                    <option value="">Product Owner</option>
                                                                </select>
		                                                    </td>
                                                            <td class="td-actions text-right">
                                                                <button class="btn btn-xs btn-info btn-simple">Set as Admin</button>
		                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-xs btn-just-icon btn-simple btn-round" data-original-title="Remove Member" title="Remove Member">
		                                                            <i class="fa fa-times"></i>
		                                                        </button>
		                                                    </td>
		                                                </tr>
                                                        <tr>
		                                                    <td>Catriona Gray</td>
		                                                    <td>Member</td>
		                                                    <td>
                                                                <select name="" id="" class="my-thin-select">
                                                                    <option value="">Dev Team</option>
                                                                    <option value="">Scrum Master</option>
                                                                    <option value="">Product Owner</option>
                                                                </select>
                                                            </td>
		                                                    <td class="td-actions text-right">
                                                                <button class="btn btn-xs btn-danger btn-simple">Remove as Admin</button>
		                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-xs btn-just-icon btn-simple btn-round" data-original-title="Remove Member" title="Remove Member">
		                                                            <i class="fa fa-times"></i>
		                                                        </button>
		                                                    </td>
		                                                </tr>
		                                            </tbody>
		                                        </table>
                                            </div>
                                            <div class="col-md-11">
                                                <hr/>
                                                <div class="form-group text-right">
                                                    <label class="control-label text-grey">
                                                        <span class="fa fa-user-plus text-left"></span> New Member:</label>
                                                    <input type="search" style="height: 28px; margin-top: 7px" placeholder="Search..." class="my-input">
                                                    <span><button class="btn btn-info btn-sm">
                                                        ADD SELECTED
                                                    </button></span>
                                                </div>
                                                <div class="choose-mem" style="max-height: 100px; overflow:auto">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="optionsCheckboxes">
                                                            <span class="check"></span>
                                                            <img src="/images/default.png" class="small-avatar"/> Not member 1
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="optionsCheckboxes">
                                                            <span class="check"></span>
                                                            <img src="/images/default.png" class="small-avatar"/> Not member 1
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="optionsCheckboxes">
                                                            <span class="check"></span>
                                                            <img src="/images/default.png" class="small-avatar"/> Not member 1
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>        
                </transition>

                <transition name="fade" v-if="viewMemmod">
                    <div class="overlay">
                        <div class="membersmod">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>New Member</h4>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" text-left">
                                        <span>
                                            <select name="" id="" class="my-thin-select">
                                                <option value="">Dev Team</option>
                                                <option value="">Scrum Master</option>
                                                <option value="">Product Owner</option>
                                            </select>
                                        </span>
                                        <input type="search" style="height: 28px; margin-top: 7px" placeholder="Search..." class="my-input">
                                        <span><button class="btn btn-info btn-sm">
                                            ADD
                                        </button></span>
                                    </div>
                                    <div class="choose-mem" style="">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                <img src="/images/default.png" class="small-avatar"/> Not member 1
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                <img src="/images/default.png" class="small-avatar"/> Not member 2
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                <img src="/images/default.png" class="small-avatar"/> Not member 2
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <p class="text-success"><span class="fa fa-check"></span> A new member has been successfully added.</p>
                                    <!--<p class="text-danger"><span class="fa fa-times"></span> There's a problem adding the member.</p>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button @click="viewMemmod=!viewMemmod" class="btn btn-xs btn-danger btn-simple">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>

            </div>
            
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import Card from './scrum/Card.vue';
import VueApexCharts from 'vue-apexcharts';
// Vue.use(VueApexCharts);
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        sprintCard: Card,
        apexchart: VueApexCharts
        // gallery: Gallery
    },
    data() {
        return {
            vFS: false,
            viewBDChart: false,
            viewBSettings: false,
            viewBAbout: false,
            viewMemmod: false
        }
    },
    created() {
        this.$store.dispatch('getScrumLists', this.$route.params.board_id);
        this.$store.dispatch('getBoardMembers', this.$route.params.board_id);
        this.$store.dispatch('getCBoard', this.$route.params.board_id);
    },
    mounted() {
        this.stopEvents();
        this.listenEvents();
    },
    destroyed() {
        this.stopEvents();
        this.$store.commit('boardDestroyed');
        this.$store.commit('scrumBoardDestroyed');
    },
    computed: {
        ...mapGetters({
                scrumLists: 'getScrumLists',
                boardMembers: 'boardMembers',
                board: 'getCBoard',
            }),
        computeTaskLength() {
            let totalTask = 0
            if(this.scrumLists) {
                if(this.vFS) {
                    this.scrumLists.forEach(list => {
                        totalTask += list.tasks.length
                    });
                }
                else {
                    this.scrumLists.forEach(list => {
                        if(!list.finished_at) {
                            totalTask += list.tasks.length
                        }
                    });
                }
            }
            return totalTask;
        }
    },
    methods: {
        addListDiv(){
            this.listDivs.push({
                name: "",
                about: ""
            });
            this.scrollToEnd()
        },

        scrollToEnd(){
            // var listdiv = document.querySelector(".list-div")
            var taskdiv = document.querySelector("#scrumListDiv")
            // var scrollWidth = tas?kdiv.scrollHeight + 200
            taskdiv.scrollLeft = taskdiv.scrollWidth + 300
        },
        listenEvents() {
            Echo.private('list.'+this.$route.params.board_id)
                .listen('UpdateListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprintTask', e.task);
                })
                .listen('AddSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addsprint', e.sprint);
                })
                .listen('UpdateSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('updateSprint', e.sprint);
                })
                .listen('FinishSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('setScrumLists', JSON.parse(e.sprints));
                })
                .listen('DeleteSprintEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteSprint', e.sprint);
                })
                .listen('AddListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('addSprintTask', e.task);
                })
                .listen('SprintTaskOrderEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('setScrumLists', JSON.parse(e.sprints));
                })
                .listen('DeleteListTaskEvent', (e) => {
                    // console.log(e);
                    this.$store.commit('deleteSprintTask', e.task_id);
                })
        },
        stopEvents() {
            Echo.leave('list.'+this.$route.params.board_id)
        }
    }
}
</script>

<style scoped lang="scss">
.overlay{
    position: absolute;
    top:0;
    left:0;
    // min-height: 100%;
}
</style>




<template>
    <transition name="fade">    
        <div class="overlay">   
            <div class="boardsettings">
                <form>
                    <div class="row">
                        <div class="col-md-11">
                            <h4><span class="fa fa-gears"></span> Settings - Scrum Board 1 
                            </h4>
                        </div>
                        <div class="col-md-1 text-right">
                            <a class="btn btn-danger btn-simple btn-round btn-xs btn-just-icon" @click="$router.go(-1)"><span class="fa fa-times-circle"></span></a>
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
</template>

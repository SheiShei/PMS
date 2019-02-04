<template>
    <transition name="fade">    
        <div class="overlay">   
            <div class="boardsettings">
                <form>
                    <div class="row">
                        <div class="col-md-11">
                            <h4><span class="fa fa-gears"></span> Settings - {{ boardData.name }}</h4>
                        </div>
                        <div class="col-md-1 text-right">
                            <a class="btn btn-danger btn-simple btn-round btn-xs" @click="$emit('close')"><span class="fa fa-times-circle"></span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label text-grey"><span class="fa fa-trello"></span> Name:</label>
                                    <input type="text" v-model="boardData.name" class="my-input my-inp-blk">
                                    <label class="control-label text-grey"><span class="fa fa-align-left"></span> Description:</label>
                                    <textarea rows="4" class="my-text-area my-inp-blk">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae earum, natus culpa recusandae ipsa fugit nisi? Facilis, nihil dignissimos! Voluptatibus magni blanditiis placeat doloribus autem voluptate beatae earum iste tempore.
                                    </textarea>
                                </div>
                                <div class="col-md-3">
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
                                        <span class="fa fa-unlock-alt"></span> Permissions:
                                    </label>
                                    <p class="note">Set here the actions members can do in this board.</p>
                                    <p>Members can:</p>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    View Tasks
	            	                    </label>
	                                </div>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    Add Tasks
	            	                    </label>
	                                </div>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    Modify Tasks
	            	                    </label>
	                                </div>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    Comment Tasks
	            	                    </label>
	                                </div>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    Delete Tasks
	            	                    </label>
	                                </div>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    Add Lists
	            	                    </label>
	                                </div>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    Modify Lists
	            	                    </label>
	                                </div>
                                    <div class="togglebutton">
	            	                    <label>
	                	                    <input type="checkbox" checked>
						                    Delete Lists
	            	                    </label>
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
	                                            <th></th>
	                                            <th class="text-right">Actions</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <tr>
	                                            <td><span class="fa fa-star text-warning" rel="tooltip" title="Board Admin"></span>&nbsp;Andrew Mike</td>
	                                            <td>Admin</td>
                                                <td>
                                                    <button class="btn btn-xs btn-info btn-simple">Set as Admin</button>
                                                </td>
                                                <td class="td-actions text-right">
	                                                <button type="button" rel="tooltip" class="btn btn-danger btn-xs btn-just-icon btn-simple btn-round" data-original-title="Remove Member" title="Remove Member">
	                                                    <i class="fa fa-times"></i>
	                                                </button>
	                                            </td>
	                                        </tr>
                                            <tr>
	                                            <td>Catriona Gray</td>
	                                            <td>Member</td>
                                                <td>
                                                    <button class="btn btn-xs btn-danger btn-simple">Remove as Admin</button>
                                                </td>
	                                            <td class="td-actions text-right">
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

<script>
export default {
    props: ['boardData', 'boardMembers']
}
</script>

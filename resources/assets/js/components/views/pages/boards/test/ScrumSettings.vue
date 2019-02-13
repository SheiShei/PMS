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
                            <a href="" class="btn btn-danger btn-simple btn-round btn-xs btn-just-icon" @click.prevent="$emit('close')"><span class="fa fa-times-circle"></span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label text-grey"><span class="fa fa-trello"></span> Name:</label>
                                    <input @input="onInput" v-model="boardData.name" type="text" value="Sample Scrum Board" class="my-input my-inp-blk">
                                    <label class="control-label text-grey"><span class="fa fa-align-left"></span> Description:</label>
                                    <textarea @input="onInput" v-model="boardData.description" rows="3" class="my-text-area my-inp-blk">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae earum, natus culpa recusandae ipsa fugit nisi? Facilis, nihil dignissimos! Voluptatibus magni blanditiis placeat doloribus autem voluptate beatae earum iste tempore.
                                    </textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label text-grey"><span class="fa fa-image"></span> Background Image:</label>
                                    <div data-provides="fileinput" class="fileinput fileinput-new text-left">
                                        <div>
                                            <span class="btn btn-raised btn-block btn-xs btn-round btn-default btn-file">
                                                <span class="fileinput-new">Change</span> 
                                                <span class="fileinput-exists">Change</span> 
                                                <input type="file" name="..." @change="onImageChanged">
                                                <div class="ripple-container"></div>
                                            </span>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised text-center" style="max-height: 100px; width: auto;"></div> 
                                        <div class="fileinput-new thumbnail img-raised text-center">
                                            <img v-if="boardData.board_image" :src="boardData.board_image" alt="..." style="height: 100px; width: auto;">
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
	                                    <div class="panel panel-default" v-for="role in role_permissions" :key="role.id">
	                                        <div class="panel-heading" role="tab" id="headingOne">
	                                            <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#'+role.id" aria-expanded="false" class="">
	                                                <h4 class="panel-title">
	                                                    {{ role.name }} Permissions
	                                                    <i class="fa fa-caret-down"></i>
	                                                </h4>
	                                            </a>
	                                        </div>
	                                        <div :id="role.id" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="">
	                                            <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p class="text-center">On Sprints</p>
                                                            <div class="togglebutton" v-for="permission in permissions" :key="permission.id" v-if="permission.type == 'sprint'">
	            	                                            <label>
	                	                                            <input :value="permission.id" @change="permArrChanged(role.id, role.permissions)" type="checkbox" v-model="role.permissions">
						                                            {{ permission.name }}
	            	                                            </label>
	                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p class="text-center">On User Stories</p>
                                                            <div class="togglebutton" v-for="permission in permissions" :key="permission.id" v-if="permission.type == 'us'">
	            	                                            <label>
	                	                                            <input :value="permission.id" @change="permArrChanged(role.id, role.permissions)" type="checkbox" v-model="role.permissions">
						                                            {{ permission.name }}
	            	                                            </label>
	                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p class="text-center">On Tasks</p>
                                                            <div class="togglebutton" v-for="permission in permissions" :key="permission.id" v-if="permission.type == 'task'">
	            	                                            <label>
	                	                                            <input :value="permission.id" @change="permArrChanged(role.id, role.permissions)" type="checkbox" v-model="role.permissions">
						                                            {{ permission.name }}
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
	                                        <tr v-for="member in boardData.bu" :key="member.id">
	                                            <td><span v-if="member.pivot.isAdmin" class="fa fa-star text-warning" rel="tooltip" title="Board Admin"></span>&nbsp;{{ member.name }}</td>
	                                            <td>{{ member.pivot.role.name }}</td>
	                                            <td>
                                                    <select @change="changeRole(member.id, member.pivot.role.id, member.pivot.isAdmin)" v-model="member.pivot.role.id" name="" id="" class="my-thin-select">
                                                        <option v-for="role in role_permissions" :key="role.id" :value="role.id">{{ role.name }}</option>
                                                    </select>
	                                            </td>
                                                <td class="td-actions text-right">
                                                    <button @click.prevent="setAsAdmin(member.pivot.isAdmin, member.id, member.pivot.role.id)" v-if="!member.pivot.isAdmin" class="btn btn-xs btn-info btn-simple">Set as Admin</button>
                                                    <button @click.prevent="setAsAdmin(member.pivot.isAdmin, member.id, member.pivot.role.id)" v-else class="btn btn-xs btn-info btn-danger">Remove as Admin</button>
	                                                <button @click="removeBoardMember(member.id)" type="button" rel="tooltip" class="btn btn-danger btn-xs btn-just-icon btn-simple btn-round" data-original-title="Remove Member" title="Remove Member">
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
                                        <input @input="onSearch" v-model="search" type="search" style="height: 28px; margin-top: 7px" placeholder="Search..." class="my-input">
                                        <span><button @click.prevent="addBoardMember" class="btn btn-info btn-sm">
                                            ADD SELECTED
                                        </button></span>
                                    </div>
                                    <div class="choose-mem" style="max-height: 100px; overflow:auto">
                                        <div class="checkbox" v-for="user in not_members" :key="user.id">
                                            <label>
                                                <input v-model="newMembers" type="checkbox" :value="user.id">
                                                <span class="check"></span>
                                                <img :src="user.picture" class="small-avatar"/> {{ user.name }}
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
	props: ['boardData', 'boardMembers', 'permissions', 'role_permissions', 'not_members'],
	data() {
		return {
			image: '',
            newMembers: [],
            search: ''
		}
	},
	methods: {
		updateBoardDetails() {
            let form = new FormData;
            form.append('image', this.image[0]);
            form.append('name', this.boardData.name);
            form.append('desc', this.boardData.description);
            form.append('id', this.$route.params.board_id);
            this.$store.dispatch('uBoard', form)
                .then((response) => {
                    this.boardData.board_image = response.board_image
                })
        },

        onImageChanged (event) {
            this.image = event.target.files
            this.updateBoardDetails();
        },

        onInput: _.debounce(function() {
            this.updateBoardDetails();
		}, 500),
		
		permArrChanged(id, permissions) {
            this.$store.dispatch('PermissionChanged', {role_id: id, permissions_id: permissions})
		},
		
		removeBoardMember(id) {
            this.$store.dispatch('removeBoardMember', {board_id: this.$route.params.board_id, user_id: id});
        },

        setAsAdmin(isAdmin, user_id, role_id) {
            this.$store.dispatch('setAsAdmin', {
                board_id: this.$route.params.board_id,
                user_id: user_id,
                isAdmin: isAdmin,
                role_id: role_id
            })
                .then(() => {
                    let memberId = _.findIndex(this.boardData.bu, {id: user_id});
                    this.boardData.bu[memberId].pivot.isAdmin = Boolean(!isAdmin)
                })
		},
		
		onSearch: _.debounce(function() {
            this.$store.dispatch('getBoardNotMembers', {board_id: this.$route.params.board_id, search: this.search})
        }, 500),

        addBoardMember() {
            if(this.newMembers) {
                this.$store.dispatch('addBoardMember', {board_id: this.$route.params.board_id, ids: this.newMembers})
                    .then(() => {
                        this.newMembers = []
                    })
            }
		},
		
		changeRole(id, role_id, admin) {
			this.$store.dispatch('changeRole', {board_id: this.$route.params.board_id, user_id: id, role_id: role_id, admin: admin})
		}
	}
}
</script>

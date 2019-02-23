<template>
    <transition name="fade">    
        <div class="overlay">
            <div class="close-mod-btn">
                 <button type="button" @click="$emit('close')" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button>
                <!-- <button @click="$router.go(-1)" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button> -->
            </div>   
            <div class="boardsettings">
                <form>
                    <div class="row">
                        <div class="col-md-11">
                            <h4><span class="fa fa-gear"></span> Settings - {{ boardData.name }}</h4>
                        </div>
                        <!-- <div class="col-md-1 text-right">
                            <a class="btn btn-danger btn-simple btn-round btn-xs" @click="$emit('close')"><span class="fa fa-times-circle"></span></a>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label text-grey"><span class="fa fa-trello"></span> Name:</label>
                                    <input @input="onInput" type="text" v-model="boardData.name" class="my-input my-inp-blk">
                                    <label class="control-label text-grey"><span class="fa fa-align-left"></span> Description:</label>
                                    <textarea @input="onInput" rows="4" class="my-text-area my-inp-blk" v-model="boardData.description"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label text-grey"><span class="fa fa-image"></span> Background Image:</label>
                                    <div data-provides="fileinput" class="fileinput fileinput-new text-left">
                                        <div>
                                            <span class="btn btn-raised btn-block btn-xs btn-round btn-default btn-file">
                                                <span class="fileinput-new">Change</span> 
                                                <span class="fileinput-exists">Change</span> 
                                                <input type="file" @change="onImageChanged">
                                                <div class="ripple-container"></div>
                                            </span>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised text-center" style="width: 100%;"></div> 
                                        <div class="fileinput-new thumbnail img-raised text-center">
                                            <img v-if="boardData.board_image" :src="boardData.board_image" alt="..." style="width: 100%;">
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
                                    <div class="togglebutton" v-for="permission in permissions" :key="permission.id">
	            	                    <label>
	                	                    <input v-model="role_permissions.permissions" @change="permArrChanged(role_permissions.id)" :value="permission.id" type="checkbox">
						                    {{ permission.name + ' ' + permission.type }}
	            	                    </label>
	                                </div>
                                </div>
                            </div>
                            <br/>
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
	                                        <tr v-for="member in boardData.bu" :key="member.id">
	                                            <td><span v-if="member.pivot.isAdmin" class="fa fa-star text-warning" rel="tooltip" title="Board Admin"></span>&nbsp;{{ member.name }}</td>
	                                            <td>{{ member.pivot.role.name }}</td>
                                                <td><span v-if="member.id != boardData.created_by">
                                                    <button @click.prevent="setAsAdmin(member.pivot.isAdmin, member.id, member.pivot.role.id)" v-if="!member.pivot.isAdmin" class="btn btn-xs btn-info btn-simple">Set as Admin</button>
                                                    <button @click.prevent="setAsAdmin(member.pivot.isAdmin, member.id, member.pivot.role.id)" v-else class="btn btn-xs btn-info btn-danger">Remove as Admin</button></span>
                                                </td>
                                                <td class="td-actions text-right">
	                                                <button v-if="member.id != boardData.created_by" @click="removeBoardMember(member.id)" type="button" rel="tooltip" class="btn btn-danger btn-xs btn-just-icon btn-simple btn-round" data-original-title="Remove Member" title="Remove Member">
	                                                    <i class="fa fa-times"></i>
	                                                </button>
	                                            </td>
	                                        </tr>
	                                    </tbody>
	                                </table>
                                </div>
                                <div class="col-md-12">
                                    <hr/>
                                    <div class="form-group text-center">
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
    created() {
    },
    methods: {
        updateBoardDetails() {
            let form = new FormData;
            if(this.image) {
                form.append('image', this.image[0]);
            }
            form.append('name', this.boardData.name);
            form.append('desc', this.boardData.description);
            form.append('id', this.$route.params.board_id);
            this.$store.dispatch('uBoard', form)
                .then((response) => {
                    this.boardData.board_image = response.board_image
                    this.image = '';
                })
        },

        onImageChanged (event) {
            this.image = event.target.files
            this.updateBoardDetails();
        },

        onInput: _.debounce(function() {
            this.updateBoardDetails();
        }, 1000),

        permArrChanged(id) {
            this.$store.dispatch('PermissionChanged', {role_id: id, permissions_id: this.role_permissions.permissions})
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
        }
    }
}
</script>

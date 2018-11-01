<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-user-o"></span> Employees <small>Manage Employees</small></h2>
        </div>

        <div class="col-md-9">
            <div class="mybox">
                <div class="mybox-head userlist row">
                    <div class="ul-item col-md-6">
                        <h6><strong>USERS LIST</strong></h6> 
                    </div>  
                </div>
                <users-table>
                    <tr v-for="user in users" :key="user.id">
                        <td class="text-center">{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role.name }}</td>
                        <td>{{ user.created_at }}</td>
                        <td class="td-actions text-right">
                            <button @click="updateUser(user)" type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button @click="deleteUser(user.id)" type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                    </tr>                       
                </users-table>
                <div class="mybox-footer userlist-ft">
                        
                </div>
            </div> 
        </div>
    
        <div class="col-md-3">
            <div class="mybox">
                <form class="form" @submit.prevent="add? addNewUser() : saveUpdateUser()">
                    <div class="mybox-head">
                        <h6 v-if="add" class="noprint"><strong>ADD NEW USER</strong></h6>
                        <h6 v-else class="noprint"><strong>UPDATE USER # {{ form.id }}</strong></h6>
                    </div>
                    <div class="mybox-body white-white-bg">
                        <div class="form-group is-empty">
                            <label class="control-label">Name</label>
                            <input v-model="form.name" required type="text" class="form-control">
                            <span class="material-input"></span>
                            <p v-if="errors.name"><small v-for="(error, i) in errors.name" :key="i">{{ error }}</small></p>
                        </div>  
                            
                        <div class="form-group is-empty">
                            <label class="control-label">Email</label>
                            <input v-model="form.email" required type="email" class="form-control">
                            <span class="material-input"></span>
                            <p v-if="errors.email"><small v-for="(error, i) in errors.email" :key="i">{{ error }}</small></p>
                        </div>
                                    
                        <div class="form-group is-empty">
                            <label class="control-label">Password</label>
                            <input v-model="form.password" :required="!!add" minlength="6" type="password" class="form-control">
                            <span class="material-input"></span>
                            <p v-if="errors.password"><small v-for="(error, i) in errors.password" :key="i">{{ error }}</small></p>
                        </div>
                                
                        <div v-show="isTeam" class="btn-group bootstrap-select">
                            <select name="team" v-model="form.team" :required="!!add" class="selectpicker" data-style="btn btn-info btn-xs btn-simple" title="--Team--" data-size="7" tabindex="-98">
                                <option disabled="" value="" selected>--Team--</option>
                                <option value="1">Web</option>
                                <option value="2">Creatives</option>
                            </select>
                        </div>
                                    
                        <div v-show="isRole" class="btn-group bootstrap-select">
                            <select name="role" v-model="form.role" :required="!!add" class="selectpicker" data-style="btn btn-info btn-xs btn-simple" title="--Role--" data-size="7" tabindex="-98">
                                <option disabled="" value="" selected="">--Role--</option>
                                <option value="2">ACMA</option>
                                <option value="3">Reg. Employee</option>
                            </select>
                            <p v-if="errors.role_id"><small v-for="(error, i) in errors.role_id" :key="i">{{ error }}</small></p>
                        </div>

                        <p v-if="add" class="note">NOTE: Only employee account can be added here.</p>         
                    </div>
                    <div class="mybox-footer">
                        <div class="row form-group text-center">
                            <div class="col-md-12">
                                <button v-if="add" class="btn btn-success btn-sm" type="submit">+ ADD</button>
                                <button v-else class="btn btn-success btn-sm" type="submit">+ UPDATE</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
import UsersTable from "./users/UsersTable.vue";
export default {
    components: {
        usersTable : UsersTable
    },

    data() {
        return {
            data: {
                filter: '',
                search: '',
            },
            form: {
                name: '',
                email: '',
                password: '',
                team: '',
                role: ''
            },
            isRole: true,
            isTeam: true,
            errors: [],
            eUser: '',
            add: true

        }
    },  

    created() {
        let data = this.data;
        this.$store.dispatch('setUsers', {url : '/api/shittycaptivateusers', data});
    },

    computed: {
        ...mapGetters({
                users: 'usersList'
            }),
    },

    methods: {
        addNewUser() {
            this.$store.dispatch('addUser', this.form)
                .then((response) => {
                    // console.log(response)
                    this.errors = [];
                    this.form.name = '';
                    this.form.email = '';
                    this.form.password = '';
                    this.form.team = '';
                    this.form.role = ''
                    this.$toaster.success('New User added!.')
                })

                .catch((error) => {
                    // console.log(error)
                    this.errors = error;
                })
        },

        updateUser(user) {
            if(this.form.email != user.email){
                this.add = false;
                this.eUser = user;
                this.form.id = user.id;
                this.form.name = user.name;
                this.form.email = user.email;
                this.form.password = '';
                this.form.role = user.role_id;
                this.form.team = user.department_id;
                if(user.role_id == 2 || user.role_id == 3){
                    $(this.$el).find('select[name=role]').val(user.role_id+'');
                    this.isRole = true;
                    $(this.$el).find('.selectpicker').selectpicker('refresh');
                }
                else{
                    this.isRole = false;
                }

                if (user.department_id) {
                    $(this.$el).find('select[name=team]').val(user.department_id+'');
                    this.isTeam = true;
                    $(this.$el).find('.selectpicker').selectpicker('refresh');
                }
                else{
                    this.isTeam = false;
                }
                
            }
            else {
                this.eUser = [];
                this.form.name = '';
                this.form.email = '';
                this.form.password = '';
                $(this.$el).find('select[name=role]').val('');
                this.isRole = true;
                $(this.$el).find('select[name=team]').val('');
                this.isTeam = true;
                $(this.$el).find('.selectpicker').selectpicker('refresh');
                this.add = true;
            }
        },

        saveUpdateUser() {
            // console.log(this.form);
            this.$store.dispatch('updateUser', this.form)
                .then((response) => {
                    // console.log(response)
                    this.eUser = [];
                    this.add = true;
                    this.isTeam = true;
                    this.isRole = true;
                    this.errors = [];
                    this.form.name = '';
                    this.form.email = '';
                    this.form.password = '';
                    this.form.team = '';
                    this.form.role = ''
                    this.$toaster.success('User updated succesfully!.')
                })

                .catch((error) => {
                    // console.log(error)
                    this.errors = error;
                })
        },

        deleteUser(id) {
            this.$store.dispatch('deleteUser', id)
                .then((response) => {
                    this.$toaster.warning('User deleted succesfully!.')
                })
        }
    }
}
</script>

<style scoped>
.form-group>p, .bootstrap-select>p {
    font-style: italic;
    color: red;
}
</style>

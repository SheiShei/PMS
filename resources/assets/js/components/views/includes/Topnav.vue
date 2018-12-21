<template>
    <nav class="navbar navbar-info sm-hidden" id="nav-admin">
        <div class="container-fluid">
            <div class="navbar-header">
            </div>

            <div class="collapse navbar-collapse" id="navigation-example-2">
                <ul class="nav navbar-nav navbar-left">
                        <li>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group form-white">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="fa fa-search"></span>
                                    </div>
                                </form>
                            </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                       
                    <li class="dropdown">
                        <a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown">
                            <div class="profile-photo-small">
                                <img :src="cUser.picture" alt="profile-picture" class="img-circle img-responsive">
                            </div>
                        <div class="ripple-container"></div>
                        </a>
                        <ul class="dropdown-menu">
                           
                            <li>
                                <a href="#">Profile</a>
                            </li>
                            <li>
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a @click.prevent="logout">Logout</a></li>
                        </ul>
                    </li>
               </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    methods: {
        logout() {
            this.$store.dispatch('removeToken')
                .then(response => {
                    this.$router.push('/login');
                })
        }
    },

    computed: {
        ...mapGetters({
                cUser: 'currentUser'
            }),
    }
}
</script>



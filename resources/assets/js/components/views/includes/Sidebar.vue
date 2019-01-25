<template>
    <section class="nav-side-menu" style="">
        <div class="brand">
            <img src="/images/logooo2.png" width="100px"/>
        </div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list"  v-if="cUser">
            <ul id="menu-content" class="menu-content collapse out">

                <li class="profile-link">
                    <a href="/profile"><img src="/images/default.png"/></a>
                    <p>Samantha Millos<span>ADMIN</span></p>
                    <!-- <p><small>ACMA</small></p> -->
                </li>


                <!-- <li class=""> -->
                    <router-link :to="{ name: 'dashboard' }" tag="li" active-class="active" exact>
                        <i class="fa fa-dashboard fa-lg"></i>&nbsp;&nbsp;&nbsp;Dashboard
                    </router-link>

                    <router-link :to="{ name: 'profile_user' }" tag="li" active-class="active" exact>
                        <i class="fa fa-gears fa-lg"></i>&nbsp;&nbsp;&nbsp;Profile & Settings
                    </router-link>
                <!-- </li> -->
            
                <!-- <li class="" v-if="cUser.role.id === 1"> -->
                    <router-link :to="{ name: 'users' }" v-if="cUser.role.id === 1" tag="li" active-class="active">
                        <i class="fa fa-user-o fa-lg"></i>&nbsp;&nbsp;&nbsp;Employees
                    </router-link>
                <!-- </li> -->
                    <router-link :to="{ name: 'workbook' }" tag="li" active-class="active">
                        <i class="fa fa-book fa-lg"></i>&nbsp;&nbsp;&nbsp;Workbook
                    </router-link>

                    <router-link :to="{ name: 'messages'}" tag="li" active-class="active" >
                        <i class="fa fa-commenting-o fa-lg"></i>&nbsp;&nbsp;&nbsp;Messages
                        <!--Will appear when new message was sent-->
                        <span class="new-msg-dot fa fa-circle fa-xs text-warning"></span>
                    </router-link>

                    <router-link :to="{ name: 'brands' }" v-if="cUser.role.id !== 4" tag="li" active-class="active">
                        <i class="fa fa-suitcase fa-lg"></i>&nbsp;&nbsp;&nbsp;Brands 
                        <!-- <span class="arrow"></span> -->
                    </router-link>

                    <router-link :to="{ name: 'all_jo_list' }" v-if="cUser.role.id !== 4" tag="li" active-class="active">
                        <i class="fa fa-copy fa-lg"></i>&nbsp;&nbsp;&nbsp;Job Order 
                        <!-- <span class="arrow"></span> -->
                    </router-link>

                    <!-- <ul class="sub-menu collapse" id="brandsList">
                    <li data-toggle="collapse" class="collapsed">
                        <router-link :to="{ name: 'brands' }" >
                            <i class="fa fa-circle-o fa-lg"></i>&nbsp;&nbsp;&nbsp;Overview
                        </router-link>
                    </li>
                    <li data-toggle="collapse" class="collapsed">
                        <router-link :to="{ name: 'brands' }">
                            <i class="fa fa-circle-o fa-lg"></i>&nbsp;&nbsp;&nbsp;Blue Books
                        </router-link>
                    </li>
                </ul> -->

                <!-- <li class="" v-if="cUser.role.id !== 4"> -->
                    <router-link :to="{ name: 'boards' }" v-if="cUser.role.id !== 4" tag="li" active-class="active">
                        <i class="fa fa-trello fa-lg"></i>&nbsp;&nbsp;&nbsp;Boards
                    </router-link>
                <!-- </li> -->
                <!-- <li v-if="cUser.role.id !== 4" data-toggle="collapse" data-target="#boardsList" class="collapsed">
                    <a><i class="fa fa-trello fa-lg"></i> Boards <span class="arrow"></span></a>
                </li> -->
                
                <!-- <ul class="sub-menu collapse" id="boardsList">
                    <li data-toggle="collapse" data-target="#activeProj" class="collapsed">Web Projects</li> -->
                    <!-- <ul class="sub-menu collapse projList" id="activeProj">
                        <li data-toggle="collapse" data-target="#service" class="collapsed pl-10">
                            [K] Kanban Board1
                        </li>
                        <li data-toggle="collapse" data-target="#service" class="collapsed pl-10">
                            [S] Scrum Board1
                        </li>
                    </ul> -->
                    <!-- <li data-toggle="collapse" data-target="#" class="collapsed">My Board</li>
                    <li data-toggle="collapse" data-target="#" class="collapsed">
                        <router-link :to="{ name: 'kanboard' }">
                            <i class="fa fa-circle-o fa-lg"></i> Creatives Board
                        </router-link>
                    </li>
                </ul>  -->

                <!-- <li v-if="cUser.role.id !== 4" data-toggle="collapse" data-target="#brandsList" class="collapsed"> -->
                    <!-- <router-link :to="{ name: 'brands' }" v-if="cUser.role.id !== 4" data-toggle="collapse" data-target="#brandsList" class="collapsed" tag="li" active-class="active">
                        <i class="fa fa-suitcase fa-lg"></i>&nbsp;&nbsp;&nbsp;Brands <span class="arrow"></span>
                    </router-link> -->
                <!-- </li>  -->


                <!-- <li v-if="cUser.role.id !== 4"> -->
                    <router-link :to="{ name: 'workload' }" v-if="cUser.role.id !== 4" tag="li" active-class="active">
                        <i class="fa fa-align-left fa-lg"></i>&nbsp;&nbsp;&nbsp;Workload
                    </router-link>
                <!-- </li> -->

                <!-- <li class=""> -->
                    <!-- <router-link :to="{ name: 'messages'}" tag="li" active-class="active" >
                        <i class="fa fa-commenting-o fa-lg"></i>&nbsp;&nbsp;&nbsp;Messages
                    </router-link> -->
                <!-- </li> -->

                <!-- <li class="">
                    <a href="/">
                        <i class="fa fa-dashboard fa-lg"></i> Issues
                    </a>
                </li>

                <li class="">
                    <a href="/">
                        <i class="fa fa-dashboard fa-lg"></i> Notice Boards
                    </a>
                </li>

                <li class="">
                    <a href="/">
                        <i class="fa fa-dashboard fa-lg"></i> Reports
                    </a>
                </li> -->

                <!-- <li class=""> -->
                    <router-link :to="{ name: 'sticky_notes' }" tag="li" active-class="active" exact>
                        <i class="fa fa-sticky-note-o fa-lg"></i>&nbsp;&nbsp;&nbsp;Sticky Notes
                    </router-link>
                <!-- </li> -->

                <!-- <li class="" > -->
                    <!-- <router-link :to="{ name: 'dashboard' }" tag="li" active-class="active" exact> -->
                    <!-- <a><i class="fa fa-gear fa-lg"></i>&nbsp;&nbsp;&nbsp;Settings</a> -->
                    <!-- </router-link> -->
                <!-- </li> -->

                <li class="">
                    <a @click.prevent="logout">
                        <i class="fa fa-sign-out fa-lg"></i>&nbsp;&nbsp;&nbsp;Log Out
                    </a>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    data(){
        return{
            linkActiveClass: "active",
            linkExactActiveClass: "exact-active"
        }
    },
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

<style scoped lang="scss">
.profile-link{
    padding: 10px auto !important;
    text-align: center;
    img{
        margin-top: 5px;
        height: 40px; 
        width: 40px;
        border-radius: 50%;
    }
    p{
        margin-top: 3px;
        margin-bottom: 5px;
    }
    p span{
        display: block;
    }
    span{
        line-height: 10px;
        font-size: 9px;
        text-transform: uppercase;
    }
}
.profile-link:hover{
    background-color: unset;
    cursor:default;

}

</style>

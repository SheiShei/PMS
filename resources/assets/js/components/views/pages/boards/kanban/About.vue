<template>
    <transition name="fade">
        <div class="overlay">
            <div class="close-mod-btn">
                 <button type="button" @click="$emit('close')" class="btn btn-simple btn-just-icon btn-default" title="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="aboutmod">
                <div class="row">
                    <div class="col-md-12">
                        <div class="taskchart shadow bl-gray">
                            <h4 class="no-margin"><span class="fa fa-trello"></span> Kanban Board {{ board.name }} - Details</h4>
                            <p class="no-margin text-gray">{{ board.description }}</p>
                        </div>
                    </div>
                </div> 
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="taskchart shadow">
                            <h6 class="txt-bold"><span class="fa fa-history"></span> Activities</h6>
                            <hr/>
                            <div class="actlist">
                                <div class="actdiv" v-for="notif in board.notifications" :key="notif.id">
                                    <div class="act-left">
                                        <div class="act-icon" :class="notif.data.color">
                                            <i class="fa medium-avatar" :class="notif.data.icon" alt=""></i>
                                        </div>
                                    </div>
                                    <div class="act-right">
                                        <p>{{ notif.data.text }}</p>
                                        <p class="acttime"><small>
                                            <span class="fa fa-clock-o"></span>&nbsp;{{ notif.created_at | moment('calendar') }} </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="taskchart shadow">
                            <h6 class="txt-bold"><span class="fa fa-user-o"></span> Members</h6>
                            <hr/>
                            <div class="membbb">
                                <div class="membdiv" v-for="user in board.bu" :key="user.id">
                                    <div class="memb-left">
                                        <img :src="user.picture" class="medium-avatar" alt="">
                                    </div>
                                    <div class="memb-right">
                                        <p class="text-default membsender"><span class="txt-bold">{{ user.name }}</span></p>
                                        <p class="mainmemb" v-if="user.pivot.isAdmin" >Admin</p>
                                        <p class="mainmemb" v-else >Member</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ['board'],
    created() {
        this.$store.dispatch('getCBoard', this.$route.params.board_id)
    }
}
</script>


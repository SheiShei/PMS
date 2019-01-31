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
                        <a @click.prevent="vFS = !vFS" class="btn btn-white btn-simple btn-xs"><span class="fa fa-"></span> {{ vFS ? 'Hide Closed Sprint' : 'Show Closed Sprint' }}</a>
                    </div>
                    <div class="board-info">
                        <router-link :to="{name: 'scrum_settings'}" class="btn btn-white btn-simple btn-round btn-xs" title="Board Settings"><span class="fa fa-gears fa-xs"></span> Board Settings</router-link>
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
                    <div id="scrumListDiv" class="board-body">
                        <sprint-card v-for="sprint in sprints" :key="sprint.id" :sprint="sprint"></sprint-card>
                    </div>
                </div>

                

                <!-- <div id="scrumListDiv" class="board-body">
                    <sprint-card v-for="sprint in sprints" :key="sprint.id" :sprint="sprint"></sprint-card>
                </div> -->
                <!-- <div v-else id="scrumListDiv" class="board-body">
                    <sprint-card v-for="(sprint) in scrumLists" v-if="sprint.finished_at == null" :key="sprint.id" :sprint="sprint"></sprint-card>
                </div> -->
            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import Card from './test/Card.vue';
import {mapGetters} from 'vuex';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        sprintCard: Card
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
    computed: {
        ...mapGetters({
                sprints: 'getScrumLists',
                boardMembers: 'boardMembers',
                board: 'getCBoard',
            }),
        computeUSLength() {
            let totalTask = 0
            if(this.sprints) {
                this.sprints.forEach(list => {
                    totalTask += list.us.length
                });
            }
            return totalTask;
        }
    },
    methods: {
        scrollToEnd(){
            // var listdiv = document.querySelector(".list-div")
            var taskdiv = document.querySelector("#scrumListDiv")
            // var scrollWidth = tas?kdiv.scrollHeight + 200
            taskdiv.scrollLeft = taskdiv.scrollWidth + 300
        },
    }
}
</script>

<style scoped lang="scss">
    
</style>
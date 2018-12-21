<template>
    <div class="modal fade in" id="membersAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right: 17px;">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                    <h5 class="modal-title" id="myModalLabel"><span class="fa fa-edit"></span>&nbsp;Add Members</h5>
                </div>
                <div class="modal-body">
                    <div class="instruction">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input v-model="searchNotMember" @input="search()" type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                                </div>
                                <div class="choose-mem" style="max-height: 200px; overflow:auto">
                                    <div class="checkbox" v-for="member in notMembers" :key="member.id">
                                        <label>
                                            <input type="checkbox" v-model="checkedNotMember" :value="member.id" name="optionsCheckboxes">
                                            <span class="check"></span>
                                            {{ member.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <div class="row input-group pull-right">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-default btn-simple btn-sm" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-info btn-sm" @click="addNotMembers()">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    data() {
        return {
            searchNotMember: '',
            checkedNotMember: [],
        }
    },
    watch: {
        '$route' (to, from) {
            this.getNotMembers();
        }
    },
    created() {
        this.getNotMembers();
    },
    computed: {
        ...mapGetters({
                notMembers: 'getNotMembers',
            }),
    },
    methods: {
        getNotMembers() {
            let data = {
                slug: this.$route.params.convo_id,
                search: this.searchNotMember
            };
            this.$store.dispatch('getNotMembers', data)
        },

        addNotMembers() {
            let data = {
                slug: this.$route.params.convo_id,
                ids: this.checkedNotMember
            };
            this.$store.dispatch('addConvoMember', data)
                .then ((response) => {
                    this.checkedNotMember = [];
                    $('#membersAddModal').modal('hide');
                })
        },
        search: _.debounce(function (e) {
            this.getNotMembers();
        }, 500),
    }
}
</script>

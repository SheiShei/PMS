<template>
    <div class="modal fade" id="confirmLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-small ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                </div>
                <div class="modal-body text-center">
                    <h5>Are you sure you want to leave this group? </h5>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-simple" data-dismiss="modal">Cancel</button>
                    <button @click="leaveConvo()" type="button" class="btn btn-success btn-simple">Yes</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    data () {
        return {
            checkedLeaveMember: []
        }
    },
    computed: {
        ...mapGetters({
                currentUser: 'currentUser',
            }),
    },
    methods: {
        leaveConvo() {
            this.checkedLeaveMember.push(this.currentUser.id);
            let data = {
                slug: this.$route.params.convo_id,
                ids: this.checkedLeaveMember
            };
            $('#confirmLeaveModal').modal('hide');
            this.$store.dispatch('removeMember', data)
                .then(() => {
                    this.$store.commit('leaveConvo', this.$route.params.convo_id);
                    this.$emit('leave');
                })
            
            // this.$router.push({name: 'messages'});

        },
    }
}
</script>
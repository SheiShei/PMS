<template>
    <transition name="fade">            
        <div class="overlay">
            <div class="modal-dialog modal-small " style="margin: 5% auto">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4 class="no-margin"><span class="fa fa-warning"></span> Warning</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p class="no-margin">Are you sure you want to delete this?</p>
                        <p class="txt-bold">All of its subtasks will also be deleted.</p>
                        <p class="">Do you still want to proceed?</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button @click="$router.go(-1)" type="button" class="btn btn-simple" data-dismiss="modal">Cancel</button>
                        <button @click="contDeleteUS" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    data() {
        return {
        }
    },

    methods: {
        contDeleteUS() {
            this.$store.dispatch('deleteUS', {id: this.$route.params.us_id, board_id: this.$route.params.board_id}) 
                .then((response) => {
                    this.$store.commit('deleteUS', response);
                    this.$router.push({name: 'test', params: {board_id: this.$route.params.board_id}});
                    this.$toaster.warning('User Story Deleted!');
                })
        }
    }
}
</script>
<style lang="scss" scoped>
.modal-small .modal-body{
        margin-top: 0;
    }
</style>

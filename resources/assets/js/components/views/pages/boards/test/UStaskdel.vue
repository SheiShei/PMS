<template>
    <transition name="fade">            
        <div class="overlay">
            <div class="modal-dialog modal-small " style="margin: 5% auto">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4 class="no-margin"><span class="fa fa-times-circle text-danger"></span> Warning!</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p class="no-margin">Are you sure you want to delete this?</p>
                        <p class="txt-bold">This task will permanently be deleted</p>
                        <p class="">Do you still want to proceed?</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button @click="$router.go(-1)" type="button" class="btn btn-sm btn-simple" data-dismiss="modal">Cancel</button>
                        <button @click="deleteUStask" type="button" class="btn btn-sm btn-success btn-simple">Delete</button>
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
        
        deleteUStask() {
            this.$store.dispatch('deleteSprintTask', {id: this.$route.params.ustask_id, board_id: this.$route.params.board_id})
                .then((response) => {
                    this.$store.commit('deleteCusTask', response)
                    this.$toaster.warning('Task deleted succesfully!.')
                    this.$router.go(-1)
                })
        },
    }
}
</script>
<style lang="scss" scoped>
.modal-small .modal-body{
        margin-top: 0;
    }
</style>

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
                        <p class="txt-bold">All of its tasks will also be deleted</p>
                        <p class="">Do you still want to proceed?</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button @click="$router.go(-1)" type="button" class="btn btn-sm btn-simple" data-dismiss="modal">Cancel</button>
                        <button @click="deleteList" type="button" class="btn btn-sm btn-success btn-simple">Delete</button>
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
        
         deleteList() {
            
            this.$store.dispatch('deleteList', this.$route.params.cardid)
                .then(() => {
                    this.$toaster.warning('List deleted succesfully!.')
                    this.$router.go(-1)

                })
                 .catch(() => {
                    alert('Cannot be deleted');
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

<template>
    <section class="main-main-container">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook</h2>
        </div>
        <router-view :workbook="workbook"></router-view>
        <div class="modal fade" id="WorkbookSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-small ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h3>Success!!</h3>
                    </div>
                    <div class="modal-body text-center">
                        <h5>Thank you for your feedback! </h5>
                    </div>
                    <div class="modal-footer text-center">
                        <!-- <button type="button" class="btn btn-simple" data-dismiss="modal">Cancel</button> -->
                        <button @click="success()" type="button" class="btn btn-success btn-simple">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import {mapGetters} from 'vuex';

export default {
    created() {
        this.$store.dispatch('getWorkbooks', this.data)
            .then(() => {
                this.$store.commit('setCWorkbook', this.$route.params.wb_id)
            })
    },
    computed: {
        ...mapGetters({
                workbook: 'getCWorkbook'
            }),
    },
    methods: {
        success() {
            $('#WorkbookSuccess').modal('hide');
            this.$router.push({name: 'workbook'});
        },
        // showRateModal() {
        //     var modal = `
        //     <div class="awn-modal-body awn-modal-confirm" style="max-width: 500px; padding-bottom: 24px">
        //         <i class="fa fa-fw fa-star"></i>
        //         <div class="awn-modal-title">
        //             Tell us what you think!
        //         </div>
        //         <div class="awn-modal-content">To ensure that we are doing everything that we can to exceed your expectations, please take a moment to RATE and COMMENT any suggestions you have.</div>
        //     </div>`
        //     this.$awn.modal(modal, 'custom-class-name')
        // }
    }
}
</script>

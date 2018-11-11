<template>
    <div class="modal fade in" id="membersEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right: 17px;">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                    <h5 class="modal-title" id="myModalLabel"><span class="fa fa-edit"></span>&nbsp;Edit Members</h5>
                </div>
                <div class="modal-body">
                    <div class="instruction">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="">
                                    <div class="form-group">
                                        <input type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                                    </div>
                                    <div class="choose-mem" style="max-height: 200px; overflow:auto">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                Bryxx
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                Yanna
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                Yce
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                <span class="check"></span>
                                                Kent
                                            </label>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-sm btn-danger btn-block btn-simple">Remove</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-sm btn-success btn-block btn-simple">Set Admin</button>
                                        </div>
                                    </div>

                                </form>       
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default btn-round btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

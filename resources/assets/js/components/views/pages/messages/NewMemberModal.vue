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
                                            Lyching
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes">
                                            <span class="check"></span>
                                            Hux
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
                            <button type="button" class="btn btn-block btn-info btn-sm">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

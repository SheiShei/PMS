<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form - Web <small>Panel</small></h2>
        </div>

        <div class="first-column col-md-1"></div>

        <div class="col-md-10">
            <div id="joform">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="noprint jo-head"><span class="fa fa-file-o"></span> Job Order Form <small>(Web)</small></h4>
                    </div>
                </div>
                <form>
                    <!--BRAND CLIENT ACMA -->
                    <div class="row form-row">
                        <div class="col-md-3 form-group">
                            <label for="brand">Brand:</label>
                            <div class="btn-group bootstrap-select">
                                <select class="selectpicker" data-style="btn btn-sm btn-info" type="text">
                                    <option value="">Furnitalia</option>
                                    <option value="">Fil-Global</option>
                                    <option value="">Allele</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="brand">Client:</label>
                            <div class="btn-group bootstrap-select">
                                <select class="selectpicker" data-style="btn btn-sm btn-info" type="text">
                                    <option value="">Aya</option>
                                    <option value="">Marley</option>
                                    <option value="">Kwini</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">ACMA / Brand Owner:</label>
                            <div class="btn-group bootstrap-select">
                                <select multiple class="selectpicker" data-style="btn btn-sm btn-info " type="text">
                                    <option value="">Aya</option>
                                    <option value="">Marley</option>
                                    <option value="">Kwini</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="" class="align-right">JO No.</label>
                            <img class="pull-right" style="height: 70px" src="/images/above-art1.jpg" alt="">
                        </div>
                    </div>
                    <!--./end of BRAND CLIENT ACMA -->

                    <hr />

                    <div class="row form-row">
                        <!--TIME IN and DUE -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for=""><span class="fa fa-calendar-o text-success"></span> Date In
                                    <small><i> (day-month-year)</i></small></label>
                                <input class="form-control" type="date" />
                            </div>
                            <div class="form-group">
                                <label for=""><span class="fa fa-calendar-o text-danger"></span> Date Due
                                    <small><i> (day-month-year)</i></small></label>
                                <input class="form-control" type="date" />
                            </div>
                        </div>
                        <!--./end of TIME IN and DUE -->

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="rqst_type">Request Type:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Information Update
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Page Deletion
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Additional Page
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Contact Details Change
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            URL & Domain Change
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Setup Mail (Zoho)
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                            Others
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rqst_type">TECH:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        Request for Domain Purchase
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        With Previous Domain
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rqst_type">Domain Transfer:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        Domain Unlocked
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        Auth/EPP Code Provided
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rqst_type">Domain Renewal:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        Domain for Renewal
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        Change Domain
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col md-12">
                                    <div class="">
                                        <div class="col-md-4">
                                            <h6 class="text-default">OLD HOST cPANEL</h6>
                                            <div class="form-group">
                                                <label for="" class="">Username</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-default">NEW HOST cPANEL</h6>
                                            <div class="form-group">
                                                <label for="" class="">Username</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-default">Tracker</h6>
                                            <div class="form-group">
                                                <label for="" class="">Date Commerced</label>
                                                <input type="date" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Date Ended</label>
                                                <input type="date" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    <br />
                                    <div class="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="">NOTES & ACTION POINTS:</label>
                                                <textarea class="form-control" rows="4" placeholder="Write your notes here..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-row text-center">
                        
                    </div>
                </form>

                
            </div>
        </div>
        <div class="col-md-1">

        </div>
    </section>
</template>

<style scoped>
    @media print{
        .nav-side-menu, noprint{
            display: none;
        }
    }
    table{
        border: 1px solid gray !important;
    }
    #joform{
        box-sizing: border-box;
        width: 100%;
        min-height: 85vh;
        background-color:white;
        border: 1px solid white;
        padding: 10px 20px;
        margin-left: 5px;
        margin-top: 20px;
        padding-bottom: 60px;
    }
    label{
        color: #868686 !important;
        font-weight: 700 !important;
        font-size: 0.9em !important;
    }

    .btn-group, .btn-group-vertical {
        position: relative;
        margin: 2px 1px;
    }

    label > small{
        font-weight: normal;
    }
    .jo-barcode{
        margin-top: 10px;
        margin-right: 10px;
        width: 100px;
        height: 100px;
        border: 1px solid gray;
    }
    .jo-head{
        border-bottom: 1px dashed #cac8c8;
        margin-bottom: 12px;
    }
    .btn-group bootstrap-select{
        margin-top: 0px !important;
        margin-bottom: 7px !important;
    }
    div.checkbox > label{
        font-weight: normal !important;
    }
</style>


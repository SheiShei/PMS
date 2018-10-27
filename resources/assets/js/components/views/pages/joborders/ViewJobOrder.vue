<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form</h2>
        </div>

        <div class="first-column col-md-1"></div>

        <div class="col-md-10">
            <div id="joform">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="noprint jo-head"><span class="fa fa-file-o"></span> [081118] MFI Revision
                    <small class="pull-right">Status: <span class="label label-warning">In Progress</span></small></h4>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <p><span class="txt-bold">Brand :</span> Furnitalia</p>
                            <p><span class="txt-bold">Client :</span> Robert Fereno</p>
                            <p><span class="txt-bold">ACMA/Brand Owner :</span> Aya, Lysan</p>
                        </div>
                        <div class="col-md-5">
                            <p><span class="txt-bold">Date In :</span> August 11, 2016</p>
                            <p><span class="txt-bold">Date Due :</span> August 30, 2016</p>
                            <p><span class="txt-bold">Request Type :</span> 
                                Additional Page, Contact Details Change</p>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="align-right">JO No.</label>
                            <img class="pull-right" style="height: 70px" src="/images/above-art1.jpg" alt="">
                        </div>
                    </div>
                </div>
        
                <div class="col-md-12">
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p><span class="txt-bold">TECH :</span>  Request for Domain Purchase</p>
                            <p><span class="txt-bold">Domain Transfer :</span> Domain Unlocked</p>
                            <p><span class="txt-bold">Domain Renewal :</span> Change Domain</p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="txt-bold">OLD HOST cPANEL</span>
                            </p>
                            <p><span class="txt-bold">Username :</span> furnweb18</p>
                            <p><span class="txt-bold">Password :</span> furnfurnfurn123</p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="txt-bold">NEW HOST cPANEL</span></p>
                            <p><span class="txt-bold">Username :</span> webfurn81</p>
                            <p><span class="txt-bold">Password :</span> webfurnweb321</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p><span class="txt-bold">TRACKER</span></p>
                            <p><span class="txt-bold">Date Commenced :</span> August 12, 2016</p>
                            <p><span class="txt-bold">Date Ended :</span> -</p>
                        </div>
                        <div class="col-md-8">
                            <p><span class="txt-bold">NOTES & ACTION POINTS:</span></p>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam tenetur sit culpa accusamus modi nostrum autem quibusdam eaque? Nam, deserunt?</p>
                        </div>
                    </div>
                </div>
            </div>
        
            </div>
        </div>

        <div class="col-md-1"></div>
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
        min-height: 65vh;
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
    .txt-bold{
        font-weight: bold !important;
        font-size: 12px;
    }
</style>


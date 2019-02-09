<template>
    <section class="main-main-container">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook <small></small></h2>
        </div>
        <div class="container-fluid">
            <div class="main2">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="taskchart shadow">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="nm-top"><strong><span class="fa fa-book"></span> WORKBOOKS LIST</strong>&nbsp;<span><small>| <a href="">Archive</a></small></span></h6>
                                </div>
                                <div class="col-md-8 text-right">
                                    <select class="my-input my-thin-select" name="" id="">
                                        <option value="" selected>Reviewed & For Review</option>
                                        <option value="">Reviewed</option>
                                        <option value="">For Review</option>
                                    </select>
                                    <input type="search" class="my-input my-thin-input" placeholder="Search...">
                                    &nbsp;<span class="fa fa-search text-default"></span>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="max-height: 75vh; overflow-y: auto">
                                        <div class="torev2">
                                        <a href="#parent" class="torev2">
                                            <div class="torevdiv2">
                                                <div class="torev-left">
                                                    <div class="torev-icon">
                                                        <i alt="" class="fa fa-book medium-avatar"></i>
                                                    </div>
                                                </div>  
                                                <div class="torev-right">
                                                    <h6 class="wb-title txt-bold"><a>Potato Corner New Images</a> <span title="Reviewed by Client" class="fa fa-check-circle text-success"></span></h6> 
                                                    <p><small>by: Aya . Sept. 13, 2019 . Potato Corner</small></p>
                                                    <p class="hidden-lg hidden-md"><span><a class="btn btn-danger btn-simple btn-xs">Archive</a></span></p>
                                                </div>
                                                <div class="very-right hidden-sm hidden-xs text-right">
                                                <a @click.stop href="#child" title="Archive" class="btn btn-danger btn-simple btn-xs">
                                                    <span class="fa fa-trash-o"></span> Archive
                                                </a>
                                            </div>
                                            </div>
                                        </a>
                                        </div>
                                        <div class="torev2">
                                        <a href="#parent" class="torev2">
                                            <div class="torevdiv2">
                                                <div class="torev-left">
                                                    <div class="torev-icon">
                                                        <i alt="" class="fa fa-book medium-avatar"></i>
                                                    </div>
                                                </div>  
                                                <div class="torev-right">
                                                    <h6 class="wb-title txt-bold"><a>Potato Corner New Images</a></h6> 
                                                    <p><small>by: Aya . Sept. 13, 2019 . Potato Corner</small></p>
                                                    <p class="hidden-lg hidden-md"><span><a class="btn btn-danger btn-simple btn-xs">Archive</a></span></p>
                                                </div>
                                                <div class="very-right hidden-sm hidden-xs text-right">
                                                <a @click.stop href="#child" title="Archive" class="btn btn-danger btn-simple btn-xs">
                                                    <span class="fa fa-trash-o"></span> Archive
                                                </a>
                                            </div>
                                            </div>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="taskchart shadow">
                            <p class="txt-bold"><span class="fa fa-plus-square-o text-success"></span> Create New</p>
                            <hr>
                            <a class="btn btn-success btn-md btn-block">Create Workbook</a>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped lang="scss">
.wb-list-div{
    display: inline-flex;
    width: 100%;
    position: relative;
    p {
        margin: 0 0 4px;
    }
    // padding: 20px 20px;
    div.img{
        display: inline-block;
        width: 20%;
        padding: 10px 10px;
        img{
            height: 70px;
            margin: 5px auto;
        }
    }
    .wb-details{
        display: inline-block;
        width: 80%;
        padding: 10px 10px;
        .wb-title{
            margin-bottom: 3px;
            font-weight: bold;
            font-size: 15px;
        }
        .wb-title:hover{
            text-decoration: underline;
        }
    }
}
.wb-brand{
            margin-bottom: 0;
            font-size: 11px;
            margin:0 auto; 
        }

.wb-list-div:hover{
    background-color: #edf2f3;
}

.wb-list-div:hover .wb-delete{
    display: block;
}
.wb-delete{
    display: none;
    position: absolute; 
    top: 0; 
    right: 0;
}
.boxheadv2{
    padding: 5px 10px;
    h6{
        margin-top:4px;
    }
    select{
        border: 1px solid #efefef;
        padding: 4px;
        color: #9e9e9e;
        border-radius: 3px;
    }
    input[type="text"]{
        padding: 5px;
        line-height: normal;
        border: 1px solid #efefef;
        color: #9e9e9e;
        border-radius: 3px;
    }
    input[type="text"]::placeholder{
        color: #9e9e9e;
    }
}

</style>

@extends('layouts.app')

@section('title')
Brands Overview
@stop

@section('customcss')
.form-row{
    margin-top: 12px;
}
@stop

  
@section('content')
<section class="main-main-container" style="">
    <div class="title-head">
        <h2><span class="fa fa-files-o"></span> Brands<small> Panel</small></h2>
    </div>

    {{-- <div class="container"> --}}
        {{-- <div class="row"> --}}
            <div class="col-md-1"></div>
                <div class="first-column col-md-10">
                        <div class="mybox">
                            <div class="mybox-head">
                                <h6><strong>New Brand</strong></h6>
                            </div>
                            <div class="mybox-body white-bg">
                              <form action="" class="">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group row is-empty">
                                                <label for="" class="col-md-6 col-sm-6">Brand Name:</label>
                                                <input type="text" class="col-md-6 col-sm-6 my-input" placeholder="">
                                            </div>
                                            

                                            <hr class="divider">

                                            <div class="form-group row">
                                                    <label for="" class="col-md-6 col-sm-6">Client / Contact Person:</label>
                                                    <input type="text" class="col-md-6 col-sm-6 my-input">
                                                </div>
                                                {{-- <div class="divider">Contact Details</div> --}}
                                                <div class="form-group row">
                                                    <label class="col-md-6 col-sm-6">Email:</label>
                                                    <input type="email" class="col-md-6 col-sm-6 my-input" name="" id="">
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-md-6">Telephone:</label>
                                                        <input type="email" class="col-md-6 col-sm-6 my-input" name="" id="">
                                                    </div>
                                                <div class="form-group row">
                                                    <label class="col-md-6">Mobile Phone:</label>
                                                    <input type="email" class="col-md-6 col-sm-6 my-input" name="" id="">
                                                </div>

                                            <hr class="divider">

                                            <div class="form-group row">
                                                <label for="" class="col-md-6 col-sm-6">Brand Owner</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="btn-group bootstrap-select">
                                                            <select class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                                                    {{-- <option disabled="" selected="">-Select-</option> --}}
                                                                    <option selected disabled="">--  Brand Owner--</option>
                                                                    <option value="">Aya</option>
                                                                    <option value="">Kwini</option>
                                                                    <option value="">Lysan</option>
                                                                </select>
                                                    </div></div>
                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label for="" class="col-md-4">Logo (optional):</label>
                                                {{-- <div class="input-image">
                                                    <input type="file" format="jpeg" class="col-md-6" placeholder="">
                                                    <button class="btn btn-info btn-simple btn-input-file" type="button">Choose an Image...</button>
                                                </div> --}}
                                                <div class="col-md-8">
                                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail img-raised">
                                                            <img src="{{asset('images/logooo2.png')}}" alt="..." height="50">
                                                                </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised" style=""></div>
                                                            <div>
                                                                <span class="btn btn-sm btn-raised btn-round btn-default btn-file btn-info">
                                                                        {{-- <i class="fa fa-photo"></i> --}}
                                                                    <span class="fileinput-new">Select image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="hidden"><input type="file" format="jpeg" name="...">
                                                                    <div class="ripple-container"></div>
                                                                </span>
                                                                <a href="#pablo" class="btn btn-xs btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-md-4">About:</label>
                                                <textarea type="text" row="5" class="col-md-8 my-text-area" placeholder=""></textarea>
                                            </div>
                                                
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                              
                            </div>
                            <div class="mybox-footer text-right">
                                <button type="submit" href="" class="btn btn-success btn-md">Save Brand</button>
                            </div>
                        </form>
                        </div>
                    </div>
        {{-- </div> --}}
    {{-- </div> --}}
    <div class="col-md-1"></div>
</section>
@stop

@section('customjs')
@stop


@extends('layouts.app')

@section('title')
Brands
@stop

@section('customcss')
@stop

  
@section('content')

<section class="main-main-container" style="">

    <div class="title-head">
      <h2><span class="fa fa-suitcase"></span> Brands <small>Panel</small></h2>
    </div>

    <div class="first-column col-md-8 col-sm-12"> 
      {{-- <div class="col-md-12"> --}}
        <div class="mybox">
            {{-- <div class="row"> --}}
          <!--Three Boxes -->
            <div class="mybox-head">
                <h6><strong>SUMMARY</strong></h6>
            </div>
            <div class="mybox-body">
             {{-- <div class="row"> --}}
                {{-- <div class="col-md-4"> --}}
                  <div class="mycard mycard-full-info">
                      <div class="mc-head">
                        <p>ON SERVICE</p>
                      </div>
                      
                      <div class="mc-body">
                          <div class="mc-icon">
                            <i class="fa fa-folder-open-o"></i>
                          </div>
                          <div class="mc-num">
                            <h3 class="">53</h3>
                          </div>
                      </div>
                  </div>
                {{-- </div> --}}
                {{-- <div class="col-md-4"> --}}
                        <div class="mycard mycard-full-danger">
                                <div class="mc-head">
                                  <p> CLOSED </p>
                                </div>
                                
                                <div class="mc-body">
                                    <div class="mc-icon">
                                      <i class="fa fa-handshake-o"></i>
                                    </div>
                                    <div class="mc-num">
                                      <h3 class="">50</h3>
                                    </div>
                                </div>
                            </div>
                   {{-- <div class="mycard mycard-full-info">
                      <div class="mc-head">
                        <p>ON SERVICE</p>
                      </div>
                      
                      <div class="mc-body">
                          <div class="mc-icon">
                            <i class="fa fa-copy"></i>
                          </div>
                          <div class="mc-num">
                            <h2 class="">5</h2>
                          </div>
                      </div>
                  </div> --}}
                {{-- </div> --}}
                {{-- <div class="col-md-4"> --}}
                        <div class="mycard mycard-full-success">
                                <div class="mc-head">
                                  <p> TOTAL </p>
                                </div>
                                
                                <div class="mc-body">
                                    <div class="mc-icon">
                                      <i class="fa fa-copy"></i>
                                    </div>
                                    <div class="mc-num">
                                      <h3 class="">175</h3>
                                    </div>
                                </div>
                            </div>
                {{-- </div> --}}
            {{-- </div>  --}}
        </div>
          
            {{-- </div> --}}
          <!--End of Three Boxes -->
        </div>

        <div class="mybox">
            <div class="mybox-head">
                <h6><strong>BRANDS OVERVIEW</strong></h6>
                {{-- <h6><strong>RECENT PROJECTS</strong></h6> --}}
            </div>
            <div class="mybox-body">
                    <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Sort by:</span>
                                    <select class="my-input" name="" id="">
                                        <option value="">Name (A - Z)</option>
                                        <option value="">Name (Z - A)</option>
                                        <option value="">Date (Ascending)</option>
                                        <option value="">Date (Descending)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 text-right">
                                    <input type="search" class="my-input" placeholder="Search...">
                                    <span class="fa fa-search"></span>
                                </div>
                            </div>
                            </form>
               <div class="table-responsive" style="margin-top: 10px; max-height: 35vh; overflow:auto">
                {{-- <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="">Project Name</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><a href="">
                            <td class="text-center">1</td>
                            <td><a href="#">Hello Mars Proj</a></td>
                            <td>Aug. 12, 2019</td>
                            <td class="text-info">In Progress</td>
                        </a></tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td><a href="">Hello Venus Proj</a></td>
                            <td>Aug. 12, 2018</td>
                            <td class="text-info">In Progress</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td><a href="">Hello Venus Proj</a></td>
                            <td>Aug. 12, 2018</td>
                            <td class="text-info">In Progress</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td><a href="">Hello Venus Proj</a></td>
                            <td>Aug. 12, 2018</td>
                            <td class="text-info">In Progress</td>
                        </tr>
                    </tbody>
                </table> --}}
                <table class="table table-bordered table-brands">
                    <thead>
                        <th>ID</th>
                        <th>Brand Name</th>
                        <th>Deadline</th>
                        <th>Total JO</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Furnitalia</td>
                            <td>Dec. 7, 2018</td>
                            <td>9</td>
                            <td class="td-actions">
                                <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Mowelfund</td>
                            <td>Sept. 15, 2018</td>
                            <td>18</td>
                            <td class="td-actions">
                                <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Fil-Global</td>
                            <td>March. 2, 2016</td>
                            <td>67</td>
                            <td class="td-actions">
                                <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Potato Corner</td>
                            <td>Jan. 10, 2017</td>
                            <td>2</td>
                            <td class="td-actions">
                                <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Allele White</td>
                            <td>Feb. 12, 2018</td>
                            <td>7</td>
                            <td class="td-actions">
                                <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>

                </table>
                </div> 
                {{-- <p class="note">Listed here are the all brands.</p> --}}
            </div>
            <div class="mybox-footer">
               <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-sm btn-info pull-right" href="/brands/add" >+ New Brand</a>
                </div>
                </div> 
            </div>
            
        </div>

        {{-- </div> --}}
    </div>
    <div class="sec-column col-md-4 col-sm-12">
        {{-- <div class="col-md-12"> --}}
        
            <div class="mybox">
                    <div class="mybox-head">
                        <h6><strong>ACTIVE JOB ORDERS</strong></h6>
                    </div>
                    {{-- <hr class="" /> --}}
                    <div class="mybox-body white-bg">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="jo-list">
                                    <li>
                                        <a href="/view-jo">
                                            <span class="fa fa-file-o"></span>
                                            [090718] MFI Revision
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/view-jo">
                                            <span class="fa fa-file-o"></span>
                                            [102518] Furnitalia Revision
                                        </a>
                                    </li>
                                    <li>
                                        <a href="view-jo">
                                            <span class="fa fa-file-o"></span>
                                            [031318] Fil Revision
                                        </a>
                                    </li>
                                    <li>
                                        <a href="view-jo">
                                            <span class="fa fa-file-o"></span>
                                            [031318] Mowel Revision
                                        </a>
                                    </li>
                                    <li>
                                        <a href="view-jo">
                                            <span class="fa fa-file-o"></span>
                                            [031318] Policious Revision
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> 
                    </div> 
                    <div class="mybox-footer">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <a href="/brands/jos" class="btn btn-sm btn-info btn-md btn-simple">See All Job Order Forms</a>
                            </div>
                            <div class="col-md-12">
                                {{-- <a href="/users" class="btn btn-round btn-sm btn-info btn-md pull-right">+ Create New JO</a> --}}
                            </div>
                        </div>
                    </div>                                     
                </div>
          {{-- </div> --}}
          <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>NEW JOB ORDER</strong></h6>
                </div>
                {{-- <hr class="" /> --}}
                <div class="mybox-body white-bg">
                        <div class="row">
                                <div class="col-md-12">
                                        <p class="note">Select a JO type to create new Job Order form.</p>

                                    {{-- <div class="form-group">
                                            <label for="brand" style="color:#333">New JO for:</label>
                                                <div class="btn-group bootstrap-select">
                                                    <select class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                                            <option disabled="" selected="">-Select-</option>
                                                            <option selected disabled="">-- Brand --</option>
                                                            <option value="">Furnitalia</option>
                                                            <option value="">Fil-Global</option>
                                                            <option value="">Allele</option>
                                                        </select>
                                                </div>
                                        </div> --}}
                                        <div class="form-group">
                                                {{-- <label for="brand" style="color:#333">New JO for:</label> --}}
                                                    <div class="btn-group bootstrap-select">
                                                        <select class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                                                {{-- <option disabled="" selected="">-Select-</option> --}}
                                                                <option selected disabled="">-- JO Form Type --</option>
                                                                <option value="">JO (Web)</option>
                                                                <option value="">JO (Creatives)</option>
                                                                {{-- <option value="">PRF</option> --}}
                                                            </select>
                                                    </div>
                                            </div>
                    
                                </div>
                                
                              </div> 
                </div> 
                <div class="mybox-footer">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <a href="/new-jo-web" class="btn btn-sm btn-info btn-md">+ Create New JO</a>
                        </div>
                    </div>
                </div>                                     
            </div>
    </div>

</section>
@stop

@section('customjs')
@stop

@extends('layouts.app')

@section('title')
Dashboard
@stop

@section('customcss')
@stop

  
@section('content')

<section class="main-main-container" style="">

    <div class="title-head">
      <h2>Dashboard <small>Project Overviews</small></h2>
    </div>

    <div class="first-column col-md-8 col-sm-12"> 
      {{-- <div class="col-md-12"> --}}
        <div class="mybox">
            {{-- <div class="row"> --}}
          <!--Three Boxes -->
            <div class="mybox-head">
                <h6><strong>PROJECTS OVERVIEW</strong></h6>
            </div>
            <div class="mybox-body">
             {{-- <div class="row"> --}}
                {{-- <div class="col-md-4"> --}}
                  <div class="mycard mycard-full-primary">
                      <div class=""><span class="fa fa-copy"></span> Total Projects</div>
                      <div class="pull-right">
                          <h2>963</h2>
                      </div>
                  </div>
                {{-- </div> --}}
                {{-- <div class="col-md-4"> --}}
                    <div class="mycard mycard-full-info">
                        <div class=""><span class="fa fa-folder-open"></span> Active</div>
                        <div class="pull-right">
                            <h2>342</h2>
                        </div>           
                    </div>
                {{-- </div> --}}
                {{-- <div class="col-md-4"> --}}
                    <div class="mycard mycard-full-success">
                        <div class=""><span class="fa fa-folder"></span> Completed</div>
                        <div class="pull-right">
                          <h2>287,374</h2>
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
                <h6><strong>PROJECTS</strong></h6>
                {{-- <h6><strong>RECENT PROJECTS</strong></h6> --}}
            </div>
            <div class="mybox-body">
               <div class="table-responsive" style="height: 35vh; overflow:scoll">
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
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Deadline</th>
                        <th>Progress</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
                </div> 
            </div>
            <div class="mybox-footer">
               <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-xs btn-round btn-info pull-right" href="/addproject" >+ New Project</a>
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
                    <h6><strong>USERS OVERVIEW</strong></h6>
                </div>
                {{-- <hr class="" /> --}}
                <div class="mybox-body">
                        <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6">
                                    <h6><small>Total:</small> 15</h6>
                                    <h6><small>Active:</small> 15</h6>
                                  </div>
                                  <div class="col-md-6">
                                    <h6><small>Deactivated:</small> 15</h6>
                                    <h6><small>Teams:</small> 4</h6>
                                  </div>
                                  <a href="/users" class="btn btn-round btn-sm btn-info pull-right">Manage</a>
                                </div>
                              </div> 
                </div>                                      
            </div>
          {{-- </div> --}}
    </div>

</section>
@stop

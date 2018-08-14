@extends('layouts.app')

@section('title')
Dashboard - Captivate
@endsection

@section('content')

<section class="" style="position:relative; margin-top:-20px; height: 95vh">
    <div class="container-fluid">
        <div class="row">
            <!--Side Bar -->
            <div class="col-md-2 bg-dark" style="height: 95vh; overflow-y: auto; padding:0">
                <aside class="main-sidebar skin-blue navbar-left">
                    <section class="sidebar" style="height: auto;">
                       <ul class="nav sidebar-menu tree" style="color:white" data-widget="tree">
                            <li class="dropdown-header">PROJECTS</li>
                            
                        </ul>
                    </section>
                </aside>
            </div>
            <!--./Side Bar -->

            <!--Main-->
            <div class="content col-md-10">
                <!--Title-->
                <div class="content-title" style="height: 40px">
                    <h5 class="title"><strong>Dashboard</strong></h5>
                </div>
                <!--./Title-->

                <!--Content Body-->
                <div class="content-body">
                    <div class="row">
                        <section class="col-md-8 mr-auto ml-auto">

                            <!--Three Boxes -->
                            <h6><strong>PROJECTS OVERVIEW</strong></h6>
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 5px">
                                    <div class="mycard mycard-full-primary">
                                        <div class=""><span class="fa fa-copy"></span> Total Projects</div>
                                        <div class="pull-right">
                                            <h2>963</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-right: 5px">
                                    <div class="mycard mycard-full-info">
                                        <div class=""><span class="fa fa-folder-open"></span> Active</div>
                                        <div class="pull-right">
                                            <h2>342</h2>
                                        </div>           
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-right: 5px">
                                    <div class="mycard mycard-full-success">
                                        <div class=""><span class="fa fa-folder"></span> Completed</div>
                                        <div class="pull-right">
                                            <h2>287,374</h2>
                                        </div>               
                                    </div>
                                </div>
                            </div>
                            <!--End of Three Boxes -->

                            <!--Table for Ongoing Projects-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="featcont">
                                        <h6><strong>ONGOING PROJECTS</strong></h6>
                                        <div class="table-responsive" style="height: 180px; overflow:scoll">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="">Project Name</th>
                                                        <th>Due Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td><a href="#">Hello Mars Proj</a></td>
                                                        <td>Aug. 12, 2019</td>
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
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td><a href="">Hello Venus Proj</a></td>
                                                        <td>Aug. 12, 2018</td>
                                                        <td class="text-info">In Progress</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="pull-right btn btn-xs btn-info" data-toggle="modal" data-target="#addProject">+ New Project</button>
                                    </div>
                                </div>
                            </div>
                            <!--./table for Ongoing Projects-->
                            
                        </section> 

                        <section class="col-md-4 mr-auto ml-auto">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6><strong>USERS OVERVIEW</strong></h6>
                                    <hr class="divider" />
                                    {{-- <div class="featcont"> --}}
                                        <div class="col-md-6">
                                            <h6><small>Total:</small> 15</h6>
                                            <h6><small>Active:</small> 15</h6>
                                        </div>
                        
                                        <div class="col-md-6">
                                            <h6><small>Deactivated:</small> 15</h6>
                                            <h6><small>Teams:</small> 4</h6>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-info pull-right">Manage</a>
                                    {{-- </div> --}}

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!--Content Body-->
            </div>
            <!--.end of Main-->
        </div>
    </div>
    
</section>
{{-- <!--MODAL na ayaw gumana-->
{{-- <div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                    <h4 class="modal-title">New Project</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-simple">Add</button>
                    <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
</div> --}}
<!--end of MODAL-->
@endsection

@extends('layouts.app')

@section('title')
Manage Users
@endsection

@section('customcss')
@stop

@section('content')
<section class="main-main-container" style="">
    <div class="title-head">
        <h1>Users <small>Manage Users</small></h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <user-datatable></user-datatable>
            <div class="first-row">
                <h6><strong>TEAMS LIST</strong></h6>
                <div class="table-responsive" style="height: 30vh; overflow:scoll">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="">Name</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr><a href="">
                                <td class="text-center">1</td>
                                <td>Johnny</td>
                                <td><a href="#">johnny@captivategrp.com</a></td>
                                <td>08-12-2019</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </a></tr>
                            <tr><a href="">
                                <td class="text-center">1</td>
                                <td>Johnny</td>
                                <td><a href="#">johnny@captivategrp.com</a></td>
                                <td>08-12-2019</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-success btn-round btn-xs" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-round btn-xs" data-original-title="" title="">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </a></tr>
                        </tbody>
                    </table>
                </div>
                <div class="space-10"></div>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="first-row">
                <h6><strong>ADD NEW USER</strong></h6>
                <hr />
                <form class="form">
                    <div class="form-group is-empty">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control">
                                <span class="material-input"></span>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group is-empty">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control">
                                        <span class="material-input"></span>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group is-empty">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control">
                                        <span class="material-input"></span>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                    <div class="btn-group bootstrap-select">
                                            <select class="selectpicker" data-style="btn btn-info btn-xs" title="Single Select" data-size="7" tabindex="-98">
                                                    {{-- <option class="bs-title-option" value="">Single Select</option> --}}
                                                    <option disabled="" selected="">Team</option>
                                                    <option value="2">Creatives</option>
                                                    <option value="3">Web</option>
                                                </select>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="btn-group bootstrap-select">
                                            <select class="selectpicker" data-style="btn btn-info btn-xs" title="Single Select" data-size="7" tabindex="-98">
                                                    {{-- <option class="bs-title-option" value="">Single Select</option> --}}
                                                    <option disabled="" selected="">Role</option>
                                                    <option value="2">Intern</option>
                                                    <option value="3">Regular Employee</option>
                                                    <option value="4">Client</option>

                                                </select>
                                    </div>
                            </div>
                    </div>
                    <div class="row form-group text-center">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-sm" type="button" value="submit">ADD</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="first-row">
                    <h6><strong>ADD NEW TEAM</strong></h6>
                    <hr />
                    <form class="form">
                        <div class="form-group is-empty">
                                    <label class="control-label">Team Name</label>
                                    <input type="text" class="form-control">
                                    <span class="material-input"></span>
                        </div>  
                    
                        <div class="row form-group text-center">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-sm" type="button" value="submit">ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

</section>
@endsection
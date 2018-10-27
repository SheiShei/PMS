    <nav class="navbar navbar-info sm-hidden" id="nav-admin">
        <div class="container-fluid">
            <div class="navbar-header">
            </div>

            <div class="collapse navbar-collapse" id="navigation-example-2">
                <ul class="nav navbar-nav navbar-left">
                        <li>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group form-white">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="fa fa-search"></span>
                                    </div>
                                </form>
                            </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                        {{-- <li>
                                <a href="" class="btn btn-simple">
                                    <i class="fa fa-bell-o"></i>
                                    <i class="material-icon">bell</i>
                                </a>
                            </li> --}}
                    <li class="dropdown">
                        <a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown">
                            <div class="profile-photo-small">
                                <img src="{{asset('images/pp.jpg')}}" alt="profile-picture" class="img-circle img-responsive">
                            </div>
                        <div class="ripple-container"></div>
                        </a>
                        <ul class="dropdown-menu">
                            {{-- <li class="dropdown-header">
                                Settings
                            </li> --}}
                            <li>
                                <a href="#">Profile</a>
                            </li>
                            <li>
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Log out</a></li>
                        </ul>
                    </li>
               </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
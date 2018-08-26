    <nav class="navbar navbar-info" id="nav-admin">
        <div class="container-fluid">
            <div class="navbar-header">
            </div>

            <div class="collapse navbar-collapse" id="navigation-example-2">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group form-white">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown">
                            <div class="profile-photo-small">
                            <img src="{{asset('images/pp.jpg')}}" alt="profile-picture" class="img-circle img-responsive">
                            </div>
                        <div class="ripple-container"></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">
                                Dropdown header
                            </li>
                            <li>
                                <a href="#pablo">Me</a>
                            </li>
                            <li>
                                <a href="#pablo">Settings and other stuff</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#pablo">Sign out</a></li>
                        </ul>
                    </li>
               </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
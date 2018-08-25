<nav class="navbar navbar-info" id="nav-admin">
        <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                {{-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button> --}}
              </div>
    
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="navigation-example-2">
                {{-- <form class="navbar-form navbar-right" role="search">
                  <div class="form-group form-white">
                    <input type="text" class="form-control" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-white btn-simple"><i class="material-icons">search</i></button>
                </form> --}}
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group form-white">
                              <input type="text" class="form-control" placeholder="Search">
                            </div>
                            {{-- <button type="submit" class="btn btn-white btn-simple"><i class="material-icons">search</i></button> --}}
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
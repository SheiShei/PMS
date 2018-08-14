<nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#pablo">
              <img src="{{asset('images/logo.png')}}" height="40px" />
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li>
                  <a href="#pablo">
                    <i class="material-icons">dashboard_outline</i>
                      Dashboard</a>
              </li>
              <li>
                  <a href="#pablo">
                      <i class="material-icons">content_copy</i>
                      Projects</a>
              </li>
              <li class="dropdown">
                  <a href="#pablo">
                      <i class="material-icons">people</i>
                      Users</a>
              </li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group form-white">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini"><i class="material-icons">search</i></button>
            </form>

          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
<!--        end rose navbar -->
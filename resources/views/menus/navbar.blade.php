                <nav class="navbar navbar-default navbar-fixed">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Dashboard</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-dashboard"></i>
                                        <p class="hidden-lg hidden-md">Dashboard</p>
                                    </a>
                                </li>
                                <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-globe"></i>
                                            <b class="caret hidden-lg hidden-md"></b>
                                            <p class="hidden-lg hidden-md">
                                                5 Notifications
                                                <b class="caret"></b>
                                            </p>
                                      </a>
                                      <ul class="dropdown-menu">
                                        <li><a href="#">Notification 1</a></li>
                                        <li><a href="#">Notification 2</a></li>
                                        <li><a href="#">Notification 3</a></li>
                                        <li><a href="#">Notification 4</a></li>
                                        <li><a href="#">Another notification</a></li>
                                      </ul>
                                </li>
                                <li>
                                   <a href="">
                                        <i class="fa fa-search"></i>
                                        <p class="hidden-lg hidden-md">Search</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                @guest
                                @else
                                <li>
                                   <a href="">
                                       <p>{{ Auth::user()->name }}</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <p>Cerrar Sesión</p>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                @endguest
                                <li class="separator hidden-lg"></li>
                            </ul>
                        </div>
                    </div>
                </nav>
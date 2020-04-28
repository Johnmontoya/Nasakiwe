<div class="sidebar" data-color="red" data-image="{{ asset('img/sidebar-2.png') }}">

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="{{ url('/') }}" class="simple-text">
                            Nasa Kiwe
                        </a>
                    </div>

                    <ul class="nav">
                        <li class="active">
                            <a href="#" @click="menu=0">
                                <i class="pe-7s-graph"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="user.html">
                                <i class="pe-7s-user"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="pe-7s-note2"></i>
                                <p>Ind. Gestion</p>
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="menu=3">
                                <i class="pe-7s-news-paper"></i>
                                <p>Ind. Politica</p>
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="menu=1">
                                <i class="pe-7s-map-marker"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="menu=2">
                                <i class="pe-7s-bell"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
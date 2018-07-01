@include('partials.html-header')

<body class="fixed-nav sticky-footer bg-dark {{ in_array(Route::current()->getName(), ['sales.create']) ? 'sidenav-toggled' : '' }}" id="page-top">

    <div id="app">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <a class="navbar-brand" href="index.html">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                @include('partials.sidebar')

                <ul class="navbar-nav sidenav-toggler">
                    <li class="nav-item">
                        <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope"></i>
                        <span class="d-lg-none">Messages
                            <span class="badge badge-pill badge-primary">12 New</span>
                        </span>
                        <span class="indicator text-primary d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">New Messages:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>David Miller</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>Jane Smith</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>John Doe</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all messages</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="d-lg-none">Alerts
                            <span class="badge badge-pill badge-warning">6 New</span>
                        </span>
                        <span class="indicator text-warning d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">New Alerts:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                            <strong>
                                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-danger">
                            <strong>
                                <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                            <strong>
                                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all alerts</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            </span>
                        </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#logout-modal"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            @yield('main-content')

            <!-- /.content-wrapper-->
            <footer class="sticky-footer">
                <div class="container">
                    <div class="text-center">
                        <small>Copyright © {{ config('app.name') }} 2018</small>
                    </div>
                </div>
            </footer>
            
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fa fa-angle-up"></i>
            </a>
            
            <!-- Logout Modal-->
            <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="logout-modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logout-modalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="#" onclick="document.getElementById('form-logout').submit()">Logout</a>
                            <form action="{{ route('logout') }}" id="form-logout" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.scripts')
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') | Member</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MLM</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{  Request::routeIs('member.dashboard') ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('member.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{Request::routeIs('profile.*') ? 'active' : ''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>My Profile</span>
                </a>
                <div id="collapseProfile" class="collapse {{  Request::routeIs('profile.*') ? 'show' : ''  }}" aria-labelledby="headingProfile" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{  Request::routeIs('profile.edit') ? 'active' : ''  }}" href="{{route('profile.edit')}}">Edit Profile</a>
                        <a class="collapse-item {{  Request::routeIs('profile.change.photo') ? 'active' : ''  }}" href="{{route('profile.change.photo')}}">Change Profile Picture</a>
                        <a class="collapse-item {{  Request::routeIs('profile.change.password') ? 'active' : ''  }}" href="{{route('profile.change.password')}}">Change Password</a>
                        <a class="collapse-item {{  Request::routeIs('profile.change.pin') ? 'active' : ''  }}" href="{{route('profile.change.pin')}}">Change Pin</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{  Request::routeIs('fund.*') ? 'active' : ''  }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWallet" aria-expanded="true" aria-controls="collapseWallet">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>My Wallet</span>
                </a>
                <div id="collapseWallet" class="collapse {{  Request::routeIs('fund.*') ? 'show' : ''  }}" aria-labelledby="headingWallet" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{  Request::routeIs('fund.add') ? 'active' : ''  }}" href="{{ route('fund.add') }}">Add Fund Request</a>
                        <a class="collapse-item {{  Request::routeIs('fund.transfer') ? 'active' : ''  }}" href="{{ route('fund.transfer') }}">Transfer Fund</a>
                        <a class="collapse-item {{  Request::routeIs('fund.withdraw') ? 'active' : ''  }}" href="{{ route('fund.withdraw') }}">Withdraw Fund</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Heading -->
            <div class="sidebar-heading">
                Others
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{  Request::routeIs('history.*') ? 'active' : ''  }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistory" aria-expanded="true" aria-controls="collapseHistory">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>History</span>
                </a>
                <div id="collapseHistory" class="collapse {{  Request::routeIs('history.*') ? 'show' : ''  }}" aria-labelledby=" headingHistory" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{  Request::routeIs('history.fund.request') ? 'active' : '' }}" href="{{route('history.fund.request')}}">Fund Request History</a>

                        <a class="collapse-item {{  Request::routeIs('history.fund.transfer') ? 'active' : '' }}" href="{{route('history.fund.transfer')}}">Transfer History</a>

                        <a class="collapse-item {{  Request::routeIs('history.withdraw.request') ? 'active' : '' }}" href="{{route('history.withdraw.request')}}">Withdraw History</a>

                        <a class="collapse-item {{  Request::routeIs('history.product.order') ? 'active' : '' }}" href="{{route('history.product.order')}}">Product Order History</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Leaderboard -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Leaderboard</span></a>
            </li> -->
            <!-- Nav Item - Shop -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Shop</span></a>
            </li>
            <li class="nav-item {{  Request::routeIs('product.*') ? 'active' : ''  }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShop" aria-expanded="true" aria-controls="collapseShop">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>My Shop</span>
                </a>
                <div id="collapseShop" class="collapse {{  Request::routeIs('product.*') ? 'show' : ''  }}" aria-labelledby="headingShop" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{  Request::routeIs('product.all.user') ? 'active' : ''  }}" href="{{ route('product.all.user') }}">All Product</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupport" aria-expanded="true" aria-controls="collapseSupport">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Support</span>
                </a>
                <div id="collapseSupport" class="collapse" aria-labelledby="headingSupport" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="">Request Support</a>
                        <a class="collapse-item" href="">Support History</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @php
                        $id = session('MEMBER_ID');
                        $balance = DB::table('members')->find($id)->account_balance;
                        @endphp

                        <li class="nav-item mx-1 nav-link" style="margin-top: 15px;">Balance: <strong>{{(!empty($balance))?$balance:0}}</strong></li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        @php
                        $id = session('MEMBER_ID');
                        $profilePhoto = DB::table('members')->find($id)->profile_photo;
                        @endphp
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session()->get('MEMBER_FIRST_NAME')}}</span>
                                <img class="img-profile rounded-circle" src="{{(!empty($profilePhoto))?url('images/user_profile/'.$profilePhoto):url('dashboard/img/undraw_profile.svg')}}" alt="">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('member.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>

    <!--       SWEET ALERT      -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#place-order', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure to buy?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, buy it..!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Bought!',
                            'Your product has been purchased.',
                            'success'
                        )
                    }
                })
            });
        });
    </script> -->

</body>

</html>
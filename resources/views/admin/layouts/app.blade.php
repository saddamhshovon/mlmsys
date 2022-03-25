<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') | Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            @php
            $homestart = DB::table('homestarts')->first();
            @endphp
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img class="rounded-circle" width="50" height="50" src="{{isset($homestart->image) ? asset($homestart->image) : 'https://cdn.pixabay.com/photo/2017/11/16/09/25/bitcoin-2953851_1280.png'}}" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">{{isset($homestart->logo_title) ? $homestart->logo_title : 'MLM' }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHome" aria-expanded="true" aria-controls="collapseHome">
                    <i class="fas fa-home"></i>
                    <span>Home Manage</span>
                </a>
                <div id="collapseHome" class="collapse" aria-labelledby="headingHome" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Home Manage:</h6>
                        <a class="collapse-item" href="{{route('home.start')}}">Starting Section</a>
                        <a class="collapse-item" href="{{route('home.about')}}">About Section</a>
                        <a class="collapse-item" href="{{route('home.work')}}">Work Section</a>
                        <a class="collapse-item" href="{{route('home.goal')}}">Goal Section</a>
                        <a class="collapse-item" href="{{route('home.footer')}}">Footer Section</a>
                        <a class="collapse-item" href="{{route('home.notice')}}">Home Notice</a>
                    </div>
                </div>
            </li>
            <div class="sidebar-heading">
                Funds
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFunds" aria-expanded="true" aria-controls="collapseFunds">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Funds</span>
                </a>
                <div id="collapseFunds" class="collapse" aria-labelledby="headingFunds" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Funds:</h6>
                        <a class="collapse-item" href="{{ route('funds.reg')}}">Fix New User's Fund</a>
                        <a class="collapse-item" href="{{ route('referreal.income')}}">Fix Referral Income</a>
                        <a class="collapse-item" href="{{ route('funds.tax')}}">Fix Transfer Charge</a>
                        <a class="collapse-item" href="{{ route('withdraw.tax')}}">Fix Withdraw Charge</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
                    <i class="fab fa-product-hunt"></i>
                    <span>Product Manage</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Products:</h6>
                        <a class="collapse-item" href="{{route('product.all')}}">All Product</a>
                        <a class="collapse-item" href="{{route('product.order.history')}}">Product Order History</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <i class="fas fa-users"></i>
                    <span>Member Manage</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Member Manage:</h6>
                        <a class="collapse-item" href="{{route('member.add')}}">Add Member</a>
                        <a class="collapse-item" href="{{route('member.all')}}">All Member</a>
                        <a class="collapse-item" href="{{route('member.active')}}">Active</a>
                        <a class="collapse-item" href="{{route('member.inactive')}}">Inactive</a>
                        <a class="collapse-item" href="{{route('member.blocked')}}">Blocked</a>
                        <a class="collapse-item" href="{{route('member.expired')}}">Expired</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotice" aria-expanded="false" aria-controls="collapseNotice">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Notice Control</span>
                </a>
                <div id="collapseNotice" class="collapse" aria-labelledby="headingNotice" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Member Manage:</h6>
                        <a class="collapse-item" href="{{route('notice.dashboard')}}">Dashboard Notice</a>
                        <a class="collapse-item" href="{{route('notice.withdraw')}}">Withdraw Notice</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
                Generation
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{route('hands')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Fix Hands</span>
                </a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Generation</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Generation Fixing:</h6>
                        <a class="collapse-item" href="{{ route('generation')}}">Total Levels</a>
                        <a class="collapse-item" href="{{ route('generation.income')}}">Fix Level Income</a>
                    </div>
                </div>
            </li>
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

                        <!-- Nav Item - Alerts -->
                        @php($admin = App\Models\Admin::find(1))
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->

                                @if($admin->id === 1)
                                <span class="badge badge-danger badge-counter">{{$admin->unreadNotifications->count()}}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a href="{{route('notification.mark.read')}}" class="m-2">Mark all as Read</a>
                                @foreach($admin->unreadNotifications->take(4) as $notification)
                                <a class="dropdown-item d-flex align-items-center" style="background-color:lightgray;" href="#">
                                    <div>
                                        <span class="font-weight-bold">{{$notification->data['user_name']}}
                                            @if(isset($notification->data['is_active']))
                                            @if($notification->data['is_active'] === 1)
                                            <p class="text-success">Registered Successfully!</p>
                                            @elseif($notification->data['is_active'] === 0)
                                            <p class="text-success">Registered successfully but not activated</p>
                                            @endif
                                            @endif

                                            @if(isset($notification->data['f_type']))
                                            @if($notification->data['f_type'] === 0)
                                            <p class="text-success">has sent a withdraw request!</p>
                                            @elseif($notification->data['f_type'] === 1)
                                            <p class="text-success">has sent a fund add request!</p>
                                            @endif
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                @endforeach

                                @foreach($admin->readNotifications->take(1) as $notification)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div>
                                        <span class="font-weight-bold">{{$notification->data['user_name']}}
                                            @if(isset($notification->data['is_active']))
                                            @if($notification->data['is_active'] === 1)
                                            <p class="text-success">Registered Successfully!</p>
                                            @elseif($notification->data['is_active'] === 0)
                                            <p class="text-success">Registered successfully but not activated</p>
                                            @endif
                                            @endif

                                            @if(isset($notification->data['f_type']))
                                            @if($notification->data['f_type'] === 0)
                                            <p class="text-success">has sent a withdraw request!</p>
                                            @elseif($notification->data['f_type'] === 1)
                                            <p class="text-success">has sent a fund add request!</p>
                                            @endif
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                @endforeach

                                @endif
                                <a class="dropdown-item text-center small text-gray-500" href="{{route('all.notification')}}">Show All Alerts</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="{{ asset('dashboard/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('admihn.profile')}}">
                                    <i class="fas fa-fw fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
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
                    <a class="btn btn-primary" href="{{ route('admin.logout') }}">Logout</a>
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

    <!-- Page level plugins -->
    <script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('dashboard/js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('dashboard/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"></script> -->

    <!--       SWEET ALERT      -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>

    <!-- active status -->

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#is-active', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Sure to change active status?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Changed!',
                            'Active status has been changed.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>

</body>

</html>
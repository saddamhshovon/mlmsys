<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" id="memberRegister">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleReferralID" placeholder="Referral ID" name="referral_id">
                                </div>
                                <div class="form-group">
                                    <h1 id="referral_id_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="first_name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="last_name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h1 id="first_name_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <h1 id="last_name_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleUserName" placeholder="User Name" name="user_name" required>
                                </div>
                                <div class="form-group">
                                    <h1 id="user_name_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" required>
                                </div>
                                <div class="form-group">
                                    <h1 id="email_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="password_c" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h1 id="password_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <h1 id="password_c_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control form-control-user" id="exampleMobileNo" placeholder="Mobile No." name="mobile_no" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="examplePin" placeholder="Pin Code" name="pin" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h1 id="mobile_no_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <h1 id="pin_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleMobileBanking" placeholder="Mobile Banking Service" name="mobile_banking_service" required>
                                </div>
                                <div class="form-group">
                                    <h1 id="mobile_banking_service_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleCity" placeholder="City" name="city" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleCountry" placeholder="Country" name="country" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h1 id="city_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <h1 id="country_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleMembershipProcess" placeholder="Membership Process" name="membership_type" required>
                                </div>
                                <div class="form-group">
                                    <h1 id="membership_type_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="examplePlacementID" placeholder="Placement ID" name="placement_id">
                                </div>
                                <div class="form-group">
                                    <h1 id="placement_id_error" class="h6 pl-3 text-danger reg-err" role="alert"></h1>
                                </div>
                                <button id="memberRegisterBtn" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <div class="form-group">
                                    <h1 id="memberThanks" class="h6 pl-3 text-.text-success" role="alert"></h1>
                                </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
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

</body>

</html>
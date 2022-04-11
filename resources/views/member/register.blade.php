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
                            <form class="user" action="{{route('register.member')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleReferralID" placeholder="Referral ID" name="referral_id" value="{{ old('referral_id') }}">
                                </div>
                                @error('referral_id')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>
                                    </div>
                                </div>
                                @error('first_name')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                @error('last_name')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleUserName" placeholder="User Name" name="user_name" value="{{ old('user_name') }}" required>
                                </div>
                                @error('user_name')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation" required>
                                    </div>
                                </div>
                                @error('password')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control form-control-user" id="exampleMobileNo" placeholder="Mobile No." name="mobile_no" value="{{ old('mobile_no') }}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="examplePin" placeholder="Pin Code" name="pin" required>
                                    </div>
                                </div>
                                @error('mobile_no')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                @error('pin')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select class="form-control" aria-label="Select Mobile Banking Service" id="exampleMobileBanking" placeholder="Mobile Banking Service" name="mobile_banking_service" required>
                                        <option selected value="" disabled>Mobile Banking Service</option>
                                        <option value="Bkash" >Bkash</option>
                                        <option value="Nagad" >Nagad</option>
                                        <option value="Ucash" >Ucash</option>
                                        <option value="DBBL" >DBBL</option>
                                    </select>
                                </div>
                                @error('mobile_banking_service')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" aria-label="Select Country" id="exampleCountry" name="country" required>
                                            <option selected value="" disabled>Open this select country</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" aria-label="Select City" id="exampleCity" placeholder="City" name="city" required>
                                            <option selected value="" disabled>Open this select city</option>
                                        </select>
                                    </div>
                                </div>
                                @error('country')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                @error('city')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select class="form-control" aria-label="Select Membership Process" id="exampleMembershipProcess" placeholder="Membership Process" name="membership_type" required>
                                        <option selected value="" disabled>Membership Process</option>
                                        <option value="Basic Membership" >Basic Membership</option>
                                        <option value="Products" >Products</option>
                                        <option value="Training" >Training</option>
                                        <option value="Service" >Service</option>
                                    </select>
                                </div>
                                @error('membership_type')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="examplePlacementID" placeholder="Placement ID" name="placement_id" value="{{ old('placement_id') }}">
                                </div>
                                @error('placement_id')
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                                </div>
                                @enderror
                                @if(session('placement_id'))
                                <div class="form-group">
                                    <h1 class="h6 pl-3 text-danger" role="alert">{{session('placement_id')}}</h1>
                                </div>
                                @endif
                                <button id="memberRegisterBtn" type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            @if(session('success'))
                            <div class="form-group">
                                <h1 id="memberThanks" class="h6 pl-3 mt-3 text-primary" role="alert">{{session('success')}}</h1>
                            </div>
                            @endif
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
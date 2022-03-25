@extends('admin.layouts.app')

@section('title', 'Add Member')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Add Member</h1>

   <!-- DataTales Example -->
   <div class="row">
      <div class="col-8">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <a href="{{route('member.all')}}" class="btn btn-primary">Back To All Member</a>
            </div>
            <div>
               @if(session('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
               </div>
               @endif
               @if(session('error'))
               <div class="alert alert-success alert-danger fade show" role="alert">
                  <strong>{{session('error')}}</strong>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
               </div>
               @endif
            </div>
            <div class="card-body">
               <form action="{{route('register.member')}}" method="POST">
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
                     <input type="text" class="form-control form-control-user" id="exampleMobileBanking" placeholder="Mobile Banking Service" name="mobile_banking_service" required>
                  </div>
                  @error('mobile_banking_service')
                  <div class="form-group">
                     <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                  </div>
                  @enderror
                  <div class="form-group row">
                     <div class="col-sm-6">
                        <select class="form-control" aria-label="Select Country" id="exampleCountry" name="country">
                           <option selected value="" disabled>Open this select country</option>
                           @foreach($countries as $country)
                           <option value="{{ $country->name }}">{{ $country->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <select class="form-control" aria-label="Select City" id="exampleCity" placeholder="City" name="city">
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
                     <input type="text" class="form-control form-control-user" id="exampleMembershipProcess" placeholder="Membership Process" name="membership_type" required>
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
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
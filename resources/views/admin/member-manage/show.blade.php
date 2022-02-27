@extends('admin.layouts.app')

@section('title', 'Show Member Details')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">View Member Details</h1>

   <!-- DataTales Example -->
   <div class="row">
      <div class="col-8">
         <div class="card shadow mb-4 row">
            <div class="card-body">
               <form action="" method="">
                  <div class="">
                     <div class="mb-3">
                        <label for="referral_id" class="form-label">Refferal ID<span class="text-danger">*</span></label>
                        <input type="text" name="referral_id" value="{{$member->referral_id}}" class="form-control" id="referral_id" placeholder="Refferal ID">
                        @error('referral_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                        <input type="text" name="first_name" value="{{$member->first_name}}" class="form-control" id="first_name" placeholder="First Name">
                        @error('first_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                        <input type="text" name="last_name" value="{{$member->last_name}}" class="form-control" id="last_name" placeholder="Last Name">
                        @error('last_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="user_name" class="form-label">Username<span class="text-danger">*</span></label>
                        <input type="text" name="user_name" value="{{$member->user_name}}" class="form-control" id="user_name" placeholder="Username">
                        @error('user_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="text" name="email" value="{{$member->email}}" class="form-control" id="email" placeholder="Email">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="text" name="password" value="{{$member->password}}" class="form-control" id="password" placeholder="Password">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="mobile_no" class="form-label">Mobile Number<span class="text-danger">*</span></label>
                        <input type="text" name="mobile_no" value="{{$member->mobile_no}}" class="form-control" id="mobile_no" placeholder="Mobile Number">
                        @error('mobile_no')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="pin" class="form-label">Pin Code<span class="text-danger">*</span></label>
                        <input type="text" name="pin" value="{{$member->pin}}" class="form-control" id="pin" placeholder="Pin Code">
                        @error('pin')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="moblie_banking_service" class="form-label">Mobile Banking Service<span class="text-danger">*</span></label>
                        <input type="text" name="moblie_banking_service" value="{{$member->moblie_banking_service}}" class="form-control" id="moblie_banking_service" placeholder="Mobile Banking Service">
                        @error('pin')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                        <input type="text" name="city" value="{{$member->city}}" class="form-control" id="city" placeholder="city">
                        @error('city')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                        <input type="text" name="country" value="{{$member->country}}" class="form-control" id="country" placeholder="Country">
                        @error('country')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="membership_type" class="form-label">Membership Process<span class="text-danger">*</span></label>
                        <input type="text" name="membership_type" value="{{$member->membership_type}}" class="form-control" id="membership_type" placeholder="Membership Process">
                        @error('membership_type')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="placement_id" class="form-label">Placement ID<span class="text-danger">*</span></label>
                        <input type="text" name="placement_id" value="{{$member->placement_id}}" class="form-control" id="placement_id" placeholder="Placement ID">
                        @error('placement_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                  </div>
               </form>
               <a href="{{route('member.is-blocked',$member->id)}}">
                  <button class="btn btn-danger btn-user">
                     Block This User
                  </button>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@extends('admin.layouts.app')

@section('title', 'Show Member Details')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">View Member Details</h1>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
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
         <div class="row">
            <div class="col-8">
               <form class="user">
                  @csrf
                  <div class="form-group">
                     <input type="text" class="form-control" id="exampleReferralID" placeholder="Referral ID" disabled value="{{$member->referral_id}}" name="referral_id">
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="First Name" disabled value="{{$member->first_name}}" name="first_name" required>
                     </div>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="exampleLastName" placeholder="Last Name" disabled value="{{$member->last_name}}" name="last_name" required>
                     </div>
                  </div>

                  <div class="form-group">
                     <input type="text" class="form-control" id="exampleUserName" placeholder="User Name" disabled value="{{$member->user_name}}" name="user_name" required>
                  </div>

                  <div class="form-group">
                     <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email Address" disabled value="{{$member->email}}" name="email" required>
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="tel" class="form-control" id="exampleMobileNo" placeholder="Mobile No." disabled value="{{$member->mobile_no}}" name="mobile_no" required>
                     </div>
                     <div class="col-sm-6">
                        <input type="password" class="form-control" id="examplePin" placeholder="Pin Code" disabled value="{{$member->pin}}" name="pin" required>
                     </div>
                  </div>

                  <div class="form-group">
                     <input type="text" class="form-control" id="exampleMobileBanking" placeholder="Mobile Banking Service" disabled value="{{$member->moblie_banking_service}}" name="moblie_banking_service" required>
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" id="exampleCity" placeholder="City" disabled value="{{$member->city}}" name="city" required>
                     </div>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="exampleCountry" placeholder="Country" disabled value="{{$member->country}}" name="country" required>
                     </div>
                  </div>

                  <div class="form-group">
                     <input type="text" class="form-control" id="exampleMembershipProcess" placeholder="Membership Process" disabled value="{{$member->membership_type}}" name="membership_type" required>
                  </div>

                  <div class="form-group">
                     <input type="text" class="form-control" id="examplePlacementID" placeholder="Placement ID" disabled value="{{$member->placement_id}}" name="placement_id">
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
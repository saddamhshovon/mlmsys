@extends('member.layouts.app')

@section('title', 'Edit Profile')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
</div>

<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body">
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
                <form action="{{route('update.profile')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                        <input type="text" name="first_name" required class="form-control" id="first_name" value="{{ $member->first_name }}">
                    </div>
                    @error('first_name')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                        <input type="text" name="last_name" required class="form-control" id="last_name" value="{{ $member->last_name }}">
                    </div>
                    @error('last_name')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email<span class="text-danger">*</span></label>
                        <input type="email" name="email" required value="{{ $member->email }}" class="form-control" id="email">
                    </div>
                    @error('email')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror

                    <div class="mb-3">
                        <label for="mobile_no" class="form-label">Mobile Number<span class="text-danger">*</span></label>
                        <input type="text" name="mobile_no" required value="{{ $member->mobile_no }}" class="form-control" id="mobile_no">
                    </div>
                    @error('mobile_no')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror

                    <div class="mb-3">
                        <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                        <input type="text" name="city" required value="{{ $member->city }}" class="form-control" id="city">
                    </div>
                    @error('city')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror

                    <div class="mb-3">
                        <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                        <input type="text" name="country" required value="{{ $member->country }}" class="form-control" id="country">
                    </div>
                    @error('country')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
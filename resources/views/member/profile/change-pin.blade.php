@extends('member.layouts.app')

@section('title', 'Change Pin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Change Pin</h1>
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
                <form action="{{route('change.passwordRequ')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="pin" class="form-label">New Pin<span class="text-danger">*</span></label>
                        <input type="password" name="pin" class="form-control" id="pin" value="{{ old('pin') }}">
                    </div>
                    @error('pin')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror
                    <div class="mb-3">
                        <label for="confirm_pin" class="form-label">Confirm Pin<span class="text-danger">*</span></label>
                        <input type="password" name="confirm_pin" value="{{ old('confirm_pin') }}" class="form-control" id="confirm_pin">
                    </div>
                    @error('confirm_pin')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror

                    <div class="mb-3">
                        <label for="password" class="form-label">Enter Your Password<span class="text-danger">*</span></label>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password">
                    </div>
                    @error('password')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-rounded btn-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
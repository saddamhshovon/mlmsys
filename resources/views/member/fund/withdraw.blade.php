@extends('member.layouts.app')

@section('title', 'Withdraw Fund')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Withdraw Fund</h1>
</div>

<div class="row">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('fund.withdrawreq') }}" method="POST">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                            <input type="Number" name="amount" class="form-control" id="amount" placeholder="0" value="{{ old('amount') }}">
                        </div>
                        @error('amount')
                        <div class="form-group">
                            <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                        </div>
                        @enderror
                        <div class="mb-3">
                            <label for="pin" class="form-label">Pin Code<span class="text-danger">*</span></label>
                            <input type="password" name="pin" class="form-control" id="pin">
                        </div>
                        @error('pin')
                        <div class="form-group">
                            <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                        </div>
                        @enderror
                        <div>
                            <button type="submit" class="btn btn-rounded btn-primary">Request</button>
                        </div>
                        @if(session('success'))
                        <div class="text-center">
                            <h1 class="h6 pt-3 text-success" role="alert">{{session('success')}}</h1>
                        </div>
                        @endif
                        @if(session('failed'))
                        <div class="text-center">
                            <h1 class="h6 pt-3 text-danger" role="alert">{{session('failed')}}</h1>
                        </div>
                        @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
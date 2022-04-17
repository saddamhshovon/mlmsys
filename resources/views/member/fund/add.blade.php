@extends('member.layouts.app')

@section('title', 'Add Fund Request')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Fund Request</h1>
</div>

<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{route('fund.addreq')}}" method="POST">
                    @csrf
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
                        <label for="mobile_banking_system" class="form-label">Mobile Banking<span
                                class="text-danger">*</span></label>
                        <select class="form-control" aria-label="Select Mobile Banking Service"
                            id="exampleMobileBanking" placeholder="Mobile Banking Service" name="mobile_banking_service"
                            required>
                            <option selected value="" disabled>Select</option>
                            @foreach ($mobiles as $mobile)
                                <option value="{{ $mobile->name }}">{{ $mobile->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('mobile_banking_system')
                    <div class="form-group">
                        <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                    </div>
                    @enderror
                    <div class="mb-3">
                        <label for="trx_id" class="form-label">Transaction ID<span class="text-danger">*</span></label>
                        <input type="text" name="trx_id" class="form-control" id="trx_id" value="{{ old('trx_id') }}">
                    </div>
                    @error('trx_id')
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
                </form>
                @if(session('success'))
                <div class="text-center">
                    <h1 id="transfer_message" class="h6 pt-3 text-success" role="alert">{{session('success')}}</h1>
                </div>
                @endif
                @if(session('failed'))
                <div class="text-center">
                    <h1 id="transfer_message" class="h6 pt-3 text-danger" role="alert">{{session('failed')}}</h1>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
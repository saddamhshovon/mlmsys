@extends('admin.layouts.app')

@section('title', 'Funds')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fix Minimum Withdraw Amount</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($min)
                <div class="alert alert-success fade show m-3" role="alert">
                    Current minimum withdraw amount is: <span>{{ $min->min }}</span>
                </div>
                @else
                <div class="alert alert-warning fade show m-3" role="alert">
                    <strong>Minimum withdraw amount is not fixed</strong>
                </div>
                @endif

                <div>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-success alert-danger fade show" role="alert">
                        <strong>{{session('error')}}</strong>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    @if(!$min)
                    <form action="{{ route('withdraw.amountfix') }}" method="post">
                        @else
                        <form action="{{ route('withdraw.amountchange') }}" method="post">
                            @endif
                            @csrf
                            <div>
                                <div class="mb-3">
                                    @if(!$min)
                                    <label for="fix_min" class="form-label">How much is minimum withdraw amount?<span class="text-danger">*</span></label>
                                    <input type="number" name="min" class="form-control" id="fix_min" placeholder="0">
                                    @error('min')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @else
                                    <label for="fix_min" class="form-label">Change minimum withdraw amount?<span class="text-danger">*</span></label>
                                    <input type="number" name="min" class="form-control" id="fix_min" value="{{ $min->min }}">
                                    @error('min')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if(!$min)
                                <button type="submit" class="btn btn-rounded btn-primary">Fix</button>
                                @else
                                <button type="submit" class="btn btn-rounded btn-primary">Change</button>
                                @endif
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->

@endsection
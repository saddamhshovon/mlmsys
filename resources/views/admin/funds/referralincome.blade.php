@extends('admin.layouts.app')

@section('title', 'Funds')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fix Referral Income</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($regfund)
                <div class="alert alert-success fade show m-3" role="alert">
                    Current referral income amount is: <span>{{ $regfund->amount }}</span>
                </div>
                @else
                <div class="alert alert-warning fade show m-3" role="alert">
                    <strong>Referral income amount is not fixed</strong>
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
                    @if(!$regfund)
                    <form action="{{ route('referreal.incomefix') }}" method="post">
                        @else
                        <form action="{{ route('referreal.incomechange') }}" method="post">
                            @endif
                            @csrf
                            <div>
                                <div class="mb-3">
                                    @if(!$regfund)
                                    <label for="fix_tax" class="form-label">How much?<span class="text-danger">*</span></label>
                                    <input type="number" name="amount" class="form-control" placeholder="0">
                                    @error('regfund')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @else
                                    <label for="fix_tax" class="form-label">Change referral income amount?<span class="text-danger">*</span></label>
                                    <input type="number" name="amount" class="form-control" value="{{ $regfund->amount }}">
                                    @error('regfund')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if(!$regfund)
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
@extends('admin.layouts.app')

@section('title', 'Funds')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fix Tax on Transferring Funds</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($tax)
                <div class="alert alert-success fade show m-3" role="alert">
                    Current tax on transfer fund is: <span>{{ $tax->tax }}%</span>
                </div>
                @else
                <div class="alert alert-warning fade show m-3" role="alert">
                    <strong>Tax on transfer fund is not fixed</strong>
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
                    @if(!$tax)
                    <form action="{{ route('funds.taxfix') }}" method="post">
                        @else
                        <form action="{{ route('funds.taxchange') }}" method="post">
                            @endif
                            @csrf
                            <div>
                                <div class="mb-3">
                                    @if(!$tax)
                                    <label for="fix_tax" class="form-label">How much ('%') tax on fund transfer?<span class="text-danger">*</span></label>
                                    <input type="number" name="tax" class="form-control" id="fix_tax" placeholder="0">
                                    @error('tax')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @else
                                    <label for="fix_tax" class="form-label">Change '%' tax on fund transfer?<span class="text-danger">*</span></label>
                                    <input type="number" name="tax" class="form-control" id="fix_tax" value="{{ $tax->tax }}">
                                    @error('tax')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if(!$tax)
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
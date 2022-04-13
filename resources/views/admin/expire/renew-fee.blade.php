@extends('admin.layouts.app')

@section('title', 'Renewal Fee')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Renewal Fee</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($fee)
                <div class="alert alert-secondary alert-warning fade show m-3" role="alert">
                    Current renewal fee is: <span>{{ $fee->fee }}</span>
                </div>
                <div>
                    <a class="btn btn-rounded btn-danger m-3" href="{{route('expiry.fee.delete')}}">Change?</a>
                </div>
                @else
                <div class="alert alert-success alert-warning fade show m-3" role="alert">
                    <strong>Renewal fee is not fixed</strong>
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
                @if(!$fee)
                <div class="card-body">
                    <form action="{{ route('expiry.fee.fix') }}" method="post">
                        @csrf
                        <div>
                            <div class="mb-3">
                                <label for="fix_fee" class="form-label">What is the renewal fee?<span class="text-danger">*</span></label>
                                <input type="number" name="fee" class="form-control" id="fix_fee" placeholder="0">
                                @error('fee')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-rounded btn-primary">Fix</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->

@endsection
@extends('admin.layouts.app')

@section('title', 'Hands')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fix Hands</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($hands)
                <div class="alert alert-success fade show m-3" role="alert">
                    Current hands per user is: <span>{{ $hands->max }}</span>
                </div>
                @else
                <div class="alert alert-warning fade show m-3" role="alert">
                    <strong>Hands per user is not fixed</strong>
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
                    @if(!$hands)
                    <form action="{{ route('hands.fix') }}" method="post">
                        @else
                        <form action="{{ route('hands.change') }}" method="post">
                            @endif
                            @csrf
                            <div>
                                <div class="mb-3">
                                    @if(!$hands)
                                    <label for="fix_hands" class="form-label">How many hands per user?<span class="text-danger">*</span></label>
                                    <input type="number" name="hands" class="form-control" id="fix_hands" placeholder="0">
                                    @error('hands')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @else
                                    <label for="fix_hands" class="form-label">Change hands per user?<span class="text-danger">*</span></label>
                                    <input type="number" name="hands" class="form-control" id="fix_handss" value="{{ $hands->max }}">
                                    @error('hands')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if(!$hands)
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
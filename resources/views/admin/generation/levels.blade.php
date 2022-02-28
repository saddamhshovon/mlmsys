@extends('admin.layouts.app')

@section('title', 'Generation Levels')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Generation Levels</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($levels)
                <div class="alert alert-secondary alert-warning fade show m-3" role="alert">
                    Currents Level is: <span>{{ $levels->levels }}</span>
                </div>
                <div>
                    <a class="btn btn-rounded btn-danger m-3" href="{{route('generation.delete')}}">Change?</a>
                </div>
                @else
                <div class="alert alert-success alert-warning fade show m-3" role="alert">
                    <strong>Level is not fixed</strong>
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
                @if(!$levels)
                <div class="card-body">
                    <form action="{{ route('generation.fix') }}" method="post">
                        @csrf
                        <div>
                            <div class="mb-3">
                                <label for="fix_levels" class="form-label">How many levels you want?<span class="text-danger">*</span></label>
                                <input type="number" name="levels" class="form-control" id="fix_levels" placeholder="0">
                                @error('levels')
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
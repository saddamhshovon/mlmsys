@extends('admin.layouts.app')

@section('title', 'Generation Income')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Generation Income</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($levels)
                <div class="card-body">
                    @for($i = 1; $i <= $levels->levels; $i++)
                    @if(isset($data[$i-1]) && ($data[$i-1]->level == $i))
                    <form action="{{ route('generation.incupdate')}}" method="post">
                    @else
                    <form action="{{ route('generation.incsave')}}" method="post">
                    @endif
                        @csrf
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="fix_levels" class="form-label">Level {{$i}}<span class="text-danger">*</span></label>
                                <input hidden type="text" name="level" class="form-control" id="fix_level" value="{{$i}}">
                                @if(isset($data[$i-1]) && ($data[$i-1]->level == $i))
                                <input type="number" name="income" class="form-control" id="fix_income" value="{{ $data[$i -1]->income}}">
                                @else
                                <input type="number" name="income" class="form-control" id="fix_income" placeholder="0">
                                @endif
                                @error('income')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            @if(isset($data[$i-1]) && ($data[$i-1]->level == $i))
                            <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                            @else
                            <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                            @endif
                        </div>
                    </form>
                    @endfor
                </div>
                @else
                <div class="alert alert-success alert-warning fade show m-3" role="alert">
                    <strong>Level is not fixed. Please fix level first.</strong>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->

@endsection
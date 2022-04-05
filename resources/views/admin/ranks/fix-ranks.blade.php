@extends('admin.layouts.app')

@section('title', 'Fix Ranks')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fix Ranks</h1>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-8 col-xl-10">
            <div class="card shadow">
                @if($total)
                <div class="card-body">
                    @for($i = 1; $i <= $total->total; $i++)
                        @if(isset($data[$i-1]))
                        <form action="{{ route('ranks.update', $data[$i-1]->id )}}" method="post">
                            @else
                            <form action="{{ route('ranks.save')}}" method="post">
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Rank {{$i}} </label>
                                        @if(isset($data[$i-1]))
                                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $data[$i -1]->name}}">
                                        <label for="min_user" class="form-label">Minimum Children<span class="text-danger">*</span></label>
                                        <input type="number" name="min_user" class="form-control" id="min_user" value="{{ $data[$i -1]->min_user}}">
                                        <label for="max_user" class="form-label">Maximum Children<span class="text-danger">*</span></label>
                                        <input type="number" name="max_user" class="form-control" id="max_user" value="{{ $data[$i -1]->max_user}}">
                                        @else
                                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                                        <label for="min_user" class="form-label">Minimum Children<span class="text-danger">*</span></label>
                                        <input type="number" name="min_user" class="form-control" id="min_user" placeholder="0">
                                        <label for="max_user" class="form-label">Maximum Children<span class="text-danger">*</span></label>
                                        <input type="number" name="max_user" class="form-control" id="max_user" placeholder="0">
                                        @endif
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @error('min_user')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @error('max_user')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    @if(isset($data[$i-1]))
                                    <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                                    @if($data[$i-1]->withdraw_rank != 0)
                                    <a href="#" class="btn btn-rounded btn-success disabled">This is the withdrawal rank</a>
                                    @else
                                    <a href="{{route('ranks.withdraw', $data[$i-1])}}" class="btn btn-rounded btn-primary">Set as withdrawal rank</a>
                                    @endif
                                    @else
                                    <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                    @endif
                                </div>
                            </form>
                            @endfor
                </div>
                @else
                <div class="alert alert-success alert-warning fade show m-3" role="alert">
                    <strong>Total rank is not fixed. Please fix total ranks first.</strong>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->

@endsection
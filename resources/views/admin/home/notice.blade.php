@extends('admin.layouts.app')

@section('title', 'Home Notice Section')

@section('content')

<!-- Page Heading -->

@if (!empty($homeNotice->notice))
<marquee width="49%" class="text-primary text-center" direction="right" height="20px">
   {{$homeNotice->notice}}
</marquee><br>
@endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Home Notice Section</h1>
</div>

<div class="row">
   <div class="col-xl-6 col-md-6 mb-4">
      <div class="card shadow mb-4">
         <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>{{session('success')}}</strong>
               <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-success alert-danger fade show" role="alert">
               <strong>{{session('error')}}</strong>
               <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            @endif

            <form action="{{route('home.notice.submit')}}" method="POST">
               @csrf

               <div class="mb-3">
                  <label for="notice" class="form-label">Home Notice<span class="text-danger">*</span></label>
                  <input type="text" name="notice" value="{{!empty($homeNotice->notice) ? $homeNotice->notice : ''}}" class="form-control" id="notice" placeholder="Home Notice">
                  @error('title')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>


               @if(empty($homeNotice->notice))
               <div>
                  <button type="submit" class="btn btn-rounded btn-primary">Create</button>
               </div>
               @else
               <div>
                  <button type="submit" class="btn btn-rounded btn-primary">Update</button>
               </div>
               @endif
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
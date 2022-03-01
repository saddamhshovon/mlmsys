@extends('admin.layouts.app')

@section('title', 'Dashboard Notice')

@section('content')

<!-- Page Heading -->
@if (!empty($notice->dashboard_notice))
<marquee width="49%" class="text-primary text-center" direction="left" height="20px">
   {{$notice->dashboard_notice}}
</marquee>
@endif
<div class="d-sm-flex pt-3 align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Dashboard Notice</h1>
</div>

<div class="row">
   <div class="col-xl-6 col-md-6 mb-4">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div>
               @if(session('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
               </div>
               @endif
               @if(session('error'))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>{{session('error')}}</strong>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
               </div>
               @endif
            </div>
            <form action="{{route('notice.dashboard.publish')}}" method="POST">
               @csrf

               <div class="mb-3">
                  <label for="dashboard_notice" class="form-label">Dashboard Notice<span class="text-danger">*</span></label>
                  <input type="text" value="{{!empty($notice->dashboard_notice) ? $notice->dashboard_notice : ''}}" name="dashboard_notice" class="form-control" id="dashboard_notice">
               </div>
               @error('dashboard_notice')
               <div class="form-group">
                  <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
               </div>
               @enderror
               <div>
                  <button type="submit" class="btn btn-rounded btn-primary">Publish</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
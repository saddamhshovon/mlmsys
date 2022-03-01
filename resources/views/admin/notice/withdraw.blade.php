@extends('admin.layouts.app')

@section('title', 'Withdraw Notice')

@section('content')

@if (!empty($notice->withdraw_notice))
<marquee width="49%" class="text-primary text-center" direction="left" height="20px">
   {{$notice->withdraw_notice}}
</marquee>
@endif
<div class="d-sm-flex pt-3 align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Withdraw Notice</h1>
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
            <form action="{{route('notice.withdraw.publish')}}" method="POST">
               @csrf

               <div class="mb-3">
                  <label for="withdraw_notice" class="form-label">Withdraw Notice<span class="text-danger">*</span></label>
                  <input type="text" value="{{!empty($notice->withdraw_notice) ? $notice->withdraw_notice : ''}}" name="withdraw_notice" class="form-control" id="withdraw_notice">
               </div>
               @error('withdraw_notice')
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
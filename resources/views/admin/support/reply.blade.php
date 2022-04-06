@extends('admin.layouts.app')

@section('title', 'Reply User')

@section('content')

<!-- Page Heading -->
<div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Reply User</h1>
   </div>


   <div class="row">
      <div class="col-xl-6 col-md-6 mb-4">
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="">
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
               <form action="{{route('support.reply.message',$row->id)}}" method="POST">
                  @csrf
                  <!-- <div class="mb-3">
                     <label for="type" class="form-label">Support Type<span class="text-danger">*</span></label>
                     <select class="form-control form-control-md" id="type" name="type">
                        <option value="" selected="" disabled="">Select</option>
                        <option value="Fund">Fund</option>
                        <option value="Withdraw">Withdraw</option>
                        <option value="Expired">Expired</option>
                     </select>
                  </div> -->
                  <!-- @error('type')
                  <div class="form-group">
                     <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                  </div>
                  @enderror -->
                  <div class="mb-3">
                     <label for="message" class="form-label">Message From User<span class="text-danger">*</span></label>
                     <textarea name="message" class="form-control" disabled id="message" cols="30">{{$row->message}}</textarea>
                  </div>
                  @error('message')
                  <div class="form-group">
                     <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                  </div>
                  @enderror

                  <div class="mb-3">
                     <label for="reply" class="form-label">Reply<span class="text-danger">*</span></label>
                     <textarea name="reply" class="form-control" id="reply" cols="30"></textarea>
                  </div>
                  @error('message')
                  <div class="form-group">
                     <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                  </div>
                  @enderror
                  <div>
                     <button type="submit" class="btn btn-rounded btn-primary">Reply</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
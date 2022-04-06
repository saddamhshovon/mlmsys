@extends('member.layouts.app')

@section('title', 'Request Support')

@section('content')

<!-- Page Heading -->
<div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Request Support</h1>
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
               <form action="{{route('support.message.send')}}" method="post">
                  @csrf
                  <div class="mb-3">
                     <input type="hidden" name="user_name" class="form-control disabled" id="user_name" placeholder="username" value="{{ $userName }}">
                  </div>
                  <div class="mb-3">
                     <label for="type" class="form-label">Support Type<span class="text-danger">*</span></label>
                     <select class="form-control form-control-md" id="type" name="type">
                        <option value="" selected="" disabled="">Select</option>
                        <option value="Fund">Fund</option>
                        <option value="Withdraw">Withdraw</option>
                        <option value="Expired">Expired</option>
                     </select>
                  </div>
                  @error('type')
                  <div class="form-group">
                     <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                  </div>
                  @enderror
                  <div class="mb-3">
                     <label for="message" class="form-label">Write your message<span class="text-danger">*</span></label>
                     <textarea name="message" class="form-control" placeholder="Write your message" id="message" cols="30"></textarea>
                  </div>
                  @error('message')
                  <div class="form-group">
                     <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
                  </div>
                  @enderror
                  <div>
                     <button type="submit" class="btn btn-rounded btn-primary">Send</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
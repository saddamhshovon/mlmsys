@extends('admin.layouts.app')

@section('title', 'Add Fund')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Add Fund</h1>
</div>

<div class="row">
   <div class="col-xl-6 col-md-6 mb-4">
      <div class="card shadow mb-4">
         <div class="card-body">
            <form action="{{route('admin.fund.add')}}" method="POST">
               @csrf
               <div class="mb-3">
                  <label for="user_name" class="form-label">Username<span class="text-danger">*</span></label>
                  <input type="text" name="user_name" class="form-control" id="user_name" placeholder="username" value="{{ old('user_name') }}">
               </div>
               @error('user_name')
               <div class="form-group">
                  <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
               </div>
               @enderror

               <div class="mb-3">
                  <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                  <input type="Number" name="amount" class="form-control" id="amount" placeholder="0" value="{{ old('amount') }}">
               </div>
               @error('amount')
               <div class="form-group">
                  <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
               </div>
               @enderror

               <div>
                  <button type="submit" class="btn btn-rounded btn-primary">Add Fund</button>
               </div>
            </form>
            @if(session('success'))
            <div class="text-center">
               <h1 id="transfer_message" class="h6 pt-3 text-success" role="alert">{{session('success')}}</h1>
            </div>
            @endif
            @if(session('failed'))
            <div class="text-center">
               <h1 id="transfer_message" class="h6 pt-3 text-danger" role="alert">{{session('failed')}}</h1>
            </div>
            @endif
         </div>
      </div>
   </div>
</div>

@endsection
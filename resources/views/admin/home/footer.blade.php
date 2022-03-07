@extends('admin.layouts.app')

@section('title', 'Home Footer Section')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Home Footer Section</h1>
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

            <form action="{{route('home.footer.submit')}}" method="POST">
               @csrf

               <div class="mb-3">
                  <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                  <input type="text" name="address" value="{{!empty($homeFooter->address) ? $homeFooter->address : ''}}" class="form-control" id="address" placeholder="Your address">
                  @error('title')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>

               <div class="mb-3">
                  <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                  <input type="text" name="email" value="{{!empty($homeFooter->email) ? $homeFooter->email : ''}}" class="form-control" id="email" placeholder="Your Email">
                  @error('email')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>

               <div class="mb-3">
                  <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                  <input type="text" name="phone" value="{{!empty($homeFooter->phone) ? $homeFooter->phone : ''}}" class="form-control" id="phone" placeholder="Phone Number">
                  @error('phone')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>

               <div class="mb-3">
                  <label for="twitter" class="form-label">Twitter Link<span class="text-danger">*</span></label>
                  <input type="text" name="twitter" value="{{!empty($homeFooter->twitter) ? $homeFooter->twitter : ''}}" class="form-control" id="twitter" placeholder="Twitter link">
                  @error('twitter')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>

               <div class="mb-3">
                  <label for="facebook" class="form-label">Facebook Link<span class="text-danger">*</span></label>
                  <input type="text" name="facebook" value="{{!empty($homeFooter->facebook) ? $homeFooter->facebook : ''}}" class="form-control" id="facebook" placeholder="Facebook Link">
                  @error('facebook')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>

               <div class="mb-3">
                  <label for="instagram" class="form-label">Instagram Link<span class="text-danger">*</span></label>
                  <input type="text" name="instagram" value="{{!empty($homeFooter->instagram) ? $homeFooter->instagram : ''}}" class="form-control" id="instagram" placeholder="Instagram Link">
                  @error('instagram')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>
               @if(empty($homeFooter))
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
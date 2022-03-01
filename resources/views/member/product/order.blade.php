@extends('member.layouts.app')

@section('title', 'Place Order')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Place Order</h1>

   <!-- DataTales Example -->
   <div class="row">
      <div class="col-md-8">
         <div class="card shadow mb-4">
            <div>
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
            </div>
            <div class="card-header py-3">
               <a href="{{route('product.all.user')}}" class="btn btn-primary">Back To All Products</a>
            </div>

            <div class="card-body">
               <form action="{{route('product.order')}}" method="post">
                  @csrf
                  <input type="hidden" name="member_id" value="{{$member->id}}">
                  <input type="hidden" name="product_id" value="{{$product->id}}">

                  <div class="mb-3">
                     <label for="name" class="form-label">Full Name<span class="text-danger">*</span></label>
                     <input type="text" name="name" value="{{$member->first_name}} {{$member->last_name}}" class="form-control" id="name" placeholder="Full Name">
                     @error('name')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>

                  <div class="mb-3">
                     <label for="phone" class="form-label">Mobile Number<span class="text-danger">*</span></label>
                     <input type="text" name="phone" value="{{$member->mobile_no}}" class="form-control" id="phone" placeholder="Mobile Number">
                     @error('phone')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>

                  <div class="mb-3">
                     <label for="Address" class="form-label">Adress<span class="text-danger">*</span></label>
                     <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="Your address...">
                     @error('address')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>

                  <div class="mb-3">
                     <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                     <input type="text" name="city" value="{{$member->city}}" class="form-control" id="city" placeholder="city">
                     @error('city')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>

                  <div class="mb-3">
                     <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                     <input type="text" name="country" value="{{$member->country}}" class="form-control" id="country" placeholder="Country">
                     @error('country')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>

                  <div class="mb-3">
                     <label for="pin" class="form-label">Pin Code<span class="text-danger">*</span></label>
                     <input type="password" name="pin" required class="form-control" id="pin" placeholder="Enter Your Pin Code">
                     @error('pin')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>
                  <div>
                     <button type="submit" class="btn btn-rounded btn-primary">Place Order</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <div class="col-md-4">
         <div class="card">
            <div class="card-body">
               <img src="{{asset($product->product_image)}}" class="card-img-top" alt="...">
               <div class="text-center">
                  <h5 class="pt-1 card-title"><strong>{{$product->product_name}}</strong></h5>
                  <p class="">Category: {{$product->product_category}}</p>
                  <p class="text-grey-700"><strong>Description:</strong> {{$product->product_description}}</p>
                  <p class="text-danger">Price: {{$product->product_price}} Taka</p>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
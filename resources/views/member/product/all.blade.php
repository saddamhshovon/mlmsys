@extends('member.layouts.app')

@section('title', 'All Product')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">All Products</h1>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
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

      @foreach($products->chunk(4) as $prods)
      <div class="row m-2">
         @foreach($prods as $prod)
         <div class="col col-md-3 col-sm-12 px-2 py-1">
            <div class="card" style="color:rgba(0, 0, 0,0.8);">
               <div class="m-2">
                  <img src="{{asset($prod->product_image)}}" class="card-img-top" alt="...">
                  <div class="text-center">
                     <h5 class="pt-1 card-title"><strong>{{$prod->product_name}}</strong></h5>
                     <p>Category: {{$prod->product_category}}</p>
                     <p class="text-danger">Price: {{$prod->product_price}} Taka</p>
                     <a href="{{route('product.buy',['name'=>$prod->product_name,'id'=>$prod->id])}}" class="btn btn-primary">Place Order</a>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>
      @endforeach
      <div style="padding-left:12px;">
         {{$products->links()}}
      </div>

   </div>
</div>
@endsection
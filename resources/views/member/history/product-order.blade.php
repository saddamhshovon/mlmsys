@extends('member.layouts.app')

@section('title', 'Order History')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Order History</h1>

   <!-- DataTales Example -->
   <div class="card-body">
      <div class="table-responsive">
         <div class="row">
            <div class="col-sm-12">
               <table class="table table-bordered">
                  <thead class="bg-primary text-gray-200">
                     <tr role="row">
                        <th scope="col" width="5%">Sl</th>
                        <th scope="col" width="35%">Product Name</th>
                        <th scope="col" width="10%">Code</th>
                        <th scope="col" width="10%">Price</th>
                        <th scope="col" width="10%">Category</th>
                        <th scope="col" width="10%">Status</th>
                        <th scope="col" width="15%">Purchased At</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php($i=1)
                     @foreach($history as $hist)
                     <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$hist->product->product_name}}</td>
                        <td>{{$hist->product->product_code}}</td>
                        <td>{{$hist->product->product_price}}</td>
                        <td>{{$hist->product->product_category}}</td>
                        <td>
                           @if($hist->is_delivered==0)
                           <p class="badge badge-pill badge-dark">Pending</p>
                           @elseif(($hist->product->product_category=='Virtual')&&($hist->is_delivered==1))
                           <a target="_blank" href="{{ asset('/'.$hist->product->product_pdf) }}" class="badge badge-pill badge-success">Download</a>
                           @elseif($hist->is_delivered==1)
                           <p class="badge badge-pill badge-success">Delivered</p>
                           @endif
                        </td>
                        <td>
                           @if($hist->created_at == NULL)
                           <span class="text-danger">Not Date</span>
                           @else
                           {{$hist->created_at->diffForHumans()}}
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               {{$history->links()}}
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
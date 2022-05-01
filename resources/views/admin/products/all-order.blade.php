@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">All Orders</h1>

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
      <div class="card-body">
         <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
               <div class="row">
                  <div class="col-sm-12">
                     <table class="table table-bordered dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                        <thead>
                           <tr role="row">
                              <th class="text-center" scope="col" width="5%">SL</th>
                              <th class="text-center" scope="col" width="35%">Product Name</th>
                              <th class="text-center" scope="col" width="10%">Code</th>
                              <th class="text-center" scope="col" width="10%">Price</th>
                              <th class="text-center" scope="col" width="10%">Category</th>
                              <th class="text-center" scope="col" width="10%">Status</th>
                              <th class="text-center" scope="col" width="10%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php($i=1)
                           @foreach($history as $hist)
                           <tr class="">
                              <td class="text-center sorting_1">{{$i++}}</td>
                              <td class="text-center">{{isset($hist->product->product_name)?$hist->product->product_name:'Null'}}</td>
                              <td class="text-center">{{isset($hist->product->product_code)?$hist->product->product_code:'Null'}}</td>
                              <td class="text-center">{{$hist->price}}</td>
                              <td class="text-center">{{isset($hist->product->product_category)?$hist->product->product_category:'Null'}}</td>
                              <td class="text-center">
                                 @if($hist->is_delivered==0)
                                 <a href="{{route('product.order.approve',$hist->id)}}" class="badge badge-pill badge-dark">Pending</a>
                                 @else
                                 <a href="#" class="badge badge-pill badge-success">Delivered</a>
                                 @endif
                              </td>
                              <td class="text-center">
                                 <a href="{{route('product.order.delete',$hist->id)}}" id="delete" class="btn btn-danger vtn-sm"><i class="fas fa-trash-alt" title="Delete Data"></i></a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
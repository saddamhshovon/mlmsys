@extends('admin.layouts.app')

@section('title', 'Products')

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
      <div class="card-header py-3">
         <a href="{{route('product.add')}}" class="btn btn-primary">Add Product</a>
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
                              <th class="text-center" scope="col" width="30%">Name</th>
                              <th class="text-center" scope="col" width="10%">Code</th>
                              <th class="text-center" scope="col" width="10%">Price</th>
                              <th class="text-center" scope="col" width="10%">Category</th>
                              <th class="text-center" scope="col" width="10%">Image</th>
                              <th class="text-center" scope="col" width="10%">Status</th>
                              <th class="text-center" scope="col" width="15%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php($i=1)
                           @foreach($products as $prod)
                           <tr class="">
                              <td class="text-center sorting_1">{{$i++}}</td>
                              <td class="text-center">{{$prod->product_name}}</td>
                              <td class="text-center">{{$prod->product_code}}</td>
                              <td class="text-center">{{$prod->product_price}}</td>
                              <td class="text-center">{{$prod->product_category}}</td>
                              <td class="text-center"><img src="{{asset($prod->product_image)}}" style="width: 80px;height: 50px;" alt="Product Image"></td>
                              <td class="text-center">
                                 @if($prod->status==1)
                                 <a href="{{route('product.inactive',$prod->id)}}" id="is-active" class="badge badge-pill badge-success" title="Inactive Now">Active</a>
                                 @else
                                 <a href="{{route('product.active',$prod->id)}}" id="is-active" class="badge badge-pill badge-dark" title="Active Now">Inactive</a>
                                 @endif
                              </td>
                              <td class="text-center">
                                 <a href="{{route('product.edit',$prod->id)}}" class="btn btn-info vtn-sm"><i class="fas fa-edit" title="Edit Data"></i></a>
                                 <a href="{{route('product.delete',$prod->id)}}" id="delete" class="btn btn-danger vtn-sm"><i class="fas fa-trash-alt" title="Delete Data"></i></a>
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
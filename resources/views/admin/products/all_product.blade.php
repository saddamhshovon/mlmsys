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
         </div>
         @endif
         @if(session('error'))
         <div class="alert alert-success alert-danger fade show" role="alert">
            <strong>{{session('error')}}</strong>
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
                  <div class="col-sm-12 col-md-6">
                     <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                              <option value="10">10</option>
                              <option value="25">25</option>
                           </select> entries</label></div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div id="dataTable_filter" class="dataTables_filter float-right"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <table class="table table-bordered dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                        <thead>
                           <tr role="row">
                              <th class="text-center" scope="col" width="5%">SL</th>
                              <th class="text-center" scope="col" width="15%">Name</th>
                              <th class="text-center" scope="col" width="10%">Code</th>
                              <th class="text-center" scope="col" width="10%">Price</th>
                              <th class="text-center" scope="col" width="15%">Category</th>
                              <th class="text-center" scope="col" width="15%">Image</th>
                              <th class="text-center" scope="col" width="15%">Action</th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                              <th class="text-center" scope="col" width="5%">SL</th>
                              <th class="text-center" scope="col" width="15%">Name</th>
                              <th class="text-center" scope="col" width="10%">Code</th>
                              <th class="text-center" scope="col" width="10%">Price</th>
                              <th class="text-center" scope="col" width="15%">Category</th>
                              <th class="text-center" scope="col" width="15%">Image</th>
                              <th class="text-center" scope="col" width="15%">Action</th>
                           </tr>
                        </tfoot>
                        <tbody>
                           @php($i=1)
                           @foreach($products as $prod)
                           <tr class="">
                              <td class="text-center sorting_1">{{$i++}}</td>
                              <td class="text-center sorting_1">{{$prod->product_name}}</td>
                              <td class="text-center">{{$prod->product_code}}</td>
                              <td class="text-center">{{$prod->product_price}}</td>
                              <td class="text-center">{{$prod->product_category}}</td>
                              <td class="text-center"><img src="{{asset($prod->product_image)}}" style="width: 80px;height: 50px;" alt="Product Image"></td>
                              <td class="text-center">
                                 <a href="{{route('product.edit',$prod->id)}}" class="btn btn-info vtn-sm">Edit</a>
                                 <a href="{{route('product.delete',$prod->id)}}" id="delete" class="btn btn-danger vtn-sm">Delete</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12 col-md-5">
                     <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 5 entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                     <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                        <ul class="pagination">
                           <li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                           <li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                           <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                           <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
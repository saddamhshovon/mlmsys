@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Add Product</h1>

   <!-- DataTales Example -->
   <div class="row">
      <div class="col-8">
         <div class="card shadow mb-4">
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
            <div class="card-header py-3">
               <a href="{{route('product.all')}}" class="btn btn-primary">Back To All Product</a>
            </div>

            <div class="card-body">
               <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div>
                     <div class="mb-3">
                        <label for="product_name" class="form-label">Product Names<span class="text-danger">*</span></label>
                        <input type="text" name="product_name" value="{{old('product_name')}}" class="form-control" id="product_name" placeholder="Product Name">
                        @error('product_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_category" class="form-label">Product Category<span class="text-danger">*</span></label>
                        <select class="form-control form-control-md" name="product_category">
                           <option value="" selected="" disabled="">Select</option>
                           <option value="Physical">Physical</option>
                           <option value="Virtual">Virtual</option>
                        </select>
                        @error('product_category')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_code" class="form-label">Product Code<span class="text-danger">*</span></label>
                        <input type="text" name="product_code" value="{{old('product_code')}}" class="form-control" id="product_code" placeholder="Product Code">
                        @error('product_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price<span class="text-danger">*</span></label>
                        <input type="text" name="product_price" value="{{old('product_price')}}" class="form-control" id="product_price" placeholder="Product Price">
                        @error('product_price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea class="form-control" name="product_description" id="product_description" rows="2" placeholder="Product Description">{{old('product_description')}}</textarea>
                     </div>

                     <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image<span class="text-danger">*</span></label>
                        <input type="file" name="product_image" class="form-control" id="product_image" placeholder="Product Image">
                        @error('product_image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_pdf" class="form-label">Product PDF</label>
                        <input type="file" name="product_pdf" class="form-control" id="product_pdf" placeholder="Product PDF">
                        @error('product_pdf')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                  </div>
                  <div>
                     <button type="submit" class="btn btn-rounded btn-primary">Add New</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
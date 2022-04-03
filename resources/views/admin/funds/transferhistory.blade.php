@extends('admin.layouts.app')

@section('title', 'Fund Transfer History')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Fund Transfer History</h1>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="m-3">
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
                        <thead class="bg-primary text-gray-200">
                           <tr role="row" class="text-center">
                              <th scope="col" width="5%">Sl</th>
                              <th scope="col" width="15%">Sender</th>
                              <th scope="col" width="15%">Amount</th>
                              <th scope="col" width="15%">Reciever</th>
                              <th scope="col" width="15%">Transfered At</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php($i=1)
                           @foreach($history as $hist)
                           <tr class="text-center">
                              <th scope="row">{{$i++}}</th>
                              <td>{{$hist->sender}}</td>
                              <td>{{$hist->amount}}</td>
                              <td>{{$hist->receiver}}</td>
                              <td>
                                 @if($hist->created_at == NULL)
                                 <span class="text-danger">No Date</span>
                                 @else
                                 {{$hist->created_at}}
                                 @endif
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
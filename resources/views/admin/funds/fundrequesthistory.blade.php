@extends('admin.layouts.app')

@section('title', 'Active Members')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Add Fund Request</h1>

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
                        <thead>
                           <tr role="row">
                              <th class="text-center" scope="col" width="5%">SL</th>
                              <th class="text-center" scope="col" width="15%">Name</th>
                              <th class="text-center" scope="col" width="15%">Amount</th>
                              <th class="text-center" scope="col" width="10%">Mobile Banking</th>
                              <th class="text-center" scope="col" width="10%">Transaction ID</th>
                              <th class="text-center" scope="col" width="15%">Status</th>
                              <th class="text-center" scope="col" width="15%">Action</th>
                           </tr>
                        </thead>

                        <tbody>
                           @php($i=1)
                           @foreach($history as $hist)
                           <tr class="">
                              <td class="text-center sorting_1">{{$i++}}</td>
                              <td class="text-center"><a href="{{route('member.show',$hist->member->id)}}">{{$hist->user_name}}</a></td>
                              <td class="text-center">{{$hist->amount}}</td>
                              <td class="text-center">{{$hist->mobile_banking_service}}</td>
                              <td class="text-center">{{$hist->trx_id}}</td>
                              <td class="text-center">
                                 @if(($hist->is_approved==0)&&($hist->funding_type==1))
                                 <p class="badge badge-pill badge-dark">Pending</p>
                                 @elseif(($hist->is_approved==1)&&($hist->funding_type==1))
                                 <p class="badge badge-pill badge-success">Approved</p>
                                 @elseif(($hist->is_approved==2)&&($hist->funding_type==1))
                                 <p class="badge badge-pill badge-danger">Rejected</p>
                                 @endif
                              <td class="text-center">
                                 <a href="{{route('approve.fund.request',$hist->id)}}" id="approve" title="Approve Now" class="btn btn-info btn-sm"><i class="fas fa-check"></i></a>
                                 <a href="{{route('reject.fund.request',$hist->id)}}" id="reject" class="btn btn-dark btn-sm" title="Reject Now"><i class="fas fa-times"></i></a>
                                 <a href="{{route('delete.fund.request',$hist->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
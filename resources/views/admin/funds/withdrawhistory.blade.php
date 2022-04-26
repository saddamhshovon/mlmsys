@extends('admin.layouts.app')

@section('title', 'Active Members')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Withdraw Fund Request</h1>

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
                              <th class="text-center" scope="col" width="10%">Name</th>
                              <th class="text-center" scope="col" width="10%">Rank</th>
                              <th class="text-center" scope="col" width="10%">Requested Amount</th>
                              <th class="text-center" scope="col" width="10%">Total Withdraw</th>
                              <th class="text-center" scope="col" width="10%">Total Withdraw Amount</th>
                              <th class="text-center" scope="col" width="10%">Mobile Number</th>
                              <th class="text-center" scope="col" width="10%">Mobile Banking</th>
                              <th class="text-center" scope="col" width="10%">Date</th>
                              <th class="text-center" scope="col" width="10%">Status</th>
                              <th class="text-center" scope="col" width="15%">Action</th>
                           </tr>
                        </thead>

                        <tbody>
                           @php($i=1)
                           @foreach($history as $hist)
                           <tr class="">
                              <td class="text-center sorting_1">{{$i++}}</td>
                              <td class="text-center"><a href="{{route('admin.team.tree',$hist->member->id)}}">{{$hist->user_name}}</a></td>
                              <td class="text-center">{{ $hist->member->rank }}</td>
                              <td class="text-center">{{$hist->amount}}</td>
                              <td class="text-center">{{$hist->member->withdraw_count}}</td>
                              <td class="text-center">{{$hist->member->total_withdraw}}</td>
                              <td class="text-center">{{$hist->member->mobile_no}}</td>
                              <td class="text-center">{{$hist->mobile_banking_service}}</td>
                              <td class="text-center">{{$hist->created_at}}</td>
                              <td class="text-center">
                                 @if(($hist->is_approved==0)&&($hist->funding_type==0))
                                 <p class="badge badge-pill badge-dark">Pending</p>
                                 @elseif(($hist->is_approved==1)&&($hist->funding_type==0))
                                 <p class="badge badge-pill badge-success">Approved</p>
                                 @elseif(($hist->is_approved==2)&&($hist->funding_type==0))
                                 <p class="badge badge-pill badge-danger">Rejected</p>
                                 @endif
                              </td>
                              <td class="text-center">
                                 @if(($hist->is_approved==0)&&($hist->funding_type==0))
                                 <a href="{{route('approve.fund.withdraw.request',$hist->id)}}" id="approve" title="Approve Now" class="btn btn-info btn-sm"><i class="fas fa-check"></i></a>
                                 <a href="{{route('reject.fund.withdraw.request',$hist->id)}}" id="reject" class="btn btn-dark btn-sm" title="Reject Now"><i class="fas fa-times"></i></a>
                                 <a href="{{route('delete.fund.withdraw.request',$hist->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                 @endif
                                 @if(($hist->is_approved==1)&&($hist->funding_type==0))
                                 <a href="{{route('delete.fund.withdraw.request',$hist->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                 @endif
                                 @if(($hist->is_approved==2)&&($hist->funding_type==0))
                                 <a href="{{route('delete.fund.withdraw.request',$hist->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
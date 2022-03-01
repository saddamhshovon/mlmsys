@extends('member.layouts.app')

@section('title', 'Withdraw History')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Withdraw History</h1>

   <!-- DataTales Example -->
   <div class="card-body">
      <div class="table-responsive">
         <div class="row">
            <div class="col-sm-12">
               <table class="table table-bordered">
                  <thead class="bg-primary text-gray-200">
                     <tr role="row" class="text-center">
                        <th scope="col" width="5%">Sl</th>
                        <th scope="col" width="15%">User Name</th>
                        <th scope="col" width="15%">Amount</th>
                        <th scope="col" width="15%">Mobile Banking</th>
                        <th scope="col" width="15%">Status</th>
                        <th scope="col" width="15%">Requested At</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php($i=1)
                     @foreach($history as $hist)
                     <tr class="text-center">
                        <th scope="row">{{$i++}}</th>
                        <td>{{$hist->user_name}}</td>
                        <td>{{$hist->amount}}</td>
                        <td>{{$hist->mobile_banking_service}}</td>
                        <td>
                           @if(($hist->is_approved==0))
                           <p class="badge badge-pill badge-dark">Pending</p>
                           @elseif(($hist->is_approved==1))
                           <p class="badge badge-pill badge-success">Approved</p>
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
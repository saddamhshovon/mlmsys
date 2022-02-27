@extends('member.layouts.app')

@section('title', 'Fund Transfer History')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Fund Transfer History</h1>

   <!-- DataTales Example -->
   <div class="card-body">
      <div class="table-responsive">
         <div class="row">
            <div class="col-sm-12">
               <table class="table table-bordered">
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
                           {{Carbon\Carbon::parse($hist->created_at)->diffForHumans()}}
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
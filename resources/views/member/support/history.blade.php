@extends('member.layouts.app')

@section('title', 'Support History')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Support History</h1>

   <!-- DataTales Example -->
   <div class="card-body">
      <div class="table-responsive">
         <div class="row">
            <div class="col-sm-12">
               <table class="table table-bordered">
                  <thead class="bg-primary text-gray-200">
                     <tr role="row" class="text-center">
                        <th scope="col" width="5%">Sl</th>
                        <th scope="col" width="10%">User Name</th>
                        <th scope="col" width="10%">Type</th>
                        <th scope="col" width="30%">Message</th>
                        <th scope="col" width="30%">Reply</th>
                        <th scope="col" width="15%">Sent At</th>
                     </tr>
                  </thead>
                  <tbody>

                     @php($i=1)
                     @foreach($history as $hist)
                     <tr class="text-center">
                        <th scope="row">{{$i++}}</th>
                        <td>{{$hist->user_name}}</td>
                        <td>{{$hist->type}}</td>
                        <td class="text-center overflow-auto" style="border:none;background:transparent;outline:none;resize: none;"><textarea id="" disabled cols="30" rows="2">{{$hist->message}}</textarea></td>
                        <td class="text-center overflow-auto" style="border:none;background:transparent;outline:none;resize: none;"><textarea disabled cols="30" rows="2">{{$hist->reply ?? 'No reply yet'}}</textarea></td>
                        <td>
                           @if($hist->created_at == NULL)
                           <span class="text-danger">No Date</span>
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
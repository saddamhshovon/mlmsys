@extends('admin.layouts.app')

@section('title', 'Support Message')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Support Messages</h1>

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
                        <th scope="col" width="25%">Reply</th>
                        <th scope="col" width="10%">Action</th>
                        <th scope="col" width="10%">Sent At</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php($i=1)
                     @foreach($messages as $msg)
                     <tr class="text-center">
                        <th scope="row">{{$i++}}</th>
                        <td>{{$msg->user_name}}</td>
                        <td>{{$msg->type}}</td>
                        <td class="text-center" style="border:none;background:transparent;outline:none;resize: none;"><textarea disabled cols="30" rows="2">{{$msg->message}}</textarea></td>
                        <td class="text-center" style="border:none;background:transparent;outline:none;resize: none;"><textarea disabled cols="30" rows="2">{{$msg->reply ?? 'Not replied yet'}}</textarea></td>
                        <td>
                           @if($msg->read===0)
                           <a class="font-weight-bold" href="{{route('support.show.message',$msg->id)}}">Reply</a>
                           @else
                           <p class="badge badge-pill badge-success">Replied</p>
                           @endif
                        </td>
                        <td>
                           @if($msg->created_at == NULL)
                           <span class="text-danger">No Date</span>
                           @else
                           {{$msg->created_at->diffForHumans()}}
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               {{$messages->links()}}
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
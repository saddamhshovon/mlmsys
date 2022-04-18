@extends('admin.layouts.app')

@section('title', 'Leader Board')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Leader Board</h1>

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
                        <th scope="col" width="15%">Total Income</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php($i=1)
                     @foreach($leaderBoard as $board)
                     <tr class="text-center">
                        <th scope="row">{{$i++}}</th>
                        <td>{{$board->user_name}}</td>
                        <td>{{$board->total_income}}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
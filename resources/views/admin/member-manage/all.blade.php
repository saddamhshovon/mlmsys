@extends('admin.layouts.app')

@section('title', 'All Members')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">All Members</h1>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div>
         @if(session('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
         </div>
         @endif
         @if(session('error'))
         <div class="alert alert-success alert-danger fade show" role="alert">
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
                              <th class="text-center" scope="col" width="10%">City</th>
                              <th class="text-center" scope="col" width="10%">Country</th>
                              <th class="text-center" scope="col" width="15%">Balance</th>
                              <th class="text-center" scope="col" width="15%">Status</th>
                              <th class="text-center" scope="col" width="15%">Action</th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                              <th class="text-center" scope="col" width="5%">SL</th>
                              <th class="text-center" scope="col" width="15%">Name</th>
                              <th class="text-center" scope="col" width="10%">City</th>
                              <th class="text-center" scope="col" width="10%">Country</th>
                              <th class="text-center" scope="col" width="15%">Balance</th>
                              <th class="text-center" scope="col" width="15%">Status</th>
                              <th class="text-center" scope="col" width="15%">Action</th>
                           </tr>
                        </tfoot>
                        <tbody>
                           @php($i=1)
                           @foreach($members as $mem)
                           <tr>
                              <td class="text-center sorting_1">{{$i++}}</td>
                              <td class="text-center">{{$mem->first_name}} {{$mem->last_name}}</td>
                              <td class="text-center">{{$mem->city}}</td>
                              <td class="text-center">{{$mem->country}}</td>
                              <td class="text-center">{{$mem->account_balance}}</td>
                              @if(($mem->is_active)==1)
                              <td class="text-center text-success" style="font-weight: bold;">Active</td>
                              @elseif(($mem->is_blocked)==1)
                              <td class="text-center text-danger" style="font-weight: bold;">Blocked</td>
                              @elseif(($mem->is_expired)==1)
                              <td class="text-center text-warning" style="font-weight: bold;">Expired</td>
                              @else
                              <td class="text-center text-primary" style="font-weight: bold;">Inactive</td>
                              @endif
                              <td class="text-center">
                                 @if(($mem->is_active==0)&&($mem->is_blocked==0)&&($mem->is_expired==0))
                                 <a href="{{route('member.is-active',$mem->id)}}" class="btn btn-primary btn-sm" title="Activate Now"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                 @elseif(($mem->is_active)==1)
                                 <a href="{{route('member.is-inactive',$mem->id)}}" class="btn btn-success btn-sm"><i class="fas fa-arrow-alt-circle-up" title="Deactivate Now"></i></a>
                                 @elseif($mem->is_blocked==1)
                                 <a href="{{route('member.is-blocked',$mem->id)}}" class="btn btn-danger btn-sm" title="Unblock Now"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                 @elseif($mem->is_expired==1)
                                 <a href="#" class="btn btn-warning btn-sm" title="Expired"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                 @endif

                                 <a href="{{route('member.show',$mem->id)}}" class="btn btn-info btn-sm" title="View Data"><i class="far fa-eye"></i></a>
                                 <a href="{{route('member.edit',$mem->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit" title="Edit Data"></i></a>

                                 <a href="{{route('member.delete',$mem->id)}}" id="delete" class="btn btn-danger btn-sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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
@extends('admin.layouts.app')

@section('title', 'All Notification')

@section('content')

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">All Notification</h1>
</div>

<div class="row">
   <div class="col-xl-6 col-md-6 mb-4">
      <div class="card shadow mb-4">
         <div class="card-body">
            <!-- @php($admin = App\Models\Admin::find(1))

            @if($admin->id === 1) -->

            @foreach($notifications as $notification)
            <a class="dropdown-item d-flex align-items-center" href="#">
               <div>
                  <span class="font-weight-bold">{{$notification->data['user_name']}}
                     @if(isset($notification->data['is_active']))
                     @if($notification->data['is_active'] === 1)
                     <p class="text-success">Registered Successfully!</p>
                     @elseif($notification->data['is_active'] === 0)
                     <p class="text-success">Registered successfully but not activated</p>
                     @endif
                     @endif

                     @if(isset($notification->data['f_type']))
                     @if($notification->data['f_type'] === 0)
                     <p class="text-success">has sent a withdraw request!</p>
                     @elseif($notification->data['f_type'] === 1)
                     <p class="text-success">has sent a fund add request!</p>
                     @endif
                     @endif
                  </span>
               </div>
            </a>
            @endforeach

            <!-- @endif -->
         </div>
         <div class="m-auto">{{$notifications->links()}}</div>
      </div>
   </div>
</div>

@endsection
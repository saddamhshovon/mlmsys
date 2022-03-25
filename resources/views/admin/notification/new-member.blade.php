@extends('admin.layouts.app')

@section('title', 'New Member Notification')

@section('content')

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-2">
   <h1 class="h3 mb-0 text-gray-800">New Member Notification</h1>
</div>

<div>
   <a class="mr-2" style="text-decoration: none;" href="{{ route('all.notification') }}">All Notifications</a>
   <a class="mr-2" style="text-decoration: none;" href="{{ route('new.member.notification') }}">New Member</a>
   <a class="mr-2" style="text-decoration: none;" href="{{ route('withdraw.fund.notification') }}">Withdraw Fund</a>
   <a class="mr-2" style="text-decoration: none;" href="{{ route('add.fund.notification') }}">Add Fund</a>
   <a class="mr-2" style="text-decoration: none;" href="{{ route('read.notification') }}">Read</a>
   <a class="mr-2" style="text-decoration: none;" href="{{ route('unread.notification') }}">Unread</a>
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
@extends('member.layouts.app')

@section('title', 'My Teams')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">My Teams</h1>

   <!-- DataTales Example -->
   <div class="card-body">
      <div class="table-responsive">
         <div class="row">
            <div class="col-sm-12">
               <table class="table table-bordered">
                  <thead class="bg-primary text-gray-200">
                     <tr role="row" class="text-center">
                        <th scope="col" width="5%">Sl</th>
                        <th scope="col" width="25%">Name</th>
                        <th scope="col" width="25%">Username</th>
                        <th scope="col" width="40%">Team Name</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php($i=1)
                     @foreach($children as $child)
                     <tr class="text-center">
                        <th scope="row">{{$i++}}</th>
                        <td>{{$child->first_name}}</td>
                        <td>{{$child->user_name}}</td>
                        @if(!isset($child->team))
                        <td>Team is not set <span>
                           <form action="{{route('team.set', $child->id )}}}" method="POST" style="display: inline-block">
                           @csrf
                              <select name="team">
                                 <option>Select Team</option>
                                 @for($j=0; $j< ($parent->max_children - $hasTeam); $j++)
                                 <option value="{{ $defaultTeams[$j] }}">{{ $defaultTeams[$j] }}</option>
                                 @endfor
                              </select>
                              <button type="submit" class="btn btn-primary">Set</button>
                              </form>
                           </span></td>
                        @else
                        <td class="text-primary font-weight-bold">{{$child->team}}</td>
                        @endif
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
@extends('member.layouts.app')

@section('title', 'My Team')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tree</h1>
</div>

<div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-xl-3 col-md-3 mb-4 mx-auto">
                    <div class="card border-bottom-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="text-xs text-center font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $parent->user_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($children as $child)
                    <div class="col-auto mx-auto">
                        <div class="card border-bottom-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-xs text-center font-weight-bold text-primary text-uppercase mb-1">
                                            <a href="{{ route('team.tree', $child->id) }}" title="Team: {{$child->team ?? 'None'}}">{{ $child->user_name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
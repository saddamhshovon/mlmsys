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
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
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
                    @for($i=0; $i < $parent->has_children; $i++)
                        <div class="col-auto">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs text-center font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="{{ route('team.tree', $children[$i]->id) }}">{{ $children[$i]->user_name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
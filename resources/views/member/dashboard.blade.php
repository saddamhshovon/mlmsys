@extends('member.layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <marquee width="60%" style="display: block;margin: 0 auto; font-weight:600;" class="text-primary text-center" direction="center" height="20px">
        {{isset($notice->dashboard_notice) ? $notice->dashboard_notice : "We are here to remove poverty from society with some income facilities."}}
    </marquee>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    @php
    $id = session('MEMBER_ID');
    $user = DB::table('members')->find($id);
    $genIncome = DB::table('incomes')->where(['user_name'=>$user->user_name,'income_type'=>'Generation'])->sum('amount');
    $refIncome = DB::table('incomes')->where(['user_name'=>$user->user_name,'income_type'=>'Referral'])->sum('amount');
    @endphp
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Ballance in Wallet</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user->account_balance}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Earn</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$refIncome+$genIncome}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<!-- Content Row -->
<div class="row">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Generation Earn</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$genIncome}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Referral Earn</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$refIncome}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Withdraw</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user->total_withdraw}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->

@endsection
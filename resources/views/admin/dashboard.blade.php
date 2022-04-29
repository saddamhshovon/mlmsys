@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    @php
    use Carbon\Carbon;
    $totalUsers = DB::table('members')->count();
    $totalTransferFunds = DB::table('transfer_funds')->sum('tax');
    $tax = DB::table("tax_on_withdraw")->first();
    $tax = isset($tax->tax) ? $tax->tax : 0;
    $totalWithdrawFunds = DB::table('funds')->where('funding_type',0)->where('is_approved',1)->sum('tax');
    $totalProductSales = DB::table('orders')->sum('price');

    $totalRegIncome = DB::table('incomes')->where('income_type','New User')->sum('amount');

    $dailyIncomeTransfer = DB::table('transfer_funds')->whereDate('created_at',date('Y-m-d'))->sum('tax');
    $dailyIncomeWithdraw = DB::table('funds')->where('funding_type',0)->where('is_approved',1)->whereDate('created_at',date('Y-m-d'))->sum('tax');
    $dailyIncomeReg = DB::table('incomes')->where('income_type','New User')->whereDate('created_at',date('Y-m-d'))->sum('amount');

    $weeklyIncomeTransfer = DB::table('transfer_funds')->whereBetween('created_at', [
    Carbon::parse('last saturday')->startOfDay(),
    Carbon::parse('next thursday')->endOfDay(),
    ])->sum('tax');
    $weeklyIncomeWithdraw = DB::table('funds')->where('funding_type',0)->where('is_approved',1)->whereBetween('created_at', [
    Carbon::parse('last saturday')->startOfDay(),
    Carbon::parse('next thursday')->endOfDay(),
    ])->sum('tax');
    $weeklyIncomeReg = DB::table('incomes')->where('income_type','New User')->whereBetween('created_at', [
    Carbon::parse('last saturday')->startOfDay(),
    Carbon::parse('next thursday')->endOfDay(),
    ])->sum('amount');

    $monthlyIncomeTransfer = DB::table('transfer_funds')->whereMonth('created_at',date('m'))->sum('tax');
    $monthlyIncomeWithdraw = DB::table('funds')->where('funding_type',0)->where('is_approved',1)->whereMonth('created_at',date('m'))->sum('tax');
    $monthlyIncomeReg = DB::table('incomes')->where('income_type','New User')->whereMonth('created_at',date('m'))->sum('amount');
    @endphp

    <!-- Earnings (Monthly) Card Example -->

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalUsers}}</div>
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
                            Total Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalTransferFunds+$totalWithdrawFunds+$totalRegIncome}}</div>
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
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Transfer Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalTransferFunds}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Withdraw Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalWithdrawFunds}}</div>
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
<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Product Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalProductSales}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total registration Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalRegIncome}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Daily Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$dailyIncomeTransfer+$dailyIncomeWithdraw+$dailyIncomeReg}}</div>
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
                            Weekly Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $weeklyIncomeTransfer+$weeklyIncomeWithdraw+$weeklyIncomeReg }}</div>
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
                            Monthly Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monthlyIncomeTransfer+$monthlyIncomeWithdraw+$monthlyIncomeReg }}</div>
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
<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leaderBoard()
    {
        $leaderBoard = DB::table('incomes')
            ->select('user_name', DB::raw('SUM(amount) as total_income'))
            ->groupBy('user_name')
            ->orderBy('total_income', 'desc')
            ->take(20)
            ->get();

        // dd($leaderBoard);
        return view('member.leaderboard.all', compact('leaderBoard'));
    }

    public function leaderBoardAdmin()
    {
        $leaderBoard = DB::table('incomes')
            ->select('user_name', DB::raw('SUM(amount) as total_income'))
            ->groupBy('user_name')
            ->orderBy('total_income', 'desc')
            ->take(20)
            ->get();

        // dd($leaderBoard);
        return view('admin.leaderboard.all', compact('leaderBoard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}

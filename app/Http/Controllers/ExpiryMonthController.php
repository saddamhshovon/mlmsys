<?php

namespace App\Http\Controllers;

use App\Models\ExpiryMonth;
use Illuminate\Http\Request;

class ExpiryMonthController extends Controller
{
    public function indexMonths()
    {
        $months = ExpiryMonth::first();

        return view('admin.expire.time',compact('months'));
    }

    public function createMonths(Request $request){
        // dd($request->all());
        $request->validate([
            'months' => 'required|numeric|gt:0|lte:12'
        ]);

        $months = new ExpiryMonth();
        $months->months = $request->months;
        $months->save();

        return back();
    }

    public function deleteMonths(){
        ExpiryMonth::truncate();

        return back();
    }
}

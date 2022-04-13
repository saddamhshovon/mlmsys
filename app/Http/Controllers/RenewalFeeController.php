<?php

namespace App\Http\Controllers;

use App\Models\RenewalFee;
use Illuminate\Http\Request;

class RenewalFeeController extends Controller
{
    public function index()
    {
        $fee = RenewalFee::first();

        return view('admin.expire.renew-fee',compact('fee'));
    }

    public function create(Request $request){
        // dd($request->all());
        $request->validate([
            'fee' => 'required|numeric|gt:0'
        ]);

        $fee = new RenewalFee();
        $fee->fee = $request->fee;
        $fee->save();

        return back();
    }

    public function delete(){
        RenewalFee::truncate();

        return back();
    }

}

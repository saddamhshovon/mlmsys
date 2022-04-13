<?php

namespace App\Http\Controllers;

use App\Models\MobileBanking;
use Illuminate\Http\Request;

class MobileBankingController extends Controller
{
    public function index(){
        $mobiles = MobileBanking::get();

        return view('admin.mobilebanking.index', compact('mobiles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $mobile = new MobileBanking();
        $mobile->name = $request->name;
        $mobile->save();

        return back();
    }

    public function delete(MobileBanking $mobile){

        // dd($mobile);
        $mobile->delete();

        return back();
    }
}

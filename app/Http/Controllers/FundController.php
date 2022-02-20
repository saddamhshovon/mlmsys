<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function transferFund()
    {
        return view('member.fund.transfer');
    }
    public function transferFundRequest(Request $request)
    {
        $request->validate([
            "user_name" => 'required|exists:members,user_name',
            "amount" => 'required|numeric',
            "pin" => 'required',
        ]);
        dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     "user_name" => 'required|exists:members,user_name',
        //     "amount" => 'required|numeric',
        //     "pin" => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $validator->errors()->toArray()
        //     ]);
        // } 
        // else {
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Successfully Transfered',
        //     ]);
        // }
        //     // $data = [
        //     //     // "user_name" => $request->user_name,
        //     //     // "password" => $request->password,
        //     // ];
        // return view('member.fund.transfer');
    }


    public function addFundReq()
    {
        return view('member.fund.add');
    }
    public function withdrawFund()
    {
        return view('member.fund.withdraw');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "amount" => 'required|numeric',
            "mobile_banking_system" => 'required',
            "trx_id" => 'required',
            "pin" => 'required|numeric',
        ]);

        $member = DB::table('members')
            ->select('user_name', 'pin')
            ->where([
                'id' => session()->get('MEMBER_ID')
            ])
            ->get();

        if ($member[0]->pin == $request->pin) {
            $fund = new Fund();
            $fund->user_name = $member[0]->user_name;
            $fund->amount = $request->amount;
            $fund->moblie_banking_service = $request->mobile_banking_system;
            $fund->trx_id = $request->trx_id;
            $fund->funding_type = 1;
            $fund->save();

            return redirect()->back()->with('success', 'Successfully placed request for adding fund.');
        } else {
            return redirect()->back()->with('failed', 'Wrong pin number. Please enter correct pin.')->withInput();
        }
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            "amount" => 'required|numeric',
            "pin" => 'required|numeric',
        ]);
        $member = DB::table('members')
            ->select('user_name', 'account_balance', 'pin')
            ->where([
                'id' => session()->get('MEMBER_ID')
            ])
            ->get();
        if ($member[0]->account_balance > $request->amount) {
            if ($member[0]->pin == $request->pin) {
                $fund = new Fund();
                $fund->user_name = $member[0]->user_name;
                $fund->amount = $request->amount;
                $fund->funding_type = 0;
                $fund->save();

                $newBalance = $member[0]->account_balance - $request->amount;

                DB::table('members')
                    ->where([
                        'id' => session()->get('MEMBER_ID')
                    ])
                    ->update([
                        'account_balance' => $newBalance
                    ]);

                return redirect()->back()->with('success', 'Successfully placed request for withdrawing fund.');
            } else {
                return redirect()->back()->with('failed', 'Wrong pin number. Please enter correct pin.')->withInput();
            }
        } else {
            return redirect()->back()->with('failed', 'You do not have sufficient balance.')->withInput();
        }
        // dd($member);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        //
    }
}

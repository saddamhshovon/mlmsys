<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $sender = DB::table('members')
            ->select('user_name', 'account_balance', 'pin')
            ->where([
                'id' => session()->get('MEMBER_ID')
            ])
            ->get();
            // dd($sender);
        if ($request->user_name != $sender[0]->user_name) {
            if ($sender[0]->account_balance > $request->amount) {
                if ($sender[0]->pin == $request->pin) {
                    $data = [
                        "sender" => $sender[0]->user_name,
                        "amount" => $request->amount,
                        "receiver" => $request->user_name,
                        "created_at" => Carbon::now(),
                    ];

                    $query = DB::table('transfer_funds')->insert($data);

                    if ($query) {
                        $newBalanceSender = $sender[0]->account_balance - $request->amount;

                        $senderUp = DB::table('members')
                            ->where([
                                'id' => session()->get('MEMBER_ID')
                            ])
                            ->update([
                                'account_balance' => $newBalanceSender
                            ]);
                        if ($senderUp) {
                            $receiver = DB::table('members')
                                ->select('account_balance')
                                ->where([
                                    'user_name' => $request->user_name
                                ])
                                ->get();
                            $newBalanceReceiver = $receiver[0]->account_balance + $request->amount;

                            $receiverUp = DB::table('members')
                                ->where([
                                    'user_name' => $request->user_name
                                ])
                                ->update([
                                    'account_balance' => $newBalanceReceiver
                                ]);
                            if ($receiverUp) {
                                return redirect()->back()->with('success', 'Successfully transfered fund.');
                            } else { 
                                return redirect()->back()->with('failed', 'Could not transfer fund. Please try again.');
                            }
                        } else {
                            return redirect()->back()->with('failed', 'Could not transfer fund. Please try again.');
                        }
                    } else {
                        return redirect()->back()->with('failed', 'Could not transfer fund. Please try again.');
                    }
                } else {
                    return redirect()->back()->with('failed', 'Wrong pin number. Please enter correct pin.')->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'You do not have sufficient balance.')->withInput();
            }
        } else {
            return redirect()->back()->with('failed', 'Please enter a valid username.')->withInput();
        }
        // dd($request->all());
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

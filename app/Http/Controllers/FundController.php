<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fund;
use App\Models\Rank;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\MobileBanking;
use Illuminate\Support\Facades\DB;
use App\Notifications\WithdrawFundNotification;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fundsTax()
    {

        $tax = DB::table("tax_on_transfer")
            ->first();

        // dd($levels);
        return view('admin.funds.taxontransfer', compact('tax'));
    }
    public function fundsTaxFix(Request $request)
    {
        $request->validate([
            "tax" => 'required|numeric'
        ]);

        DB::table("tax_on_transfer")
            ->insert([
                "tax" => $request->tax,
                "created_at" => Carbon::now()
            ]);
        return redirect()->back();
    }
    public function fundsTaxChange(Request $request)
    {
        $request->validate([
            "tax" => 'required|numeric'
        ]);

        $tax = DB::table("tax_on_transfer")
            ->first();
        DB::table("tax_on_transfer")
            ->where('id', $tax->id)
            ->update([
                'tax' => $request->tax,
                'updated_at' => Carbon::now()
            ]);

        DB::table("registration_funds")
            ->insert([
                "amount" => $request->amount,
            ]);
        return redirect()->back();
    }
    public function newUserFund()
    {

        $regfund = DB::table("registration_funds")
            ->first();

        // dd($levels);
        return view('admin.funds.newuserfund', compact('regfund'));
    }
    public function newUserFundFix(Request $request)
    {
        $request->validate([
            "amount" => 'required|numeric'
        ]);

        DB::table("registration_funds")
            ->insert([
                "amount" => $request->amount,
            ]);
        return redirect()->back();
    }
    public function newUserFundChange(Request $request)
    {
        $request->validate([
            "amount" => 'required|numeric'
        ]);

        $amount = DB::table("registration_funds")
            ->first();
        DB::table("registration_funds")
            ->where('id', $amount->id)
            ->update([
                'amount' => $request->amount,
            ]);

        return redirect()->back();
    }

    public function referralIncome()
    {

        $regfund = DB::table("referral_income_amount")
            ->first();

        // dd($levels);
        return view('admin.funds.referralincome', compact('regfund'));
    }
    public function referralIncomeFix(Request $request)
    {
        $request->validate([
            "amount" => 'required|numeric'
        ]);

        DB::table("referral_income_amount")
            ->insert([
                "amount" => $request->amount,
            ]);
        return redirect()->back();
    }
    public function referralIncomeChange(Request $request)
    {
        $request->validate([
            "amount" => 'required|numeric'
        ]);

        $amount = DB::table("referral_income_amount")
            ->first();
        DB::table("referral_income_amount")
            ->where('id', $amount->id)
            ->update([
                'amount' => $request->amount,
            ]);

        return redirect()->back();
    }

    public function withdrawTax()
    {

        $tax = DB::table("tax_on_withdraw")
            ->first();

        // dd($levels);
        return view('admin.funds.taxonwithdraw', compact('tax'));
    }
    public function withdrawTaxFix(Request $request)
    {
        $request->validate([
            "tax" => 'required|numeric'
        ]);

        DB::table("tax_on_withdraw")
            ->insert([
                "tax" => $request->tax,
                "created_at" => Carbon::now()
            ]);
        return redirect()->back();
    }
    public function withdrawTaxChange(Request $request)
    {
        $request->validate([
            "tax" => 'required|numeric'
        ]);

        $tax = DB::table("tax_on_withdraw")
            ->first();
        DB::table("tax_on_withdraw")
            ->where('id', $tax->id)
            ->update([
                'tax' => $request->tax,
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back();
    }

    public function withdrawAmount()
    {

        $min = DB::table("withdraw_amount")
            ->first();

        // dd($levels);
        return view('admin.funds.min-withdraw', compact('min'));
    }
    public function withdrawAmountFix(Request $request)
    {
        $request->validate([
            "min" => 'required|numeric'
        ]);

        DB::table("withdraw_amount")
            ->insert([
                "min" => $request->min,
                "created_at" => Carbon::now()
            ]);
        return redirect()->back();
    }
    public function withdrawAmountChange(Request $request)
    {
        $request->validate([
            "min" => 'required|numeric'
        ]);

        $min = DB::table("withdraw_amount")
            ->first();
        DB::table("withdraw_amount")
            ->where('id', $min->id)
            ->update([
                'min' => $request->min,
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back();
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
        $tax = DB::table("tax_on_transfer")
            ->first();

        return view('member.fund.transfer', compact('tax'));
    }
    public function transferFundRequest(Request $request)
    {
        $request->validate([
            "user_name" => 'required|exists:members,user_name',
            "amount" => 'required|numeric',
            "pin" => 'required',
        ]);

        $tax = DB::table("tax_on_transfer")
            ->first();

        $sender = DB::table('members')
            ->where([
                'id' => session()->get('MEMBER_ID')
            ])
            ->get();
        // dd($sender);
        if($sender[0]->is_expired == 1 || $sender[0]->is_active == 0 || $sender[0]->is_blocked == 1){
            return back()->with('failed', 'You are not eligible to transfer fund.');
        }
        if ($request->user_name != $sender[0]->user_name) {
            if ($sender[0]->account_balance > ($request->amount + ($request->amount * $tax->tax / 100))) {
                if ($sender[0]->pin == $request->pin) {
                    $data = [
                        "sender" => $sender[0]->user_name,
                        "amount" => $request->amount,
                        "receiver" => $request->user_name,
                        "tax" => ($request->amount * $tax->tax / 100),
                        "created_at" => Carbon::now(),
                    ];

                    $query = DB::table('transfer_funds')->insert($data);

                    if ($query) {
                        $newBalanceSender = $sender[0]->account_balance - ($request->amount + ($request->amount * $tax->tax / 100));

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
        $mobiles = MobileBanking::get();
        return view('member.fund.add', compact('mobiles'));
    }
    public function withdrawFund()
    {
        $mobiles = MobileBanking::get();
        return view('member.fund.withdraw', compact('mobiles'));
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
            $fund->mobile_banking_service = $request->mobile_banking_system;
            $fund->trx_id = $request->trx_id;
            $fund->funding_type = 1;
            $fund->save();

            $admin = Admin::find(1);
            $admin->notify(new WithdrawFundNotification($fund));

            return redirect()->back()->with('success', 'Successfully placed request for adding fund.');
        } else {
            return redirect()->back()->with('failed', 'Wrong pin number. Please enter correct pin.')->withInput();
        }
    }

    public function withdraw(Request $request)
    {
        // dd($request->all());
        $min = DB::table("withdraw_amount")
            ->first();

        $request->validate([
            "amount" => 'required|numeric|gte:' . $min->min,
            "mobile_banking_service" => 'required',
            "pin" => 'required|numeric',
        ]);

        $member = DB::table('members')
            ->where([
                'id' => session()->get('MEMBER_ID')
            ])
            ->get();
        // dd($member);
        $tax = DB::table("tax_on_withdraw")
            ->select('tax')
            ->first();
        $rank = Rank::where('withdraw_rank', 1)->first();
        
        if($member[0]->is_expired == 1 || $member[0]->is_active == 0 || $member[0]->is_blocked == 1){
            return back()->with('failed', 'You are not eligible to transfer fund.');
        }

        if ($member[0]->has_children >= $rank->min_user) {
            if ($member[0]->account_balance > $request->amount + ($request->amount * $tax->tax/100)) {
                if ($member[0]->pin == $request->pin) {
                    $fund = new Fund();
                    $fund->user_name = $member[0]->user_name;
                    $fund->mobile_banking_service = $request->mobile_banking_service;
                    $fund->amount = $request->amount;
                    $fund->funding_type = 0;
                    $fund->tax = $request->amount * $tax->tax/100;
                    $fund->save();

                    $newBalance = $member[0]->account_balance - $request->amount - ($request->amount * $tax->tax/100);

                    DB::table('members')
                        ->where([
                            'id' => session()->get('MEMBER_ID')
                        ])
                        ->update([
                            'account_balance' => $newBalance
                        ]);

                    $admin = Admin::find(1);
                    $admin->notify(new WithdrawFundNotification($fund));

                    return redirect()->back()->with('success', 'Successfully placed request for withdrawing fund.');
                } else {
                    return redirect()->back()->with('failed', 'Wrong pin number. Please enter correct pin.')->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'You do not have sufficient balance.')->withInput();
            }
        }else{
            return redirect()->back()->with('failed', 'You do not meet minimum requirement to withdraw funds.')->withInput();
        }
        // dd($member);
    }

    //////////////             FUND HISTORY              ///////////////

    public function fundAddRequestHistory()
    {
        $member_id = session('MEMBER_ID');
        $member = Member::findOrFail($member_id);
        $username = $member->user_name;
        $history = Fund::where('user_name', $username)->where('funding_type', 1)->latest()->paginate(8);
        return view('member.history.fund-request', compact('history'));
    }

    public function fundWithdrawRequestHistory()
    {
        $member_id = session('MEMBER_ID');
        $member = Member::findOrFail($member_id);
        $username = $member->user_name;
        $history = Fund::where('user_name', $username)->where('funding_type', 0)->latest()->paginate(8);
        return view('member.history.withdraw', compact('history'));
    }

    public function fundTransferHistory()
    {
        $member_id = session('MEMBER_ID');
        $member = Member::findOrFail($member_id);
        $sender = $member->user_name;
        $history = DB::table('transfer_funds')->where('sender', $sender)->latest()->paginate(8);
        return view('member.history.transfer', compact('history'));
    }

    public function allFundAddRequestHistory()
    {
        $history = Fund::latest()->get()->where('funding_type', 1);
        return view('admin.funds.fundrequesthistory', compact('history'));
    }

    public function apprveFundAddRequest($id)
    {
        $isApprove = Fund::findOrFail($id);
        $isApprove->is_approved = 1;
        $isApprove->member->account_balance = $isApprove->member->account_balance + $isApprove->amount;
        $isApprove->save();
        $isApprove->member->save();

        return redirect()->back();
    }

    public function rejectFundAddRequest($id)
    {
        $isApprove = Fund::findOrFail($id);
        $isApprove->is_approved = 2;
        $isApprove->save();
        return redirect()->back();
    }

    public function deleteFundAddRequest($id)
    {
        Fund::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Fund History Deleted Successfully..');
    }

    public function allWithdrawFundHistory()
    {
        $history = Fund::latest()->get()->where('funding_type', 0);
        // dd($history->all());
        return view('admin.funds.withdrawhistory', compact('history'));
    }

    public function apprveFundWithdrawRequest($id)
    {
        $isApprove = Fund::findOrFail($id);
        $isApprove->is_approved = 1;
        $isApprove->member->withdraw_count = $isApprove->member->withdraw_count + 1;
        $isApprove->member->total_withdraw = $isApprove->member->total_withdraw + $isApprove->amount;
        // dd($isApprove->withdraw_count);
        $isApprove->save();
        $isApprove->member->save();
        return redirect()->back();
    }

    public function rejectFundWithdrawRequest($id)
    {
        $tax = DB::table("tax_on_withdraw")
            ->select('tax')
            ->first();

        $isApprove = Fund::findOrFail($id);
        $isApprove->is_approved = 2;
        $isApprove->member->account_balance = $isApprove->member->account_balance + ($isApprove->amount + ($isApprove->amount * $tax->tax / 100));
        $isApprove->save();
        $isApprove->member->save();
        return redirect()->back();
    }

    public function deleteFundWithdrawRequest($id)
    {
        Fund::findOrFail($id)->delete();
        return redirect()->back()->with('success', ' History Deleted Successfully..');
    }


    public function allTransferFundHistory()
    {
        $history = DB::table('transfer_funds')->latest()->get();
        return view('admin.funds.transferhistory', compact('history'));
    }
}

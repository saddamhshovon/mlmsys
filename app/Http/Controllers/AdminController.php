<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Member;
use App\Models\notice;
use App\Models\Country;
use PharIo\Manifest\Email;
use Illuminate\Http\Request;
use App\Models\MobileBanking;
use App\Models\MembershipType;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use PHPUnit\Framework\Error\Notice as ErrorNotice;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function hands()
    {
        $hands = DB::table("max_children")
            ->first();

        // dd($levels);
        return view('admin.hands.fix', compact('hands'));
    }
    public function handsFix(Request $request)
    {
        $request->validate([
            "hands" => 'required|numeric|min:1|max:10'
        ]);

        DB::table("max_children")
            ->insert([
                "max" => $request->hands,
                "created_at" => Carbon::now()
            ]);
        return redirect()->back();
    }
    public function handsChange(Request $request)
    {
        $request->validate([
            "hands" => 'required|numeric|min:1|max:10'
        ]);

        $hands = DB::table("max_children")
            ->first();
        DB::table("max_children")
            ->where('id', $hands->id)
            ->update([
                'max' => $request->hands,
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $email = $request->post('email');
        $pass = $request->post('password');

        // $admin = Admin::where(['email' => $email, 'password' => $pass])->get();
        $admin = Admin::where(['email' => $email])->first();

        if (!isset($admin->id)) {
            $request->session()->flash('error', 'Please enter valid credentials.');
            return redirect('admin/login');
        } else {
            if ($admin->password == $pass) {
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID', $admin->id);
                return redirect('admin');
            } else {
                $request->session()->flash('error', 'Please enter correct password.');
                return redirect('admin/login');
            }
        }
    }

    /**
     * Display login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (session()->has('ADMIN_LOGIN') || session()->has('MEMBER_LOGIN')) {
            return back();
        } else {
            return view('admin.login');
        }
    }

    public function logout()
    {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error', 'Logout successfull.');

        return redirect('admin/login');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function allMember()
    {
        $members = Member::all();
        return view('admin.member-manage.all', compact('members'));
    }

    public function activeMember()
    {
        $members = Member::all()->where('is_active', 1);
        return view('admin.member-manage.active', compact('members'));
    }

    public function inactiveMember()
    {
        $members = Member::all()->where('is_active', 0)->where('is_expired', 0)->where('is_blocked', 0);
        return view('admin.member-manage.inactive', compact('members'));
    }

    public function blockedMember()
    {
        $members = Member::all()->where('is_blocked', 1);
        return view('admin.member-manage.blocked', compact('members'));
    }

    public function expiredMember()
    {
        $members = Member::all()->where('is_expired', 1);
        return view('admin.member-manage.expired', compact('members'));
    }

    public function isActive($id)
    {
        $is_active = Member::findOrFail($id);
        $is_active->is_active = 1;
        $is_active->save();
        return redirect()->back();
    }

    public function isInActive($id)
    {
        $is_inactive = Member::findOrFail($id);
        $is_inactive->is_active = 0;
        $is_inactive->save();
        return redirect()->back();
    }

    public function isBlocked($id)
    {
        $is_blocked = Member::findOrFail($id);
        if ($is_blocked->is_blocked == 0) {
            $is_blocked->is_blocked = 1;
            $is_blocked->save();
            return redirect()->route('member.all')->with('success', 'Blocked User Succesfully');
        } else {
            $is_blocked->is_blocked = 0;
            $is_blocked->save();
            return redirect()->route('member.all')->with('success', 'Unblocked User Succesfully');
        }
    }

    public function showMember($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.member-manage.show', compact('member'));
    }

    public function editMember($id)
    {
        $mobiles = MobileBanking::get();
        $types = MembershipType::get();
        $countries = Country::all();
        $member = Member::findOrFail($id);
        return view('admin.member-manage.edit', compact('member', 'countries', 'mobiles', 'types'));
    }

    public function updateMember(Request $request, $id)
    {
        // dd($request->all());
        $request->validate(
            [
                "first_name" => 'required',
                "last_name" => 'required',
                "email" => 'required|email',
                "password" => ['required', Password::min(8)->letters(), 'confirmed'],
                "mobile_no" => 'required',
                "pin" => 'required|numeric|digits:5',
                "mobile_banking_service" => 'required',
                "country" => 'required',
                "city" => 'required',
            ],
            [
                'email.required' => 'Please Input a Valid Email Address...!',
            ]

        );

        $member = Member::findOrFail($id);

        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->email = $request->email;
        $member->password = $request->password;
        $member->mobile_no = $request->mobile_no;
        $member->pin = $request->pin;
        $member->city = $request->city;
        $member->country = $request->country;
        $member->mobile_banking_service = $request->moblie_banking_service;

        $member->update();
        return redirect()->route('member.all')->with('success', 'Updated User Details Successfully');
    }

    public function deleteMember($id)
    {
        Member::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Member Deleted Successfully..');
    }

    public function dashboardNotice()
    {
        $notice = notice::first();
        return view('admin.notice.dashboard', compact('notice'));
    }

    public function withdrawNotice()
    {
        $notice = notice::first();
        return view('admin.notice.withdraw', compact('notice'));
    }
    public function dashboardNoticePublish(Request $request)
    {
        $notice = new notice();
        if (empty(notice::first())) {
            $notice->dashboard_notice = $request->dashboard_notice;
            $notice->save();
            return redirect()->back()->with('success', 'Dashboard Notice Published Successfully!');
        } elseif (!empty(notice::first())) {
            $notice = notice::first();
            $notice->dashboard_notice = $request->dashboard_notice;
            $notice->update();
            return redirect()->back()->with('success', 'Dashboard  Changed Successfully!');
        }
    }
    public function withdrawNoticePublish(Request $request)
    {
        $notice = new notice();
        if (empty(notice::first())) {
            $notice->withdraw_notice = $request->withdraw_notice;
            $notice->save();
            return redirect()->back()->with('success', 'Withdraw Notice Added Successfully!');
        } elseif (!empty(notice::first())) {
            $notice = notice::first();
            $notice->withdraw_notice = $request->withdraw_notice;
            $notice->update();
            return redirect()->back()->with('success', 'Withdraw Notice Published Successfully!');
        }
    }

    public function adminProfile()
    {
        $id = session('ADMIN_ID');
        $admin = Admin::first();
        return view('admin.settings.profile', compact('admin'));
    }

    public function adminProfileUpdate(Request $request)
    {
        $admin = Admin::first();

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->password = $request->password;

        $admin->update();
        return redirect()->back()->withInput()->with('success', 'Updated Admin Details Successfully');
    }

    public function addMember()
    {
        $mobiles = MobileBanking::get();
        $types = MembershipType::get();
        $countries = Country::all();
        return view('admin.member-manage.add', compact('countries', 'mobiles', 'types'));
    }

    public function addFundToUserView()
    {
        return view('admin.funds.fundadd');
    }

    public function addFundToUSer(Request $request)
    {
        $request->validate(
            [
                "user_name" => 'required',
                "amount" => 'required',
            ]

        );
        $userName = Member::where('user_name', $request->user_name)->pluck('user_name');
        if (!empty($userName[0])) {
            $balance =  Member::where('user_name', $request->user_name)->get();
            $balance[0]->account_balance = $balance[0]->account_balance + $request->amount;
            // dd($balance[0]->account_balance);
            $balance[0]->save();
            return redirect()->back()->with('success', 'Fund Added Succesfully..!');
        } else {
            return redirect()->back()->with('failed', 'Invalid Username..Please Enter a valid Username');
        }
    }

    public function teamTree($id)
    {
        // dd(session('MEMBER_USER_NAME'));
        $parent = DB::table('members')
            ->select('user_name', 'has_children')
            ->where([
                'id' => $id
            ])
            ->first();
        // dd($parent->user_name);
        $children = DB::table('members')
            ->select('id', 'user_name', 'has_children', 'team')
            ->where([
                'placement_id' => $parent->user_name
            ])
            ->get();
        // dd($child);
        return view('admin.member-manage.tree', compact('parent', 'children'));
    }
}

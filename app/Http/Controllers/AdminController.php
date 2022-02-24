<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\Email;

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
        if (session()->has('ADMIN_LOGIN')) {
            return redirect('admin');
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
        $member = Member::findOrFail($id);
        return view('admin.member-manage.edit', compact('member'));
    }

    public function updateMember(Request $request, $id)
    {
        $request->validate(
            [
                "first_name" => 'required',
                "last_name" => 'required',
                "user_name" => 'required',
                "email" => 'required|email',
                "password" => 'required',
                "mobile_no" => 'required',
            ],
            [
                'email.required' => 'Please Input a Valid Email Address...!',
            ]

        );

        $member = Member::findOrFail($id);

        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->user_name = $request->user_name;
        $member->email = $request->email;
        $member->password = $request->password;
        $member->mobile_no = $request->mobile_no;
        $member->pin = $request->pin;
        $member->city = $request->city;
        $member->country = $request->country;
        $member->membership_type = $request->membership_type;
        $member->moblie_banking_service = $request->moblie_banking_service;

        $member->update();
        return redirect()->route('member.all')->with('success', 'Updated User Details Successfully');
    }
}

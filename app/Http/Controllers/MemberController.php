<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => 'required',
            "last_name" => 'required',
            "user_name" => 'required|unique:members,user_name',
            "email" => 'required|email',
            "password" => 'required',
            "mobile_no" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = [
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "user_name" => $request->user_name,
                "email" => $request->email,
                "password" => $request->password,
                "mobile_no" => $request->mobile_no,
                "pin" => $request->pin,
                "city" => $request->city,
                "country" => $request->country,
                "membership_type" => $request->membership_type,
                "moblie_banking_service" => $request->mobile_banking_service,
            ];
            $query = DB::table('members')->insert($data);
            if ($query) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Registration Successfull'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Registration Failed'
                ]);
            }
        }
    }

    public function login()
    {
        if (session()->has('MEMBER_LOGIN')) {
            return redirect('dashboard');
        } else {
            return view('member.login');
        }
    }

    public function auth(Request $request)
    {
        $pass = $request->post('password');

        // $admin = Admin::where(['email' => $email, 'password' => $pass])->get();
        $member = DB::table('members')
            ->where([
                'user_name' => $request->user_name
            ])
            ->get();

        if (!isset($member[0])) {
            $status = "error";
            $message = "Please enter valid username.";
        } else {
            if ($member[0]->password == $pass) {
                $request->session()->put('MEMBER_LOGIN', true);
                $request->session()->put('MEMBER_ID', $member[0]->id);
                $request->session()->put('MEMBER_FIRST_NAME', $member[0]->first_name);
                $status = "success";
                $message = "Login Successfull.";
            } else {
                $status = "error";
                $message = "Please enter valid password.";
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}

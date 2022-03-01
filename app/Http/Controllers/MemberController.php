<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
            "referral_id" => 'exists:members,user_name|nullable',
            "placement_id" => 'exists:members,user_name|nullable'
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
            return redirect('member');
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
                $request->session()->put('MEMBER_USER_NAME', $member[0]->user_name);
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

    public function logout()
    {
        session()->forget('MEMBER_LOGIN');
        session()->forget('MEMBER_ID');
        session()->forget('MEMBER_FIRST_NAME');
        session()->flash('error', 'Logout successfull.');

        return redirect('login');
    }

    //////   edit profile    ///////

    public function editProfile()
    {
        $id = session('MEMBER_ID');
        $member = Member::findOrFail($id);
        return view('member.profile.edit', compact('member'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'mobile_no' => 'required',
                'city' => 'required',
                'country' => 'required',
            ]
        );

        $id = session('MEMBER_ID');
        $member = Member::findOrFail($id);

        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->email = $request->email;
        $member->mobile_no = $request->mobile_no;
        $member->city = $request->city;
        $member->country = $request->country;

        $member->update();

        return redirect()->back()->with('success', 'Profile Updated Successfully..!');
    }

    ///////    password change    //////
    public function changePassword()
    {
        return view('member.profile.change-password');
    }

    public function changePasswordRequest(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]
        );
        $id = session('MEMBER_ID');
        $oldpass = Member::findOrFail($id)->password;
        if ($request->current_password == $oldpass) {
            $member = Member::findOrFail($id);
            $member->password = $request->password;
            $member->update();
            session()->forget('MEMBER_LOGIN');
            session()->forget('MEMBER_ID');
            session()->forget('MEMBER_FIRST_NAME');
            return redirect()->route('login')->with('success', 'Password Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Password Changed Failed..!');
        }
    }

    ////      pin change   ////

    public function changePin()
    {
        return view('member.profile.change-pin');
    }

    public function changePinRequest(Request $request)
    {
        $request->validate(
            [
                'pin' => 'required',
                'confirm_pin' => 'required|same:pin',
                'password' => 'required',
            ]
        );
        $id = session('MEMBER_ID');
        $oldpass = Member::findOrFail($id)->password;
        if ($request->password == $oldpass) {
            $member = Member::findOrFail($id);
            $member->pin = $request->pin;
            $member->update();
            return redirect()->back()->with('success', 'Pin Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Password Did not match..!');
        }

        // dd($request->all());
    }

    public function changeProfilePhoto()
    {
        $id = session('MEMBER_ID');
        $profilePhoto = Member::findOrFail($id)->profile_photo;
        return view('member.profile.change-profile-photo', compact('profilePhoto'));
    }

    public function changeProfilePhotoRequest(Request $request)
    {
        $request->validate(
            [
                'profile_photo' => 'required',
            ]
        );
        $id = session('MEMBER_ID');
        $member = Member::findOrFail($id);
        $profilePhoto = Member::findOrFail($id)->profile_photo;

        if (!empty($profilePhoto)) {
            $file = $request->file('profile_photo');
            @unlink(public_path('images/user_profile/' . $member->profile_photo));

            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images/user_profile'), $filename);
            $member->profile_photo = $filename;
            $member->save();
            return redirect()->back()->with('success', 'Profile Picture Changed Successfully');
        } elseif (empty($profilePhoto)) {
            $file = $request->file('profile_photo');
            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images/user_profile'), $filename);
            $member->profile_photo = $filename;
            $member->save();
            return redirect()->back()->with('success', 'Profile Picture Uploaded Successfully');
        } else {
            return redirect()->back()->with('success', 'Uploading Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
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
        ->select('id','user_name', 'has_children')
        ->where([
            'placement_id' => $parent->user_name
        ])
        ->get();;
        // dd($child);
        return view('member.team.tree', compact('parent', 'children'));
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

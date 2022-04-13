<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use App\Jobs\ProcessUserLevelCount;
use App\Models\Rank;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Country;
use App\Models\Generation;
use App\Models\ExpiryMonth;
// use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\MobileBanking;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Auth;
use App\Models\MembershipType;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessGenerationIncome;
use App\Notifications\AdminNotification;
use Illuminate\Validation\Rules\Password;

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
        $mobiles = MobileBanking::get();
        $types = MembershipType::get();
        $countries = Country::all();
        return view('member.register', compact('countries', 'mobiles', 'types'));
    }

    public function cities($name)
    {
        $country = Country::where('name', $name)->first();
        $cities = Country::find($country->id)->cities()->orderBy('name')->get();
        // dd($cities);
        return json_encode($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        ////validation/////
        $request->validate([
            "referral_id" => 'required|exists:members,user_name',
            "first_name" => 'required',
            "last_name" => 'required',
            "user_name" => 'required|alpha_dash|min:5|max:10|unique:members,user_name',
            "email" => 'required|email',
            "password" => ['required', Password::min(8)->letters(), 'confirmed'],
            "mobile_no" => 'required',
            "pin" => 'required|numeric|digits:5',
            "mobile_banking_service" => 'required',
            "country" => 'required',
            "city" => 'required',
            "membership_type" => 'required',
            "placement_id" => 'required|exists:members,user_name'
        ]);

        ////maximum hands/////
        $expiryMonths = ExpiryMonth::first();

        ////maximum hands/////
        $maxChildren = DB::table('max_children')
            ->select('max')
            ->first();

        ////registration amount/////
        $balance = DB::table("registration_funds")
            ->select('amount')
            ->first();

        ////referral income amount/////
        $referral_income = DB::table("referral_income_amount")
            ->select('amount')
            ->first();

        ////referrar/////
        $refarral = DB::table('members')
            ->where('user_name', $request->referral_id)
            ->first();

        ////placement/////
        $placement = DB::table('members')
            ->where('user_name', $request->placement_id)
            ->first();

        ////check referrar's balance/////
        if ($refarral->account_balance < $balance->amount) {
            return back()->with('placement_id', "The referrar doesn't have enough balance.")->withInput();
        }

        ////check if placement hands are empty or not/////
        if ($placement->has_children == $placement->max_children) {
            return back()->with('placement_id', "The user's hands are already full.")->withInput();
        }

        ////if all oky, then this are the form data/////
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
            "mobile_banking_service" => $request->mobile_banking_service,
            "created_at" => Carbon::now(),
            "will_expire_on" => Carbon::now()->addMonth($expiryMonths->months),
            "max_children" => $maxChildren->max,
            'referral_id' => $request->referral_id,
            'placement_id' => $request->placement_id,
            'current_level' => $placement->current_level + 1,
            'account_balance' => 0,
            'rank' => 'None'
        ];

        ////create the user/////
        $member = Member::create($data);

        if ($member) {
            ////subtract registration amount and add referral income to referrar/////
            DB::table('members')
                ->where('user_name', $request->referral_id)
                ->update([
                    'account_balance' => $refarral->account_balance + $referral_income->amount - $balance->amount
                ]);

            ////add referral income history to the icome table/////
            DB::table('incomes')
                ->insert([
                    'user_name' => $request->referral_id,
                    'income_type' => 'Referral',
                    'amount' => $referral_income->amount,
                    'created_at' => Carbon::now(),
                ]);

            ////update placement's hands/////
            $placementsNewHands = $placement->has_children + 1;

            ////get udated placement's data for updating rank/////
            $placement = DB::table('members')
                ->where('user_name', $request->placement_id)
                ->first();

            ////get all ranks/////
            $ranks = Rank::get();

            ////update placement's rank/////
            foreach ($ranks as $rank) {
                if ($placementsNewHands >=  $rank->min_user && $placementsNewHands <= $rank->max_user) {
                    DB::table('members')
                        ->where('user_name', $request->placement_id)
                        ->update([
                            'rank' => $rank->name,
                            'has_children' => $placementsNewHands
                        ]);
                }
            }

            ////send notification////
            $admin = Admin::find(1);
            $admin->notify(new AdminNotification($member));
            // ProcessUserLevelCount::dispatch($member);
            // ProcessGenerationIncome::dispatch($member);

            ////process generation income////
            self::generationIncome($member);

            return back()->with('success', 'Successfully Registered.');
        } else {
            return back()->with('failed', 'Registration Failed. Please Try Again.');
        }
    }

    public function login()
    {
        if (session()->has('ADMIN_LOGIN') || session()->has('MEMBER_LOGIN')) {
            return back();
        } else {
            return view('member.login');
        }
    }

    public function auth(Request $request)
    {
        $request->validate([
            "user_name" => 'required',
            "password" => 'required',
        ]);
        $pass = $request->post('password');

        // $admin = Admin::where(['email' => $email, 'password' => $pass])->get();
        $member = DB::table('members')
            ->where([
                'user_name' => $request->user_name
            ])
            ->get();

        if (!isset($member[0])) {
            return redirect()->back()->with('failed', 'Incorrect Username!');
        } else {
            if ($member[0]->password == $pass) {
                $request->session()->put('MEMBER_LOGIN', true);
                $request->session()->put('MEMBER_ID', $member[0]->id);
                $request->session()->put('MEMBER_USER_NAME', $member[0]->user_name);
                $request->session()->put('MEMBER_FIRST_NAME', $member[0]->first_name);

                return redirect('member');
            } else {
                return redirect()->back()->with('failed', 'Incorrect Password!');
            }
        }
    }

    public function logout()
    {
        session()->forget('MEMBER_LOGIN');
        session()->forget('MEMBER_ID');
        session()->forget('MEMBER_FIRST_NAME');
        session()->flash('success', 'Logout successfull.');

        return redirect('login');
    }

    //////   edit profile    ///////

    public function editProfile()
    {
        $id = session('MEMBER_ID');
        $member = Member::findOrFail($id);
        $countries = Country::all();
        return view('member.profile.edit', compact('member', 'countries'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
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
            ->select('id', 'user_name', 'has_children', 'team')
            ->where([
                'placement_id' => $parent->user_name
            ])
            ->get();
        // dd($child);
        return view('member.team.tree', compact('parent', 'children'));
    }
    public function teamTeams()
    {
        // dd(session('MEMBER_USER_NAME'));

        $defaultTeams = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];
        $parent = DB::table('members')
            ->select('user_name', 'has_children', 'max_children')
            ->where([
                'id' => session('MEMBER_ID')
            ])
            ->first();
        // dd($parent->user_name);
        $children = DB::table('members')
            ->select('id', 'first_name', 'user_name', 'has_children', 'team')
            ->where([
                'placement_id' => $parent->user_name
            ])
            ->get();
        $hasTeam = 0;
        $hasTeamLabel = [];
        foreach ($children as $child) {
            if (isset($child->team)) {
                $hasTeam++;
                $hasTeamLabel += [$child->team];
            }
        }

        $defaultTeams = array_diff($defaultTeams, $hasTeamLabel);
        // dd($defaultTeams);
        return view('member.team.teams', compact('children', 'defaultTeams', 'parent', 'hasTeam'));
    }

    public function storedByAdmin(Request $request)
    {
        // dd($request->all());

        $request->validate([
            "first_name" => 'required',
            "last_name" => 'required',
            "user_name" => 'required|alpha_dash|min:5|max:10|unique:members,user_name',
            "email" => 'required|email',
            "password" => ['required', Password::min(8)->letters(), 'confirmed'],
            "mobile_no" => 'required',
            "pin" => 'required|numeric|digits:5',
            "mobile_banking_service" => 'required',
            "country" => 'required',
            "city" => 'required',
            "membership_type" => 'required',
        ]);

        $maxChildren = DB::table('max_children')
            ->select('max')
            ->first();
        // $balance = DB::table("registration_funds")
        //     ->select('amount')
        //     ->first();
        // $referral_income = DB::table("referral_income_amount")
        //     ->select('amount')
        //     ->first();

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
            "mobile_banking_service" => $request->mobile_banking_service,
            "created_at" => Carbon::now(),
            "will_expire_on" => Carbon::now()->addMonth(6),
            "max_children" => $maxChildren->max,
            'rank' => 'None'
        ];
        // dd($data);
        $member = Member::create($data);

        if ($member) {
            return redirect()->back()->with('success', 'Successfully Registered.');
        } else {
            return redirect()->back()->with('failed', 'Registration Failed. Please Try Again.');
        }
    }

    public function generationIncome($member)
    {
        $j = 0;
        $currentMember = $member; //example: current_level=5
        $generation_income = Generation::orderBy('level', 'asc')->get();
        for ($i = $currentMember->current_level; $i >= 0; $i--) {
            if ($currentMember->current_level == 0) {
                break;
            }
            if (!isset($generation_income[$j]->income)) {
                break;
            }
            $parentMember = Member::where('user_name', $currentMember->placement_id)->first();
            $parentMember->account_balance = $parentMember->account_balance + $generation_income[$j]->income;
            $parentMember->save();
            DB::table('incomes')
                ->insert([
                    'user_name' => $parentMember->user_name,
                    'income_type' => 'Generation',
                    'amount' => $generation_income[$j]->income,
                    'created_at' => Carbon::now(),
                ]);

            $currentMember = $parentMember;
            $j++;
        }
    }
}

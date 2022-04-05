<?php

namespace App\Http\Controllers;

use App\Models\homestart;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view('member.forgot-password');
    }
    public function store(Request $request){

        $request->validate([
            'user_name' => 'required|exists:members,user_name'
        ]);
        
        $member = Member::where('user_name', $request->user_name)->first();
        $randId = rand(11111111, 99999999);
        if(isset($member)){
            $member->forgot_password = 1;
            $member->forgot_password_token = $randId;
            $member->update();
        }
        $data = [
            'first_name' => $member->first_name, 
            'user_name'=>$member->user_name, 
            'token' => $randId
        ];
        $site = homestart::first();
        Mail::send('member/email/password', $data, function($message) use($member, $site){
            $message->to($member->email);
            $message->subject('Forgot password - ' . (!isset($site->title) ? 'MLM' : $site->title));
        });
        // dd($member->forgot_password_token);
        return back()->with('success', 'Please check your email!');
    }
    public function create($id){
        $member = Member::where('forgot_password_token', $id)->first();
        if($member->forgot_password == 1){
            return view('member.reset-password', compact("member"));
        }else{
            return redirect()->route('login');
        }
    }
    public function update(Request $request){
        $request->validate([
            "user_name" => 'required|exists:members,user_name',
            "password" => ['required', Password::min(8)->letters(), 'confirmed']
        ]);

        Member::where([
            'user_name' => $request->user_name,
            'forgot_password' => 1
            ])->update([
            'password' => $request->password,
            'forgot_password' => 0,
            'forgot_password_token' => '0'
        ]);

        return redirect()->route('login')->with('success', 'Successfully Changed Password! Please Login.');
    }
}

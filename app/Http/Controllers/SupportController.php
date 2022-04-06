<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('MEMBER_ID');
        $user = Member::where('id', $id)->first();
        $userName = $user->user_name;
        return view('member.support.index', compact('userName'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                "user_name" => 'required',
                "type" => 'required',
                "message" => 'required',
            ]
        );

        $support = new Support();
        $support->user_name = $request->user_name;
        $support->type = $request->type;
        $support->message = $request->message;
        $support->save();
        return redirect()->back()->with('success', 'Support Message Has Sent Successfully!');
    }

    public function history()
    {
        $user = session('MEMBER_USER_NAME');
        $history = Support::where('user_name', $user)->latest()->paginate(8);
        return view('member.support.history', compact('history'));
    }

    public function allSupportMessage()
    {
        $messages = Support::latest()->paginate(8);
        return view('admin.support.all', compact('messages'));
    }

    public function showMessage($id)
    {
        $row = Support::where('id', $id)->first();
        // $message = $row->message;
        return view('admin.support.reply', compact('row'));
    }

    public function replyMessage(Request $request, $id)
    {
        $request->validate(
            [
                "reply" => 'required',
            ]
        );

        $support = Support::findOrFail($id);
        $support->reply = $request->reply;
        $support->read = 1;
        $support->update();
        return redirect()->back()->with('success', 'Reply Has Sent Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        //
    }
}

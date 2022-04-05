<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function setTeam(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'team' => 'required|alpha|size:1|unique:members,team'
        ]);
        $member = Member::findOrFail($id);
        $member->team = $request->team;
        $member->update();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MembershipType;
use Illuminate\Http\Request;

class MembershipTypeController extends Controller
{
    public function index(){
        $types = MembershipType::get();

        return view('admin.membership-types.index', compact('types'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $type = new MembershipType();
        $type->name = $request->name;
        $type->save();

        return back();
    }

    public function delete(MembershipType $type){

        // dd($type);
        $type->delete();

        return back();
    }
}

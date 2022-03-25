<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DateRangeSearchController extends Controller
{

    public function dateSearch()
    {
        return view('admin.member-manage.search-daterange');
    }

    function index(Request $request)
    {
        // dd($request);
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DB::table('members')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::table('members')
                    ->get();
            }
            return datatables()->of($data)->addIndexColumn()->make(true);
        }
        return view('admin.member-manage.search-daterange');
    }
}

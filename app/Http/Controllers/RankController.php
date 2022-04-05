<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function index()
    {
        $total = DB::table("total_ranks")
            ->first();

        // dd($levels);
        return view('admin.ranks.total-ranks', compact('total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $maxChildren = DB::table('max_children')
            ->select('max')
            ->first();
        
        $request->validate([
            "total" => ['required', 'numeric', 'lt:' . $maxChildren->max ]
        ]);

        DB::table("total_ranks")
            ->insert([
                "total" => $request->total,
                "created_at" => Carbon::now()
            ]);
        return redirect()->back();
        // dd($request->all());
    }

    public function deleteTotal()
    {
        $total = DB::table("total_ranks")
            ->first();

        DB::table("total_ranks")
            ->delete($total->id);
        DB::table("total_ranks")
            ->delete();

        return redirect()->back();
    }

    public function indexRank()
    {
        $total = DB::table("total_ranks")
            ->first();

        $data = Rank::orderBy('id', 'asc')
            ->get();
        // dd($data[1-1]->income);
        // dd($data);
        return view('admin.ranks.fix-ranks', compact('total', 'data'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maxChildren = DB::table('max_children')
            ->select('max')
            ->first();

        $request->validate([
            'name' => 'required|unique:ranks,name',
            'min_user' => 'required|numeric|lt:' . $maxChildren->max,
            'max_user' => 'required|numeric|lt:' . $maxChildren->max
        ]);

        Rank::create(
            $request->all()
        );
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rank  $Rank
     * @return \Illuminate\Http\Response
     */
    public function show(Rank $Rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rank  $Rank
     * @return \Illuminate\Http\Response
     */
    public function edit(Rank $Rank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rank  $Rank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $maxChildren = DB::table('max_children')
            ->select('max')
            ->first();

        $request->validate([
            'name' => 'required',
            'min_user' => 'required|numeric|lt:' . $maxChildren->max,
            'max_user' => 'required|numeric|lt:' . $maxChildren->max
        ]);

        Rank::where('id', $id)
            ->update([
                'name' => $request->name,
                'min_user' => $request->min_user,
                'max_user' => $request->max_user
            ]);
        return redirect()->back();
        // dd($request->all());
    }

    public function withdraw($id){
        DB::transaction(function() use ($id){
            Rank::where('id', $id)
            ->update([
                'withdraw_rank' => 1
            ]);
            Rank::where('id', '!=',$id)
            ->update([
                'withdraw_rank' => 0
            ]);
        });
        return back();
    }
}

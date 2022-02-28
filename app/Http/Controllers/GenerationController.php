<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = DB::table("generation_levels")
            ->first();

        // dd($levels);
        return view('admin.generation.levels', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            "levels" => 'required|numeric'
        ]);

        DB::table("generation_levels")
            ->insert([
                "levels" => $request->levels,
                "created_at" => Carbon::now()
            ]);
        return redirect()->back();
        // dd($request->all());
    }

    public function deleteLevels()
    {
        $levels = DB::table("generation_levels")
            ->first();

        DB::table("generation_levels")
            ->delete($levels->id);
        DB::table("generations")
            ->delete();

        return redirect()->back();
    }

    public function indexIncome()
    {
        $levels = DB::table("generation_levels")
            ->first();

        $data = Generation::orderBy('level', 'asc')
            ->get();
        // dd($data[1-1]->income);
        // dd($data);
        return view('admin.generation.income', compact('levels', 'data'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|numeric|unique:generations,level',
            'income' => 'required|numeric'
        ]);

        Generation::create(
            $request->all()
        );
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function show(Generation $generation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function edit(Generation $generation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'income' => 'required|numeric'
        ]);

        Generation::where('level', $request->level)
            ->update([
                'income' => $request->income
            ]);
        return redirect()->back();
        // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Generation $generation)
    {
        //
    }
}

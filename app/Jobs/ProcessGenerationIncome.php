<?php

namespace App\Jobs;

use App\Models\Generation;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessGenerationIncome implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $member;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $j = 0;
        $currentMember = $this->member; //example: current_level=5
        $generation_income = Generation::orderBy('level', 'asc')->get();
        for ($i = $currentMember->current_level; $i >= 0; $i--) {
            if ($currentMember->current_level == 0) {
                break;
            }
            if(!isset($generation_income[$j]->income)){
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

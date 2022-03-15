<?php

namespace App\Jobs;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUserLevelCount implements ShouldQueue
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
        $currentMember = $this->member; //example: current_level=5
        $userBeneath = 0;
        $levelBeneath = 0;
        for ($i = $currentMember->current_level; $i >= 0; $i--) {
            if ($currentMember->current_level == 0) {
                break;
            }
            $parentMember = Member::where('user_name', $currentMember->placement_id)->first();
            $children = Member::where('placement_id', $currentMember->placement_id)->get();
            
            foreach ($children as $child) {
                $userBeneath += $child->has_children;
                $levelBeneath += $child->total_levels_underneath;
            }
            $levelBeneath += 1;
            $parentMember->total_levels_underneath = $levelBeneath;
            $parentMember->total_user_underneath = $parentMember->has_children + $userBeneath;
            $parentMember->save();

            $currentMember = $parentMember;
        }
    }
}

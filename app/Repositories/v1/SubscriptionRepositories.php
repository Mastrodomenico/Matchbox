<?php
namespace App\Repositories\v1;

use Illuminate\Support\Facades\DB;

class SubscriptionRepositories
{
    public static function subscription(int $candidate_id, int $job_id): bool
    {
        $row = DB::table('candidates_jobs')
            ->where('candidates_id', $candidate_id)
            ->where('jobs_id' ,$job_id)
            ->count();

        if($row <= 0){
            DB::table('candidates_jobs')->insert(
                ['candidates_id' => $candidate_id, 'jobs_id' => $job_id]
            );
            return true;
        }else{
            return false;
        }
    }
}
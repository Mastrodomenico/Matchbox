<?php
namespace App\Repositories\v1;


use App\Models\v1\Candidate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CandidatesRepositories
{
    public static function GetAll(): Collection
    {
        return Candidate::all();
    }

    public static function GetById(int $id): Builder
    {
        return Candidate::where('id',$id);
    }

    public static function Create(array $job): Candidate
    {
        return Candidate::create($job);
    }

    public static function Upadate(array $job, int $job_id): ?Builder
    {
        return Candidate::where('id', $job_id)->update($job)
            ? self::GetById($job_id)
            : null
        ;
    }

    public static function Delete(int $job_id)
    {
        return Candidate::destroy($job_id);
    }
}
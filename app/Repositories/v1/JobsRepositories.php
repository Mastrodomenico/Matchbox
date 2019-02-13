<?php
namespace App\Repositories\v1;


use App\Models\v1\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class JobsRepositories
{

    public static function GetAll(): Collection
    {
        return Job::all();
    }

    public static function GetById(int $id): Builder
    {
        return Job::where('id',$id);
    }

    public static function Create(array $job): Job
    {
        return Job::create($job);
    }

    public static function Upadate(array $job, int $job_id): ?Builder
    {
        return Job::where('id', $job_id)->update($job)
            ? self::GetById($job_id)
            : null
        ;
    }

    public static function Delete(int $job_id)
    {
        return Job::destroy($job_id);
    }

}
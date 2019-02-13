<?php
namespace App\Repositories\v1;


use App\Models\v1\Candidate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Builder as BuilderJWT;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;


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

    public static function Delete(int $job_id): bool
    {
        return Candidate::destroy($job_id);
    }

    public static function Login(string $email, string $password): ?Token
    {

        $candidate = Candidate::where('email', $email)->first();

        if(Hash::check($password, $candidate->password)){
            $token = new BuilderJWT();
            return $token
                ->set('type','candidates')
                ->set('id',$candidate->id)
                ->setExpiration(time() + 386400)
                ->sign(new Sha256(), env('APP_KEY'))
                ->getToken();
        }else{
            return null;
        }
    }
}
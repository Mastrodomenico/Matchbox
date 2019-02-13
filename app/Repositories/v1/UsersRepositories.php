<?php
namespace App\Repositories\v1;


use App\Models\v1\Candidate;
use App\Models\v1\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Builder as BuilderJWT;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;


class UsersRepositories
{

    public static function Login(string $email, string $password): ?Token
    {
        $user = User::where('email', $email)->first();
        if($user) {
            if (Hash::check($password, $user->password)) {
                $token = new BuilderJWT();
                return $token
                    ->set('type', 'admin')
                    ->set('id', $user->id)
                    ->setExpiration(time() + 386400)
                    ->sign(new Sha256(), env('APP_KEY'))
                    ->getToken();
            } else {
                return null;
            }
        }else{
            return null;
        }
    }
}
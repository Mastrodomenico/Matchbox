<?php

namespace App\Http\Middleware;

use Closure;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $signer = new Sha256();
        $Authorization = sscanf($request->header('Authorization'), 'Bearer %s')[0];

        if(!isset($Authorization)){
            return response()->json("Unauthorized",401);
        }

        try {
            $token = (new Parser())->parse($Authorization);

            if($token->getClaim('type') != 'admin'){
                return response()->json("Invalid Token",401);
            }

        } catch (\InvalidArgumentException $e) {
            return response()->json("Invalid Token",401);
        }

        if(!$token->verify($signer, env('APP_KEY'))){
            return response()->json("Invalid Signature",401);
        }


        $data = new ValidationData();

        if(!$token->validate($data)){
            return response()->json("Invalid Token",401);
        }

        return $next($request);
    }
}

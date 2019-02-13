<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\UserLoginRequest;
use App\Http\Controllers\Controller;
use App\Repositories\v1\UsersRepositories;

class UsersController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $Token = UsersRepositories::Login($request->get('email'),$request->get('password'));
        return $Token !== null
            ? response()->json((string) $Token)
            : response()->json("unauthorized",401)
            ;
    }
}

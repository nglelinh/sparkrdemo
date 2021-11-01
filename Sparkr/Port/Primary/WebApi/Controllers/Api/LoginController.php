<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;


class LoginController extends BaseController
{
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if( !Auth::attempt($login)){
            return response(['message'=>'invalid token']);
        }
        $accessToken = Auth::user()->createToken('abcToken')->accessToken;
        dd($accessToken);
        return response(['user'=>Auth::user(),'access_token'=>$accessToken]);
    }
}

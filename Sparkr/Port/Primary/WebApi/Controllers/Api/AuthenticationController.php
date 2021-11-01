<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Sparkr\Application\User\Services\UserService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;

/**
 * Class AuthenticationController
 * @package Bachelor\Port\Primary\WebApi\Controllers\Api
 *
 * @group User Authentication
 */
class AuthenticationController extends BaseController
{
    public function signup(Request $request, UserService $userService)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                                        'status' => 'fails',
                                        'message' => $validator->errors()->first(),
                                        'errors' => $validator->errors()->toArray(),
                                    ]);
        }

        return $userService->createNewUser($request->all());
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                                        'status' => 'fails',
                                        'message' => $validator->errors()->first(),
                                        'errors' => $validator->errors()->toArray(),
                                    ]);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                                        'status' => 'fails',
                                        'message' => 'Unauthorized'
                                    ], 401);
        }

        $response = Http::asForm()->post(url('/oauth/token'), [
            'grant_type' => 'password',
            'client_id' => env("CLIENT_ID"),
            'client_secret' => env("CLIENT_SECRET"),
            'username' => request('email'),
            'password' => request('password'),
            'scope' => '*',
        ]);

//        if ($request->remember_me) {
//            $token->expires_at = Carbon::now()->addWeeks(1);
//        }
        $tokenData = $response->object();
        if ($tokenData->error) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => $tokenData->message,
                                        'error' => $tokenData->error,
                                        'error_description' => $tokenData->error_description,
                                    ]);
        }

        return response()->json([
                                    'status' => 'success',
                                    'access_token' => $tokenData->access_token,
                                    'token_type' => $tokenData->token_type,
                                    'expires_at' => Carbon::parse(
                                        $tokenData->expires_in
                                    )->toDateTimeString(),
                                    'refresh_token' => $tokenData->refresh_token,
                                ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
                                    'status' => 'success',
                                ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

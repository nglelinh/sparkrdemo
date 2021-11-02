<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\User\Services\AccountService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;

class AccountController extends BaseController
{
    /**
     * @param Request $request
     * @param AccountService $loginService
     * @return JsonResponse
     */
    public function signup(Request $request, AccountService $loginService): JsonResponse
    {
        return $loginService->signup($request->all());
    }

    /**
     * @param Request $request
     * @param AccountService $loginService
     * @return JsonResponse
     */
    public function login(Request $request, AccountService $loginService): JsonResponse
    {
        return $loginService->login($request->all());
    }

    /**
     * @param Request $request
     * @param AccountService $loginService
     * @return JsonResponse
     */
    public function logout(Request $request, AccountService $loginService): JsonResponse
    {
        return $loginService->logout($request);
    }

    public function user(Request $request)
    {
        return response()->json(['a'=>'a']);
    }
}

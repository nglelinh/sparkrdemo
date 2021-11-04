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
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function signup(Request $request, AccountService $accountService): JsonResponse
    {
        return $accountService->signup($request->all());
    }

    /**
     * @param Request $request
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function login(Request $request, AccountService $accountService): JsonResponse
    {
        return $accountService->login($request->all());
    }

    /**
     * @param Request $request
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function logout(Request $request, AccountService $accountService): JsonResponse
    {
        return $accountService->logout($request);
    }

    public function user(Request $request)
    {
        return response()->json(['a'=>'a']);
    }

    /**
     * @param Request $request
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function refreshToken(Request $request, AccountService $accountService): JsonResponse
    {
        return $accountService->refreshToken($request->all());
    }
}

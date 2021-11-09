<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\User\Services\AccountService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;

class ResetPasswordController extends BaseController
{
    /**
     * Create token password reset.
     *
     * @param Request $request
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function sendMail(Request $request, AccountService $accountService): JsonResponse
    {
        return $accountService->sendMail($request->email);
    }

    /**
     * @param Request $request
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function reset(Request $request, AccountService $accountService): JsonResponse
    {
        return $accountService->reset($request, $request->token);
    }
}

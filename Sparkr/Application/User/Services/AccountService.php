<?php

namespace Sparkr\Application\User\Services;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Sparkr\Domain\Auth\Token\Services\TokenService;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;
use Sparkr\Domain\Auth\Login\Services\LoginService;
use Laravel\Passport\Client as OClient;

class AccountService
{
    /**
     * @var LoginService
     */
    private $loginService;

    /**
     * @var TokenService
     */
    private $tokenService;

    /**
     *
     * @param LoginService $loginService
     * @param TokenService $tokenService
     */
	public function __construct(LoginService $loginService, TokenService $tokenService)
	{
		$this->loginService = $loginService;
		$this->tokenService = $tokenService;
	}

	/**
	 *
	 * @param array $param
	 * @return JsonResponse
	 */
	public function signup(array $param): JsonResponse
	{
        return $this->loginService->signup($param);
	}

	/**
	 * @param array $param
	 * @return JsonResponse
	 */
	public function login(array $param): JsonResponse
	{
        return $this->loginService->login($param);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function logout(Request $request): JsonResponse
	{
		return $this->loginService->logout($request);
	}

    /**
     * @param array $param
     * @return JsonResponse
     */
	public function refreshToken(array $param): JsonResponse
	{
		return $this->tokenService->refreshToken($param);
	}
}

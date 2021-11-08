<?php

namespace Sparkr\Application\User\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Domain\Auth\Login\Services\LoginService;
use Sparkr\Domain\Auth\Token\Services\TokenService;
use Sparkr\Domain\MailsManagement\ConfirmRegistration\Services\ConfirmRegistrationService;

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
	 * @var ConfirmRegistrationService
	 */
	private $confirmRegistrationService;

    /**
     *
     * @param LoginService $loginService
     * @param TokenService $tokenService
     * @param ConfirmRegistrationService $confirmRegistrationService
     */
	public function __construct(
		LoginService $loginService,
		TokenService $tokenService,
		ConfirmRegistrationService $confirmRegistrationService
	) {
		$this->loginService = $loginService;
		$this->confirmRegistrationService = $confirmRegistrationService;
		$this->tokenService = $tokenService;
	}

	/**
	 *
	 * @param array $param
	 * @return JsonResponse
	 */
	public function signup(array $param): JsonResponse
	{
		$signupResult = $this->loginService->signup($param)->getData();
		if ($signupResult->status === 'success') {
			$this->confirmRegistrationService->sendEmailConfirmRegistration($param);
			return response()->json([
										'status' => 'success',
										'message' => 'success',
										'data' => []
									]);
		}
		return response()->json([
									'status' => 'error',
									'message' => $signupResult->message,
									'data' => []
								]);
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

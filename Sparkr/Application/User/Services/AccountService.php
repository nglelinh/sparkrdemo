<?php

namespace Sparkr\Application\User\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Domain\Auth\Login\Services\LoginService;
use Sparkr\Domain\Auth\ResetPassword\Services\PasswordResetService;
use Sparkr\Domain\Auth\Token\Services\TokenService;
use Sparkr\Domain\MailsManagement\ConfirmRegistration\Services\ConfirmRegistrationService;

class AccountService
{
	/**
	 * @var LoginService
	 */
	private LoginService $loginService;

    /**
     * @var PasswordResetService
     */
    private PasswordResetService $passwordResetService;

	/**
	 * @var TokenService
	 */
	private TokenService $tokenService;

	/**
	 * @var ConfirmRegistrationService
	 */
	private ConfirmRegistrationService $confirmRegistrationService;

    /**
     *
     * @param LoginService $loginService
     * @param PasswordResetService $passwordResetService
     * @param TokenService $tokenService
     * @param ConfirmRegistrationService $confirmRegistrationService
     */
	public function __construct(
		LoginService $loginService,
        PasswordResetService $passwordResetService,
		TokenService $tokenService,
		ConfirmRegistrationService $confirmRegistrationService
	) {
		$this->loginService = $loginService;
		$this->passwordResetService = $passwordResetService;
		$this->confirmRegistrationService = $confirmRegistrationService;
		$this->tokenService = $tokenService;
	}

	/**
	 *
	 * @param array $param
	 * @return JsonResponse
	 */
	public function register(array $param): JsonResponse
	{
		$signupResult = $this->loginService->register($param)->getData();
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

    /**
     *
     * @param string $email
     * @return JsonResponse
     */
    public function sendMail(string $email): JsonResponse
    {
        return $this->passwordResetService->sendMail($email);
    }

    /**
     * @param Request $request
     * @param $token
     * @return JsonResponse
     */
    public function submitResetPassword(Request $request, $token): JsonResponse
    {
        return $this->passwordResetService->submitResetPassword($request, $token);
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    public function resetPassword($token): JsonResponse
    {
        return $this->passwordResetService->resetPassword($token);
    }
}

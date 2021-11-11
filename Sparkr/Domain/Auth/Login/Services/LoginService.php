<?php

namespace Sparkr\Domain\Auth\Login\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client as OClient;
use Sparkr\Domain\Auth\Token\Services\TokenService;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;

class LoginService
{
	/**
	 * @var UserRepositoryInterface
	 */
	private $userRepository;

	/**
	 * @var TokenService
	 */
	private $tokenService;

	/**
	 * @param UserRepositoryInterface $userRepository
	 * @param TokenService $tokenService
	 */
	public function __construct(UserRepositoryInterface $userRepository, TokenService $tokenService)
	{
		$this->userRepository = $userRepository;
		$this->tokenService = $tokenService;
	}

	/**
	 *
	 * @param array $param
	 * @return JsonResponse
	 */
	public function register(array $param): JsonResponse
	{
		$validator = Validator::make($param, [
			'name' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return $this->handleApiResponse('error', $validator->errors()->first());
		}
		$newUser = new User($param);
		$this->userRepository->save($newUser);

		return $this->handleApiResponse();
	}

	/**
	 * Format response data
	 *
	 * @param string $status
	 * @param string $message
	 * @param array $data
	 * @param int $code
	 * @return JsonResponse
	 */
	public function handleApiResponse(
		string $status = 'success',
		string $message = 'success',
		array $data = [],
		int $code = 200
	): JsonResponse {
		return response()->json([
									'status' => $status,
									'message' => $message,
									'data' => $data
								], $code);
	}

	/**
	 * @param array $param
	 * @return JsonResponse
	 */
	public function login(array $param): JsonResponse
	{
		$validator = Validator::make($param, [
			'email' => 'required|string|email',
			'password' => 'required|string',
			'remember_me' => 'boolean'
		]);

		if ($validator->fails()) {
			return $this->handleApiResponse('error', $validator->errors()->first());
		}

		$credentials = ['email' => $param['email'], 'password' => $param['password']];

		if (!Auth::attempt($credentials)) {
			return $this->handleApiResponse('error', 'Unauthorized', [], 401);
		}

		try {
			$this->tokenService->revokeToken();
			$oClient = OClient::where('password_client', 1)->first();
			$response = Http::asForm()->post(url('/oauth/token'), [
				'grant_type' => 'password',
				'client_id' => $oClient->id,
				'client_secret' => $oClient->secret,
				'username' => $param['email'],
				'password' => $param['password'],
				'scope' => '*',
			]);
		} catch (Exception $e) {
			return $this->handleApiResponse('error', '', [], 500);
		}

		return $this->tokenService->tokenOutput($response->object());
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function logout(Request $request): JsonResponse
	{
		$this->tokenService->revokeToken();
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return $this->handleApiResponse('success', 'Logout success');
	}
}

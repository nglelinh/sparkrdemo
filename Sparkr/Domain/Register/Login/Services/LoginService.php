<?php

namespace Sparkr\Domain\Register\Login\Services;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;
use Laravel\Passport\Client as OClient;

class LoginService
{
	/**
	 * @var UserRepositoryInterface
	 */
	private $userRepository;

	/**
	 * AdminSchoolService constructor.
	 * @param UserRepositoryInterface $userRepository
	 */
	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 *
	 * @param array $param
	 * @return JsonResponse
	 */
	public function signup(array $param): JsonResponse
	{
		$validator = Validator::make($param, [
			'name' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return $this->handleApiResponse('fails', $validator->errors()->first());
		}
		$newUser = new User($param['email'], bcrypt($param['password']), $param['name']);
		$this->userRepository->save($newUser);

		return $this->handleApiResponse();
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
			return $this->handleApiResponse('fails', $validator->errors()->first());
		}

		$credentials = ['email' => $param['email'], 'password' => $param['password']];

		if (!Auth::attempt($credentials)) {
			return $this->handleApiResponse('fails', 'Unauthorized', [], 401);
		}
        $oClient = OClient::where('password_client', 1)->first();
		$response = Http::asForm()->post(url('/oauth/token'), [
			'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
			'username' => $param['email'],
			'password' => $param['password'],
			'scope' => '*',
		]);

		$responseObj = $response->object();

		if (isset($responseObj->error)) {
			return $this->handleApiResponse('error', $responseObj->message);
		}
		$tokenData = [
			'access_token' => $responseObj->access_token,
			'token_type' => $responseObj->token_type,
			'expires_at' => Carbon::parse(
				Carbon::now()->getTimestamp() + $responseObj->expires_in
			)->toDateTimeString(),
			'refresh_token' => $responseObj->refresh_token,
		];
		return $this->handleApiResponse('success', 'Login success', $tokenData);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function logout(Request $request): JsonResponse
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return $this->handleApiResponse('success', 'Logout success');
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
}

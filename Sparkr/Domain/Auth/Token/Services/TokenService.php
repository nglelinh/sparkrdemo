<?php

namespace Sparkr\Domain\Auth\Token\Services;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\Token as OToken;
use Laravel\Passport\TokenRepository;

class TokenService
{
	/**
	 * @var TokenRepository
	 */
	private $tokenRepository;
	/**
	 * @var RefreshTokenRepository
	 */
	private $refreshTokenRepository;

	/**
	 *.
	 */
	public function __construct()
	{
		$this->tokenRepository = app(TokenRepository::class);
		$this->refreshTokenRepository = app(RefreshTokenRepository::class);
	}

	public function refreshToken(array $param)
	{
		$oClient = OClient::where('password_client', 1)->first();
		$response = Http::asForm()->post(url('/oauth/token'), [
			'grant_type' => 'refresh_token',
			'refresh_token' => $param['refresh_token'],
			'client_id' => $oClient->id,
			'client_secret' => $oClient->secret,
			'scope' => '*',
		])->object();
		if (isset($response->error)) {
			return response()->json([
										'status' => 'error',
										'message' => $response->message,
										'data' => []
									], 401);
		}
		return $this->tokenOutput($response);
	}

	/**
	 * @param object $responseObj
	 * @return JsonResponse
	 */
	public function tokenOutput(object $responseObj): JsonResponse
	{
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
		return $this->handleApiResponse('success', 'Success', $tokenData);
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
	 *
	 */
	public function revokeToken(): void
	{
		$allTokenByUser = OToken::where('user_id', Auth::user()->id)->get();
		foreach ($allTokenByUser as $item) {
			$this->tokenRepository->revokeAccessToken($item->id);
			$this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId($item->id);
		}
	}
}

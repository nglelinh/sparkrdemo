<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\User\Services\FollowService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

class FollowController extends BaseController
{
    public function follow(FollowService $followService, Request $request): JsonResponse
    {
        $followerId = $request->input('followerId');
        $userId = $request->input('userId');

        $response = $followService->follow($followerId, $userId);

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    public function unfollow(FollowService $followService, Request $request): JsonResponse
    {
        $followerId = $request->input('followerId');
        $userId = $request->input('userId');

        $response = $followService->unfollow($followerId, $userId);

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

}

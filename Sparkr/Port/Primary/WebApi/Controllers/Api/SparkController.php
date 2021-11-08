<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\User\Services\SparkService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

class SparkController extends BaseController
{
    public function giveSpark(SparkService $sparkService, Request $request): JsonResponse
    {
        $sparkId = $request->input('sparkId');
        $userGiveSparkId = $request->input('userId');
        $response = $sparkService->giveSpark($sparkId, $userGiveSparkId);

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    public function addSkill(SparkService $sparkService, Request $request): JsonResponse
    {
        $userToId = $request->input('userToId');
        $userFromId = $request->input('userFromId');
        $skillName = $request->input('skillName');

        $response = $sparkService->addSkill($userToId, $userFromId, $skillName);

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

}

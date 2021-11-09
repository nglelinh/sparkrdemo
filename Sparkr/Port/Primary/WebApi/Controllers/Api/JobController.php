<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\User\Services\JobService;
use Sparkr\Application\User\Services\SparkService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

class JobController extends BaseController
{
    public function applyJob(JobService $jobService, Request $request): JsonResponse
    {
        $jobId = $request->input('jobId');
        $userId = $request->input('userId');
        $response = $jobService->applyJob($jobId, $userId);

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    public function interestedJob(JobService $jobService, Request $request): JsonResponse
    {
        $userToId = $request->input('userToId');
        $userFromId = $request->input('userFromId');
        $skillName = $request->input('skillName');

        $response = $jobService->interestedJob($userToId, $userFromId, $skillName);

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

}

<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\User\Services\PersonalProfileService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

class PersonalController extends BaseController
{
    public function personalProfileList(PersonalProfileService $personalProfileService): JsonResponse
    {
        $response = $personalProfileService->getPersonalProfile();

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }
    public function personalProfileListSearch(Request $request, PersonalProfileService $personalProfileService): JsonResponse
    {
        $response = $personalProfileService->personalProfileListSearch($request->all());

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }
    public function basicPersonalInfo(PersonalProfileService $personalProfileService, int $id): JsonResponse
    {
        $response = $personalProfileService->getBasicPersonalInfo($id);

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }
}

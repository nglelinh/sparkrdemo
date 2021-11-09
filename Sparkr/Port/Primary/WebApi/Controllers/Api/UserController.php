<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sparkr\Application\User\Services\CompanyProfileService;
use Sparkr\Application\User\Services\PersonalProfileService;
use Sparkr\Domain\Base\UserType\Enums\UserType;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

class UserController extends BaseController
{
    public function userList(
        PersonalProfileService $personalProfileService, CompanyProfileService $companyProfileService
    ): JsonResponse
    {
//        $userType = Auth::user()->getDomainEntity()->getUserType();
        $userType = UserType::Personal;
        switch ($userType){
            case UserType::Company:
                $response = $personalProfileService->getPersonalProfile();
                break;
            case UserType::Personal:
                $response = $companyProfileService->getCompanyProfile();
                break;
        }

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }
    public function userSearch(Request $request, PersonalProfileService $personalProfileService, CompanyProfileService $companyProfileService): JsonResponse
    {
//        $userType = Auth::user()->getDomainEntity()->getUserType();
        $userType = UserType::Personal;
        switch ($userType){
            case UserType::Company:
                $response = $personalProfileService->personalProfileListSearch($request->all());
                break;
            case UserType::Personal:
                $response = $companyProfileService->companyProfileListSearch($request->all());
                break;
        }

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    public function basicUserInfo(int $id, PersonalProfileService $personalProfileService, CompanyProfileService $companyProfileService): JsonResponse
    {
//        $userType = Auth::user()->getDomainEntity()->getUserType();
        $userType = UserType::Personal;
        switch ($userType){
            case UserType::Company:
                $response = $personalProfileService->getBasicPersonalInfo($id);
                break;
            case UserType::Personal:
                $response = $companyProfileService->getBasicCompanyInfo($id);
                break;
        }

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    public function userDetail(int $id, PersonalProfileService $personalProfileService, CompanyProfileService $companyProfileService): JsonResponse
    {
//        $userType = Auth::user()->getDomainEntity()->getUserType();
        $userType = UserType::Personal;
        switch ($userType){
            case UserType::Company:
                $response = $personalProfileService->getPersonalProfileDetail($id);
                break;
            case UserType::Personal:
                $response = $companyProfileService->getCompanyProfileDetail($id);
                break;
        }

        self::setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

}

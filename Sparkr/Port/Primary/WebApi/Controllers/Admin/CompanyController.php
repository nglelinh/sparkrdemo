<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\Admin\Services\AdminCompanyService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

/**
 * Class CompanyController
 * @package Sparkr\Port\Primary\WebApi\Controllers\Admin
 *
 */
class CompanyController extends BaseController
{
    /**
     */
    public function index(AdminCompanyService $service): JsonResponse
    {
        $response = $service->index();

        $this->setResponse($response['status'], $response['message'], $response['data']);
        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function create(Request $request, AdminCompanyService $service)
    {
        $response = $service->create($request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function update(int $id, Request $request, AdminCompanyService $service )
    {
        $response = $service->update($id, $request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function updateStatus(int $id, AdminCompanyService $service )
    {
        $response = $service->updateStatus($id);

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function delete(AdminCompanyService $service, int $id)
    {
        $response = $service->delete($id);

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }
}

<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\Admin\Services\AdminLocationService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

/**
 * Class LocationController
 * @package Sparkr\Port\Primary\WebApi\Controllers\Admin
 *
 */
class LocationController extends BaseController
{
    /**
     */
    public function index(AdminLocationService $service): JsonResponse
    {

        $response = $service->index();

        $this->setResponse($response['status'], $response['message'], $response['data']);
        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function create(Request $request, AdminLocationService $service)
    {
        $response = $service->create($request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function update(int $id, AdminLocationService $service, Request $request)
    {
        $response = $service->update($id, $request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function delete(AdminLocationService $service, int $id)
    {
        $response = $service->delete($id);

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }
}

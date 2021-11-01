<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\Admin\Services\AdminJobService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

/**
 * Class JobController
 * @package Sparkr\Port\Primary\WebApi\Controllers\Admin
 *
 */
class JobController extends BaseController
{
    /**
     */
    public function index(AdminJobService $service): JsonResponse
    {

        $response = $service->index();

        $this->setResponse($response['status'], $response['message'], $response['data']);
        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function create(Request $request, AdminJobService $service)
    {
        $response = $service->create($request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function update(int $id, AdminJobService $service, Request $request)
    {
        $response = $service->update($id, $request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function delete(AdminJobService $service, int $id)
    {
        $response = $service->delete($id);

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }
}

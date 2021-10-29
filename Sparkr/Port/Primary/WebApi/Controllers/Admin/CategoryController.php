<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\Admin\Services\AdminCategoryService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

/**
 * Class CategoryController
 * @package Sparkr\Port\Primary\WebApi\Controllers\Admin
 *
 */
class CategoryController extends BaseController
{
    /**
     */
    public function index(AdminCategoryService $service): JsonResponse
    {

        $response = $service->index();

        $this->setResponse($response['status'], $response['message'], $response['data']);
        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function create(Request $request, AdminCategoryService $service)
    {
        $response = $service->create($request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function update(int $id, AdminCategoryService $service, Request $request)
    {
        $response = $service->update($id, $request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function delete(AdminCategoryService $service, int $id)
    {
        $response = $service->delete($id);

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }
}

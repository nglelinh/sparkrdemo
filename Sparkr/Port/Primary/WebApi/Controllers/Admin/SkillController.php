<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sparkr\Application\Admin\Services\AdminSkillService;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

/**
 * Class SkillController
 * @package Sparkr\Port\Primary\WebApi\Controllers\Admin
 *
 */
class SkillController extends BaseController
{
    /**
     */
    public function index(AdminSkillService $service): JsonResponse
    {

        $response = $service->index();

        $this->setResponse($response['status'], $response['message'], $response['data']);
        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function create(Request $request, AdminSkillService $service)
    {
        $response = $service->create($request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function update(int $id, AdminSkillService $service, Request $request)
    {
        $response = $service->update($id, $request->input());

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     */
    public function delete(AdminSkillService $service, int $id)
    {
        $response = $service->delete($id);

        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }
}

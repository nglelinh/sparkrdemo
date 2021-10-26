<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Api;


use App\Http\Controllers\Controller;
use Sparkr\Port\Primary\WebApi\Controllers\BaseController;
use Illuminate\Http\Response;
use Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler;

class UserController extends BaseController
{
    public function index()
    {
        $this->data = ['ok'=>1];
        return ApiResponseHandler::jsonResponse(Response::HTTP_OK, __('api_messages.successful'), $this->data);
    }
}

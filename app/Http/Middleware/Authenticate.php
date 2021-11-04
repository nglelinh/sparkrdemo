<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * @param Request $request
     * @param array $guards
     * @return void
     */
    protected function unauthenticated($request, array $guards)
    {
        (new JsonResponse([
                              'status' => 'false',
                              'error' => 'token_invalid',
                              'message' => 'Token invalid',
                          ], Response::HTTP_UNAUTHORIZED))->throwResponse();
    }
}

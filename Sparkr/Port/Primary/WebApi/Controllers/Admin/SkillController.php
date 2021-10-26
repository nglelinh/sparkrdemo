<?php

namespace Sparkr\Port\Primary\WebApi\Controllers\Admin;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Admin\SkillRequest;
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
     * Get all skills
     */
    public function getAllSkills(SkillRequest $request, AdminSkillService $skillService)
    {
        // Retrieve all skills
        $param['skill_name']='';
        $response = $skillService->getAllSkills($param);
        // Set api response
        $this->setResponse($response['status'], $response['message'], $response['data']);
        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     * Create new a skill
     */
    public function createSkill(SkillRequest $request, AdminSkillService $skillService)
    {
        $param=[
            'skill_name'=>'A', 'is_selectable'=>'1'
        ];
        // create new skill
        $response = $skillService->createNewSkill($param);

        // Set api responsex
        $this->setResponse($response['status'], $response['message'], $response['data']);

        return \Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     * Update an existing skill
     */
    public function updateSkill(SkillRequest $request, AdminSkillService $skillService, int $id)
    {
        $param=[
            'skill_name'=>'B', 'is_selectable'=>'1'
        ];
        // update an existing skill
        $response = $skillService->updateSkill($id, $param);

        // Set api response
        $this->setResponse($response['status'], $response['message'], $response['data']);

        return \Sparkr\Port\Primary\WebApi\ResponseHandler\Api\ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }

    /**
     * Delete an existing skill
     */
    public function deleteSkill(AdminSkillService $skillService, int $id)
    {
        // delete an existing skill
        $response = $skillService->deleteSkill($id);

        // Set api response
        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message,  $this->data);
    }
}

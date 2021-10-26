<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;
use Illuminate\Http\Response;

class AdminSkillService
{
    /**
     * @var SkillRepositoryInterface
     */
    private $skillRepository;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $data = [];

    /**
     * AdminSkillService constructor.
     * @param  SkillRepositoryInterface  $skillRepository
     */
    public function __construct(SkillRepositoryInterface $skillRepository)
    {
        $this->skillRepository = $skillRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     * Get All Skills
     *
     * @return Array
     */
    public function getAllSkills($param): array
    {
        $this->data =  $this->skillRepository->getAllSkills($param['skill_name'] ?? "")->transform(function (Skill $skill) {
            return [
                'id' => $skill->getId(),
                'skill_name' => $skill->getSkillName(),
                'is_selectable' => $skill->isSelectable(),
            ];
        })->toArray();
//        return $this->data;
        return $this->handleApiResponse();
    }

    /**
     * Create New Skill
     *
     * @return Array
     */
    public function createNewSkill(array $param): array
    {
        $newSkill = new Skill($param['skill_name'], $param['is_selectable']);
        $this->skillRepository->save($newSkill);

        return $this->handleApiResponse();
    }

    /**
     * Update exsting Skill
     *
     * @return Array
     */
    public function updateSkill(int $id, array $param): array
    {

        $skill = $this->skillRepository->getSkillById($id);
        $skill->setSkillName($param['skill_name']);
        $skill->setIsSelectable($param['is_selectable']);

        $this->skillRepository->save($skill);

        return $this->handleApiResponse();
    }

    /**
     * Delete exsting Skill
     *
     * @return Array
     */
    public function deleteSkill(int $id): array
    {
        $skill = $this->skillRepository->getSkillById($id);
        $skill->disable();

        $this->skillRepository->save($skill);
        return $this->handleApiResponse();
    }

    /**
     * Format response data
     *
     * @return array
     */
    public function handleApiResponse(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}

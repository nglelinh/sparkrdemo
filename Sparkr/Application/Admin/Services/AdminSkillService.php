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
     */
    public function __construct(SkillRepositoryInterface $skillRepository)
    {
        $this->skillRepository = $skillRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->skillRepository->getAllSkill()->transform(function (Skill $skill) {
            return [
                'id' => $skill->getId(),
                'name' => $skill->getName(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $skill = new Skill($param['name']);
        $this->skillRepository->save($skill);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $skill = $this->skillRepository->getById($id);
        $skill->setName($param['name']);

        $this->skillRepository->save($skill);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->skillRepository->delete($id);

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

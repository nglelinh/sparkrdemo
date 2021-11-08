<?php

namespace Sparkr\Application\User\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillDetailRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkill;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkillDetail;

class SparkService
{

    private SparkSkillRepositoryInterface $sparkSkillRepository;
    private SparkSkillDetailRepositoryInterface $sparkDetailRepository;
    private SkillRepositoryInterface $skillRepository;


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
    public function __construct(
        SparkSkillRepositoryInterface $sparkSkillRepository,
        SparkSkillDetailRepositoryInterface $sparkDetailRepository,
        SkillRepositoryInterface $skillRepository,
    ) {
        $this->sparkSkillRepository = $sparkSkillRepository;
        $this->sparkDetailRepository = $sparkDetailRepository;
        $this->skillRepository = $skillRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    public function giveSpark(int $sparkId, int $userGiveSparkId): array
    {
        DB::beginTransaction();
        try {
            $sparkSkill = $this->sparkSkillRepository->getSparkSkillById($sparkId);
            $sparkSkill->addOneSpark();
            $sparkDetail = new SparkSkillDetail($sparkId, $userGiveSparkId);

            $this->sparkSkillRepository->save($sparkSkill);
            $this->sparkDetailRepository->save($sparkDetail);
            DB::commit();
            return $this->handleApiResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
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

    public function addSkill(int $userToId, int $userFromId, string $skillName)
    {
        DB::beginTransaction();
        try {
            $skill = new Skill($skillName);
            $skillId = $this->skillRepository->save($skill)->getId();

            $spark = new SparkSkill($userToId, $skillId, 1, $userFromId);
            $sparkId = $this->sparkSkillRepository->save($spark)->getId();

            $sparkDetail = new SparkSkillDetail($sparkId, $userFromId);
            $this->sparkDetailRepository->save($sparkDetail);
            DB::commit();
            return $this->handleApiResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}


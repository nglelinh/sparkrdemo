<?php

namespace Sparkr\Application\User\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Sparkr\Domain\JobManagement\Job\Interfaces\JobRepositoryInterface;
use Sparkr\Domain\JobManagement\JobApplyActivity\Interfaces\JobApplyActivityRepositoryInterface;
use Sparkr\Domain\JobManagement\JobApplyActivity\Models\JobApplyActivity;
use Sparkr\Domain\JobManagement\JobInterestedActivity\Interfaces\JobInterestedActivityRepositoryInterface;
use Sparkr\Domain\JobManagement\JobInterestedActivity\Models\JobInterestedActivity;
use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillDetailRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkill;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkillDetail;

class JobService
{
    private JobRepositoryInterface $jobRepository;
    private JobApplyActivityRepositoryInterface $jobApplyActivityRepository;
    private JobInterestedActivityRepositoryInterface $jobInterestedActivityRepository;

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
        JobRepositoryInterface $jobRepository,
        JobApplyActivityRepositoryInterface $jobApplyActivityRepository,
        JobInterestedActivityRepositoryInterface $jobInterestedActivityRepository
) {
        $this->jobRepository = $jobRepository;
        $this->jobApplyActivityRepository = $jobApplyActivityRepository;
        $this->jobInterestedActivityRepository = $jobInterestedActivityRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    public function applyJob(int $jobId, int $userId): array
    {
        DB::beginTransaction();
        try {
            $job = $this->jobRepository->getJobById($jobId);
            $job->addOneAppliedJobCount();
            $jobApplyActivity = new JobApplyActivity($jobId, $userId);

            $this->jobApplyActivityRepository->save($jobApplyActivity);
            DB::commit();
            return $this->handleApiResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function interestedJob(int $jobId, int $userId)
    {
        DB::beginTransaction();
        try {
            $job = $this->jobRepository->getJobById($jobId);
            $job->addOneInterestedJobCount();
            $jobInterestedActivity = new JobInterestedActivity($jobId, $userId);

            $this->jobInterestedActivityRepository->save($jobInterestedActivity);
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
}


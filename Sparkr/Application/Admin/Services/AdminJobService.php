<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\JobManagement\Job\Interfaces\JobRepositoryInterface;
use Sparkr\Domain\JobManagement\Job\Models\Job;
use Illuminate\Http\Response;

class AdminJobService
{
    /**
     * @var JobRepositoryInterface
     */
    private $jobRepository;

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
    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->jobRepository->getAllJob()->transform(function (Job $job) {
            return [
                'id' => $job->getId(),
                'title' => $job->getTitle(),
                'company_name' => $job->getCompanyProfile()->getUser()->getName(),
                'job_type' => $job->getJobType()->getName(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $job = new Job($param['title'],$param['company_profile_id'],$param['description']);
        $this->jobRepository->save($job);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $job = $this->jobRepository->getById($id);
        $job->setTitle($param['title']);
        $job->setCompanyProfileId($param['company_profile_id']);
        $job->setDescription($param['description']);

        $this->jobRepository->save($job);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->jobRepository->delete($id);

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

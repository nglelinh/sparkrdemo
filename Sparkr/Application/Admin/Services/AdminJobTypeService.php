<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\MasterDataManagement\JobType\Interfaces\JobTypeRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\JobType\Models\JobType;
use Illuminate\Http\Response;

class AdminJobTypeService
{
    /**
     * @var JobTypeRepositoryInterface
     */
    private $jobTypeRepository;

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
    public function __construct(JobTypeRepositoryInterface $jobTypeRepository)
    {
        $this->jobTypeRepository = $jobTypeRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->jobTypeRepository->getAllJobType()->transform(function (JobType $jobType) {
            return [
                'id' => $jobType->getId(),
                'name' => $jobType->getName(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $jobType = new JobType($param['name']);
        $this->jobTypeRepository->save($jobType);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $jobType = $this->jobTypeRepository->getById($id);
        $jobType->setName($param['name']);

        $this->jobTypeRepository->save($jobType);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->jobTypeRepository->delete($id);

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

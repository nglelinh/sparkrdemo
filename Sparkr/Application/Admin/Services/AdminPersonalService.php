<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;
use Illuminate\Http\Response;

class AdminPersonalService
{
    /**
     * @var PersonalProfileRepositoryInterface
     */
    private $personalProfileRepository;

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
    public function __construct(PersonalProfileRepositoryInterface $personalProfileRepository)
    {
        $this->personalProfileRepository = $personalProfileRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->personalProfileRepository->getAllPersonalProfile()->transform(function (PersonalProfile $personalProfile) {
            return [
                'id' => $personalProfile->getId(),
                'about' => $personalProfile->getAbout(),
                'desired_position' => $personalProfile->getDesiredPosition(),
                'education' => $personalProfile->getEducation(),
                'job_type_id' => $personalProfile->getJobTypeId(),
                'availability_id' => $personalProfile->getAvailabilityId(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $personalProfile = new PersonalProfile($param['user_id']);
        $this->personalProfileRepository->save($personalProfile);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $personalProfile = $this->personalProfileRepository->getById($id);

        $personalProfile->setAbout($param['about']);
        $personalProfile->setDesiredPosition($param['desired_position']);
        $personalProfile->setEducation($param['education']);
        $personalProfile->setJobTypeId($param['job_type_id']);
        $personalProfile->setAvailabilityId($param['availability_id']);

        $this->personalProfileRepository->save($personalProfile);

        return $this->handleApiResponse();
    }

    /**
     */
    public function updateStatus(int $id): array
    {

        $personalProfile = $this->personalProfileRepository->getById($id);

        $personalProfile->getUser()->toggleStatus();

        $this->personalProfileRepository->save($personalProfile);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->personalProfileRepository->delete($id);

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

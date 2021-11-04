<?php

namespace Sparkr\Application\User\Services;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Sparkr\Domain\ProfileManagement\JobHistory\Interfaces\JobHistoryRepositoryInterface;
use Sparkr\Domain\ProfileManagement\JobHistory\Models\JobHistory;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Services\PersonalProfileDomainService;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;
use Sparkr\Domain\Register\Login\Services\LoginService;
use Laravel\Passport\Client as OClient;

class PersonalProfileService
{

    private PersonalProfileRepositoryInterface $personalProfileRepository;
    private JobHistoryRepositoryInterface $jobHistoryRepository;


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
        PersonalProfileRepositoryInterface $personalProfileRepository,
        JobHistoryRepositoryInterface $jobHistoryRepository
    )
    {
        $this->personalProfileRepository = $personalProfileRepository;
        $this->jobHistoryRepository = $jobHistoryRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }
    public function personalProfileListSearch($params): array
    {
        $search['sparkr'] = $params['sparkr'] ?? "";
        $search['keyword'] = $params['keyword'] ?? "";
        $search['filters'] = [
            'experience_level' =>  $params['experience_level'] ?? "",
            'job_type_id' => $params['job_type'] ?? "",
            'location_id' => $params['location'] ?? "",
            'availability' => $params['availability'] ?? "",
        ];
        $personalProfiles = $this->personalProfileRepository->getSpecifiedPersonalProfile($search);

        foreach ($personalProfiles as $personalProfile){
            $userId = $personalProfile->getUserId();
            $userName = $personalProfile->getUser()->getName();
            $currentPosition = $personalProfile->getCurrentPosition();
            $image = $personalProfile->getUser()->getImage();

            $this->data[] = [
                'id'=> $userId,
                'name'=> $userName,
                'current_position'=> $currentPosition,
                'image'=> $image,
            ];
        }

        return $this->handleApiResponse();

    }

    /**
     */
    public function getPersonalProfile(): array
    {
        $recommendPersonalProfiles = $this->personalProfileRepository->getRecommendPersonalProfile();
        foreach ($recommendPersonalProfiles as $personalProfile){
            $userId = $personalProfile->getUserId();
            $userName = $personalProfile->getUser()->getName();
            $currentPosition = $personalProfile->getCurrentPosition();
            $image = $personalProfile->getUser()->getImage();
            $sparkCount = $personalProfile->getUser()->getSparkCount();

            $this->data['recommendedList'] = [
                'id'=> $userId,
                'name'=> $userName,
                'current_position'=> $currentPosition,
                'image'=> $image,
                'spark_count'=> $sparkCount,
            ];
        }
        $personalProfiles = $this->personalProfileRepository->getRecommendPersonalProfile();
        foreach ($personalProfiles as $personalProfile){
            $userId = $personalProfile->getUserId();
            $userName = $personalProfile->getUser()->getName();
            $currentPosition = $personalProfile->getCurrentPosition();
            $image = $personalProfile->getUser()->getImage();

            $this->data['list'] = [
                'id'=> $userId,
                'name'=> $userName,
                'current_position'=> $currentPosition,
                'image'=> $image,
            ];
        }
        return $this->handleApiResponse();
    }

    public function getBasicPersonalInfo(int $id): array
    {
        $personalProfile = $this->personalProfileRepository->getByUserId($id);
        $desiredPosition = $personalProfile->getDesiredPosition();
        $userName = $personalProfile->getUser()->getName();
        $jobHistory = $this->jobHistoryRepository->getShortJobHistoryByUserId($id)->transform(function (JobHistory $jobHistory) {
            return [
                'company' => $jobHistory->getCompanyName(),
                'year' => $jobHistory->getStartDate()->format('Y'),
                'title' => $jobHistory->getTitle(),
            ];
        })->toArray();

        $this->data[] = [
            'name'=> $userName,
            'job_history'=> $jobHistory,
            'desired_position'=> $desiredPosition,
        ];
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

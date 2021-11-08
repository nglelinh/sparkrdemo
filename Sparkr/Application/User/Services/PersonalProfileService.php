<?php

namespace Sparkr\Application\User\Services;

use Illuminate\Http\Response;
use Sparkr\Domain\ProfileManagement\JobHistory\Interfaces\JobHistoryRepositoryInterface;
use Sparkr\Domain\ProfileManagement\JobHistory\Models\JobHistory;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkill;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkillDetail;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\UserFollowing\Interfaces\UserFollowingRepositoryInterface;
use Sparkr\Domain\UserManagement\UserFollowing\Services\UserFollowerDomainService;
use Sparkr\Domain\UserManagement\UserSocialLink\Models\UserSocialLink;

class PersonalProfileService
{

    private PersonalProfileRepositoryInterface $personalProfileRepository;
    private JobHistoryRepositoryInterface $jobHistoryRepository;
    private SparkSkillRepositoryInterface $sparkSkillRepository;
    private UserRepositoryInterface $userRepository;
    private UserFollowingRepositoryInterface $userFollowerRepository;
    private UserFollowerDomainService $userFollowerDomainService;


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
        JobHistoryRepositoryInterface $jobHistoryRepository,
        SparkSkillRepositoryInterface $sparkSkillRepository,
        UserRepositoryInterface $userRepository,
        UserFollowingRepositoryInterface $userFollowerRepository,
        UserFollowerDomainService $userFollowerDomainService
    )
    {
        $this->personalProfileRepository = $personalProfileRepository;
        $this->jobHistoryRepository = $jobHistoryRepository;
        $this->sparkSkillRepository = $sparkSkillRepository;
        $this->userRepository = $userRepository;
        $this->userFollowerRepository = $userFollowerRepository;
        $this->userFollowerDomainService = $userFollowerDomainService;

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
        $this->data[] = $this->personalProfileRepository->getSpecifiedPersonalProfile($search)
            ->transform(function (PersonalProfile $personalProfile) {
            return [
                'id' => $personalProfile->getUserId(),
                'name' => $personalProfile->getUser()->getName(),
                'current_position' => $personalProfile->getCurrentPosition(),
                'image' => $personalProfile->getUser()->getImage()
            ];
        })->toArray();

        return $this->handleApiResponse();

    }

    /**
     */
    public function getPersonalProfile(): array
    {
        $this->data['recommendedList'] = $this->personalProfileRepository->getRecommendPersonalProfile()
            ->transform(function (PersonalProfile $personalProfile) {
                return [
                    'id' => $personalProfile->getUserId(),
                    'name' => $personalProfile->getUser()->getName(),
                    'current_position' => $personalProfile->getCurrentPosition(),
                    'image' => $personalProfile->getUser()->getImage(),
                    'spark_count' => $personalProfile->getUser()->getSparkCount()
                ];
            })->toArray();

        $this->data['list'] = $this->personalProfileRepository->getRecommendPersonalProfile()
            ->transform(function (PersonalProfile $personalProfile) {
                return [
                    'id' => $personalProfile->getUserId(),
                    'name' => $personalProfile->getUser()->getName(),
                    'current_position' => $personalProfile->getCurrentPosition(),
                    'image' => $personalProfile->getUser()->getImage()
                ];
            })->toArray();

        return $this->handleApiResponse();
    }

    public function getBasicPersonalInfo(int $id): array
    {
        $personalProfile = $this->personalProfileRepository->getByUserId($id);
        $personalProfileId = $personalProfile->getId();
        $desiredPosition = $personalProfile->getDesiredPosition();
        $userName = $personalProfile->getUser()->getName();
        $jobHistory = $this->jobHistoryRepository->getShortJobHistoryByPersonalProfileId($personalProfileId)
            ->transform(function (JobHistory $jobHistory) {
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

    public function getPersonalProfileDetail(int $userId): array
    {
//        $authUserId =
        $personalProfile = $this->personalProfileRepository->getDetailByUserId($userId);
        $personalProfileId = $personalProfile->getId();

        $name= $personalProfile->getUser()->getName();
        $image= $personalProfile->getUser()->getImage();
        $currentPosition = $personalProfile->getCurrentPosition();
        $socialLinks = $personalProfile->getUser()->getSocialLinks()->transform(function (UserSocialLink $socialLink) {
            return [
                'url' => $socialLink->getUrl(),
                'social_network' => $socialLink->getSocialNetwork(),
            ];
        })->toArray();
        $about = $personalProfile->getAbout();
        $description = $personalProfile->getUser()->getDescription();
        $education = $personalProfile->getEducation();

        $sparkSkills = $this->sparkSkillRepository->getSparkSkillByUserId($userId);
        $skillCount = $sparkSkills->count();
        $sparkSkillsArray = $sparkSkills->transform(function (SparkSkill $sparkSkill, $authUserId) {
            return [
                'spark_id' => $sparkSkill->getId(),
                'skill_name' => $sparkSkill->getSkill()->getName(),
                'spark_count' => $sparkSkill->getSparkSkillCount(),
                'is_sparked' => $sparkSkill->getSparkDetails()->each(function (SparkSkillDetail $detail, $authUserId){
                    return $detail->getSparkFromUserId() === $authUserId;
                })
            ];
        })->toArray();

        $jobHistory = $this->jobHistoryRepository->getAllJobHistoryByPersonalProfileId($personalProfileId)->transform(function (JobHistory $jobHistory) {
            return [
                'title' => $jobHistory->getTitle(),
                'company' => $jobHistory->getCompanyName(),
                'start_year' => $jobHistory->getStartDate()->format('Y'),
                'end_year' => $jobHistory->getEndDate()->format('Y'),
                'availability' => $jobHistory->getAvailabilityId(),
                'description' => $jobHistory->getDescription(),
            ];
        })->toArray();
//        pass Auth::user to get authUserId
//        $following = $this->userFollowerDomainService->isFollower($authUserId, $userId);

        $this->data[] = [
            'name' => $name,
            'image' => $image,
            'current_position' => $currentPosition,
            'social_link' => $socialLinks,
            'about' => $about,
            'description' => $description,
            'education' => $education,
            'skill_count' => $skillCount,
            'spark' => $sparkSkillsArray,
            'job_history' => $jobHistory,
//            'following' => $following
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

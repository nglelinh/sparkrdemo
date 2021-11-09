<?php

namespace Sparkr\Application\User\Services;

use Illuminate\Http\Response;
use Sparkr\Domain\JobManagement\Job\Interfaces\JobRepositoryInterface;
use Sparkr\Domain\JobManagement\Job\Models\Job;
use Sparkr\Domain\JobManagement\JobApplyActivity\Models\JobApplyActivity;
use Sparkr\Domain\JobManagement\JobInterestedActivity\Models\JobInterestedActivity;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
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

class CompanyProfileService
{

    private CompanyProfileRepositoryInterface $companyProfileRepository;
    private JobRepositoryInterface $jobRepository;
    private SparkSkillRepositoryInterface $sparkSkillRepository;
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
        CompanyProfileRepositoryInterface $companyProfileRepository,
        JobRepositoryInterface $jobRepository,
        SparkSkillRepositoryInterface $sparkSkillRepository,
        UserFollowingRepositoryInterface $userFollowerRepository,
        UserFollowerDomainService $userFollowerDomainService
    )
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->jobRepository = $jobRepository;
        $this->sparkSkillRepository = $sparkSkillRepository;
        $this->userFollowerRepository = $userFollowerRepository;
        $this->userFollowerDomainService = $userFollowerDomainService;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }
    public function companyProfileListSearch($params): array
    {
        $search['sparkr'] = $params['sparkr'] ?? "";
        $search['keyword'] = $params['keyword'] ?? "";
        $search['filters'] = [
            'experience_level' =>  $params['experience_level'] ?? "",
            'job_type_id' => $params['job_type'] ?? "",
            'location_id' => $params['location'] ?? "",
            'category_id' => $params['category'] ?? "",
        ];
        $this->data[] = $this->companyProfileRepository->getSpecifiedCompanyProfile($search)
            ->transform(function (CompanyProfile $companyProfile) {
                $user = $companyProfile->getUser();
                return [
                    'id' => $companyProfile->getUserId(),
                    'name' => $user->getName(),
                    'location' => $user->getLocation(),
                    'image' => $user->getImage()
                ];
            })->toArray();

        return $this->handleApiResponse();
    }

    /**
     */
    public function getCompanyProfile(): array
    {
        $this->data['recommendedList'] = $this->companyProfileRepository->getRecommendCompanyProfileList()
            ->transform(function (CompanyProfile $companyProfile) {
                $user = $companyProfile->getUser();
                return [
                    'id' => $companyProfile->getUserId(),
                    'name' => $user->getName(),
                    'location' => $user->getLocation(),
                    'image' => $user->getImage(),
                    'spark_count' => $user->getSparkCount()
                ];
            })->toArray();
        $this->data['list'] = $this->companyProfileRepository->getCompanyProfileList()
            ->transform(function (CompanyProfile $companyProfile) {
                $user = $companyProfile->getUser();
                return [
                    'id' => $companyProfile->getUserId(),
                    'name' => $user->getName(),
                    'location' => $user->getLocation(),
                    'image' => $user->getImage()
                ];
            })->toArray();

        return $this->handleApiResponse();
    }

    public function getBasicCompanyInfo(int $id): array
    {
        $companyProfile = $this->companyProfileRepository->getByUserId($id);
        $companyProfileId = $companyProfile->getId();
        $userName = $companyProfile->getUser()->getName();
        $jobs = $this->jobRepository->getShortJobListByCompanyProfileId($companyProfileId)
            ->transform(function (Job $job) {
                return [
                    'title' => $job->getTitle(),
                    'availability' => $job->getAvailability(),
                ];
            })->toArray();

        $this->data[] = [
            'name'=> $userName,
            'jobs'=> $jobs,
        ];
        return $this->handleApiResponse();
    }

    public function getCompanyProfileDetail(int $userId): array
    {
//        $authUserId =
        $companyProfile = $this->companyProfileRepository->getDetailByUserId($userId);
        $companyProfileId = $companyProfile->getId();

        $name= $companyProfile->getUser()->getName();
        $image= $companyProfile->getUser()->getImage();
        $location = $companyProfile->getUser()->getLocation();
        $companyWebsiteUrl = $companyProfile->getCompanyWebsiteUrl();
        $socialLinks = $companyProfile->getUser()->getSocialLinks()->transform(function (UserSocialLink $socialLink) {
            return [
                'url' => $socialLink->getUrl(),
                'social_network' => $socialLink->getSocialNetwork(),
            ];
        })->toArray();
        $description = $companyProfile->getUser()->getDescription();
        $information = [
            'location' => $location,
            'phone' => $companyProfile->getPhone(),
            'category' => $companyProfile->getCategory()->getName(),
        ];
        $employeeBenefits = $companyProfile->getEmployeeBenefits();

        $sparkSkills = $this->sparkSkillRepository->getSparkSkillByUserId($userId);
        $skillCount = $sparkSkills->count();
        $sparkSkillsArray = $sparkSkills->transform(function (SparkSkill $sparkSkill) { // use ($authUserId)
            return [
                'spark_id' => $sparkSkill->getId(),
                'skill_name' => $sparkSkill->getSkill()->getName(),
                'spark_count' => $sparkSkill->getSparkSkillCount(),
//                'is_sparked' => $this->isSparked($sparkSkill, $authUserId)
            ];
        })->toArray();

        $jobs = $this->jobRepository->getJobAndActivitiesByCompanyProfileId($companyProfileId)->transform(function (Job $job) { //use ($authUserId)
            return [
                'job_id' => $job->getId(),
                'title' => $job->getTitle(),
                'availability' => $job->getAvailability(),
                'description' => $job->getDescription(),
//                'isApplied' => $this->isApplied($job, $authUserId),
//                'isInterested' => $this->isInterested($job, $authUserId)
            ];
        })->toArray();
//        pass Auth::user to get authUserId
//        $following = $this->userFollowerDomainService->isFollower($authUserId, $userId);

        $this->data[] = [
            'name' => $name,
            'image' => $image,
            'companyWebsiteUrl' => $companyWebsiteUrl,
            'socialLink' => $socialLinks,
            'description' => $description,
            'information' => $information,
            'employeeBenefits' => $employeeBenefits,
            'skillCount' => $skillCount,
            'spark' => $sparkSkillsArray,
            'jobs' => $jobs,
//            'following' => $following
        ];
        return $this->handleApiResponse();
    }

    public function isSparked(SparkSkill $sparkSkill, int $authUserId): bool
    {
        $details = $sparkSkill->getSparkDetails();
        foreach ($details as $detail){
            if ($detail->getSparkFromUserId() === $authUserId){
                return true;
            }
        }
        return false;
    }

    public function isApplied(Job $job, int $authUserId): bool
    {
        $applyActivities = $job->getJobApplyActivities();
        foreach ($applyActivities as $applyActivity){
            if ($applyActivity->getPersonalProfile()->getUserId() === $authUserId){
                return true;
            }
        }
        return false;
    }

    public function isInterested(Job $job, int $authUserId): bool
    {
        $interestedActivities = $job->getJobInterestedActivities();
        foreach ($interestedActivities as $interestedActivity){
            if ($interestedActivity->getPersonalProfile()->getUserId() === $authUserId){
                return true;
            }
        }
        return false;
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

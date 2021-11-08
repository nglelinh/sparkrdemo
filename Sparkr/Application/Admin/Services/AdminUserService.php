<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\MasterDataManagement\UserType\Enums\UserType;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;
use Illuminate\Http\Response;

class AdminUserService
{
    private UserRepositoryInterface $userRepository;
    private PersonalProfileRepositoryInterface $personalProfileRepository;
    private CompanyProfileRepositoryInterface $companyProfileRepository;

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
        UserRepositoryInterface $userRepository,
        PersonalProfileRepositoryInterface $personalProfileRepository,
        CompanyProfileRepositoryInterface $companyProfileRepository
    ) {
        $this->userRepository = $userRepository;
        $this->personalProfileRepository = $personalProfileRepository;
        $this->companyProfileRepository = $companyProfileRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->userRepository->getAllUser()->transform(function (User $user) {
            return [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'image' => $user->getImage(),
                'user_type_id' => $user->getUserType(),
                'experience_level_id' => $user->getExperienceLevel(),
                'location' => $user->getLocation()?->getName(),
                'spark_count' => $user->getSparkCount(),
                'following_count' => $user->getFollowingCount(),
                'followed_count' => $user->getFollowerCount(),
                'last_login' => $user->getLastLogin(),
                'status' => $user->getStatus(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $user = new User(
            $param['email'],
            $param['password'],
            $param['name'],
            $param['user_type'],
            $param['experience_level']
        );
        $userId = $this->userRepository->save($user)->getId();

        if ($param['user_type']==UserType::Personal){
            $personalProfile = new User($userId, $param['desired_position']);
            $this->personalProfileRepository->save($personalProfile);
        }else{
            $companyProfile = new CompanyProfile($userId, $param['category']);
            $this->companyProfileRepository->save($companyProfile);
        }

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $user = $this->userRepository->getById($id);
        $user->setName($param['name']);

        $this->userRepository->save($user);

        return $this->handleApiResponse();
    }

    /**
     */
    public function updateStatus(int $id): array
    {

        $companyProfile = $this->companyProfileRepository->getById($id);

        $companyProfile->getUser()->toggleStatus();

        $this->companyProfileRepository->save($companyProfile);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->userRepository->delete($id);

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

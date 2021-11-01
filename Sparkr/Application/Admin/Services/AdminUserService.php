<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;
use Illuminate\Http\Response;

class AdminUserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $UserRepository;

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
    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->UserRepository->getAllUser()->transform(function (User $User) {
            return [
                'id' => $User->getId(),
                'name' => $User->getName(),
                'email' => $User->getEmail(),
                'password' => $User->getPassword(),
                'image' => $User->getImage(),
                'user_type_id' => $User->getUserTypeId(),
                'experience_level_id' => $User->getExperienceLevelId(),
                'location_id' => $User->getLocationId(),
                'spark_count' => $User->getSparkCount(),
                'following_count' => $User->getFollowingCount(),
                'followed_count' => $User->getFollowedCount(),
                'last_login' => $User->getLastLogin(),
                'status' => $User->getStatus(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $User = new User($param['email'], $param['password']);
        $this->UserRepository->save($User);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $User = $this->UserRepository->getById($id);
        $User->setName($param['name']);

        $this->UserRepository->save($User);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->UserRepository->delete($id);

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

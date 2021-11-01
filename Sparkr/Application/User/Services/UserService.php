<?php

namespace Sparkr\Application\User\Services;

use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;


    /**
     * AdminSchoolService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Create New School
     *
     * @param array $param
     * @return array
     */
    public function createNewUser(array $param): array
    {
        $newUser = new User($param['email'], bcrypt($param['password']), $param['name']);
        $this->userRepository->save($newUser);

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
            'status' => 200,
            'message' => 'nice'
        ];
    }
}

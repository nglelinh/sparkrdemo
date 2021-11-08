<?php

namespace Sparkr\Domain\UserManagement\UserFollowing\Services;


use Sparkr\Domain\UserManagement\UserFollowing\Interfaces\UserFollowingRepositoryInterface;

class UserFollowerDomainService
{
    private UserFollowingRepositoryInterface $userFollowingRepository;

    public function __construct(
        UserFollowingRepositoryInterface $userFollowingRepository
    ) {
        $this->userFollowingRepository = $userFollowingRepository;
    }
    public function isFollower($authUserId, $userId): bool
    {
        return $this->userFollowingRepository->getByUserId($userId, $authUserId) ? true : false;
    }

}

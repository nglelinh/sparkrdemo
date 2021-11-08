<?php

namespace Sparkr\Domain\UserManagement\UserFollowing\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\UserManagement\User\Models\User;

/**
 *
 */
class UserFollowing extends BaseDomainModel
{
    private int $followerId;

    private int $userId;
    private User $follower;
    private User $user;

    /**
     * UserFollowing constructor.
     * @param  int  $followerId
     * @param  int  $userId
     */
    public function __construct(int $followerId, int $userId)
    {
        $this->followerId = $followerId;
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getFollowerId(): int
    {
        return $this->followerId;
    }

    /**
     * @param  int  $followerId
     */
    public function setFollowerId(int $followerId): void
    {
        $this->followerId = $followerId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param  int  $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return User
     */
    public function getFollower(): User
    {
        return $this->follower;
    }

    /**
     * @param  User  $follower
     */
    public function setFollower(User $follower): void
    {
        $this->follower = $follower;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param  User  $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}

<?php

namespace Sparkr\Domain\UserManagement\UserFollowing\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class UserFollowing extends BaseDomainModel
{
    private int $following_user_id;

    private int $followed_user_id;

    /**
     * UserFollowing constructor.
     * @param  int  $following_user_id
     * @param  int  $followed_user_id
     */
    public function __construct(int $following_user_id, int $followed_user_id)
    {
        $this->following_user_id = $following_user_id;
        $this->followed_user_id = $followed_user_id;
    }

    /**
     * @return int
     */
    public function getFollowingUserId(): int
    {
        return $this->following_user_id;
    }

    /**
     * @param  int  $following_user_id
     */
    public function setFollowingUserId(int $following_user_id): void
    {
        $this->following_user_id = $following_user_id;
    }

    /**
     * @return int
     */
    public function getFollowedUserId(): int
    {
        return $this->followed_user_id;
    }

    /**
     * @param  int  $followed_user_id
     */
    public function setFollowedUserId(int $followed_user_id): void
    {
        $this->followed_user_id = $followed_user_id;
    }


}

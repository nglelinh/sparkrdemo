<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\ModelDao;

use Sparkr\Domain\UserManagement\UserFollowing\Models\UserFollowing as UserFollowingDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class UserFollowing extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_following';

    public function toDomainEntity(): UserFollowingDomainModel
    {
        $userFollowing = new UserFollowingDomainModel(
            $this->following_user_id,
            $this->followed_user_id,
        );
        $userFollowing->setId($this->getKey());

        return $userFollowing;
    }

    /**
     * @param UserFollowingDomainModel $userFollowing
     * @return UserFollowing
     */
    protected function fromDomainEntity($userFollowing)
    {
        $this->following_user_id = $userFollowing->getFollowingUserId();
        $this->followed_user_id = $userFollowing->getFollowedUserId();

        return $this;
    }

}

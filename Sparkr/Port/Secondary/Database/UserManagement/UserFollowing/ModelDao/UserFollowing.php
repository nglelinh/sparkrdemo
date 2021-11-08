<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\ModelDao;

use Sparkr\Domain\UserManagement\UserFollowing\Models\UserFollowing as UserFollowingDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\Traits\FollowerRelationshipTrait;

class UserFollowing extends BaseModel
{
    use FollowerRelationshipTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_follower';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'follower',
        'user'
    ];

    public function toDomainEntity(): UserFollowingDomainModel
    {
        $userFollow = new UserFollowingDomainModel(
            $this->follower_id,
            $this->user_id,
        );
        $userFollow->setId($this->getKey());
        $userFollow->setFollower($this->follower?->toDomainEntity());
        $userFollow->setUser($this->user?->toDomainEntity());
        return $userFollow;
    }

    /**
     * @param UserFollowingDomainModel $userFollowing
     * @return UserFollowing
     */
    protected function fromDomainEntity($userFollowing)
    {
        $this->follower_id = $userFollowing->getFollowerId();
        $this->user_id = $userFollowing->getUserId();

        return $this;
    }

}

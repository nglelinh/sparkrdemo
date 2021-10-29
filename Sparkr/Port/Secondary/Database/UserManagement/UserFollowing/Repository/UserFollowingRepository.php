<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\Repository;


use Sparkr\Domain\UserManagement\UserFollowing\Interfaces\UserFollowingRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\ModelDao\UserFollowing as UserFollowingDao;

class UserFollowingRepository extends EloquentBaseRepository implements UserFollowingRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param UserFollowingDao $model
     */
    public function __construct(UserFollowingDao $model)
    {
        parent::__construct($model);
    }

}

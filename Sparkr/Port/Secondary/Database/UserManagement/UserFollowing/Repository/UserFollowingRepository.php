<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\Repository;


use phpDocumentor\Reflection\Types\True_;
use Sparkr\Domain\UserManagement\UserFollowing\Interfaces\UserFollowingRepositoryInterface;
use Sparkr\Domain\UserManagement\UserFollowing\Models\UserFollowing;
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

    public function getByUserId(int $userId, int $follower_id): UserFollowing
    {
        $query = $this->createQuery()
            ->where('user_id', $userId)
            ->where('follower_id', $follower_id)
            ->first();
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.category_not_found'));
    }


    public function save(UserFollowing $user): UserFollowing
    {
        return $this->createModelDAO($user->getId())->saveData($user);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();
    }


}

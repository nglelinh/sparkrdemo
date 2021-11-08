<?php

namespace Sparkr\Domain\UserManagement\UserFollowing\Interfaces;


use Sparkr\Domain\UserManagement\UserFollowing\Models\UserFollowing;

interface UserFollowingRepositoryInterface
{
    public function save(UserFollowing $user): UserFollowing;

    public function getByUserId(int $userId, int $follower_id): UserFollowing;

    public function delete(int $id);


}

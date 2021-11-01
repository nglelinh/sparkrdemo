<?php

namespace Sparkr\Domain\UserManagement\User\Interfaces;

use Sparkr\Domain\UserManagement\User\Models\User;


interface UserRepositoryInterface
{
    /**
     */
    public function getAllUser();

    public function getById(int $id): ?User;

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    public function delete(int $id);

}

<?php

namespace Sparkr\Domain\UserManagement\User\Interfaces;

use Illuminate\Support\Collection;
use Sparkr\Domain\UserManagement\User\Models\User;
use Sparkr\Domain\UserManagement\User\Models\User as UserDomainModel;


interface UserRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllUser(): Collection;

    /**
     * @param int $id
     * @return UserDomainModel|null
     */
    public function getById(int $id): ?User;

    /**
     * @param string $email
     * @return UserDomainModel|null
     */
    public function getByEmail(string $email): ?UserDomainModel;

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed;

}

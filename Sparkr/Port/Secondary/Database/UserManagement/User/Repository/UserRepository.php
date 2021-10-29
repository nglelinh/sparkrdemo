<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\User\Repository;


use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Domain\UserManagement\User\Models\User;
use Sparkr\Domain\UserManagement\User\Models\User as UserDomainModel;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User as UserDao;

/**
 * @TODO: implement UserRepositoryInterface instead
 */
class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{

    /**
     * EloquentUserRepository constructor.
     * @param UserDao $model
     */
    public function __construct(UserDao $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @return UserDomainModel|null
     */
    public function getById(int $id): ?UserDomainModel
    {
        $query = $this->createQuery()->where('id', $id);

        $modelDao = $query->first();

        return $modelDao ? $modelDao->toDomainEntity() : null;

    }

    /**
     * @param UserDomainModel $user
     * @return UserDomainModel
     * @throws \Exception
     */
    public function save(UserDomainModel $user): UserDomainModel
    {
        return $this->createModelDAO($user->getId())->saveData($user);
    }

}

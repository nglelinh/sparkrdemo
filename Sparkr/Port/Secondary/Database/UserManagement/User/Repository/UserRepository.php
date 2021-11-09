<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\User\Repository;


use Exception;
use Illuminate\Support\Collection;
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
     * @return Collection
     */
    public function getAllUser(): Collection
    {
        $query = $this->model->with([
//            'location'
        ])->get();
        return $this->transformCollection($query);
    }

    /**
     * @param int $id
     * @return UserDomainModel|null
     */
    public function getById(int $id): ?UserDomainModel
    {
        $query = $this->createQuery()->where('id', $id);

        $modelDao = $query->first();

        return $modelDao?->toDomainEntity();
    }

    /**
     * @param string $email
     * @return UserDomainModel|null
     */
    public function getByEmail(string $email): ?UserDomainModel
    {
        $query = $this->createQuery()->where('email', $email);
        $modelDao = $query->first();
        return $modelDao?->toDomainEntity();
    }

    /**
     * @param UserDomainModel $user
     * @return UserDomainModel
     * @throws Exception
     */
    public function save(UserDomainModel $user): UserDomainModel
    {
        return $this->createModelDAO($user->getId())->saveData($user);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->createQuery()->where('id', $id)->delete();
    }
}

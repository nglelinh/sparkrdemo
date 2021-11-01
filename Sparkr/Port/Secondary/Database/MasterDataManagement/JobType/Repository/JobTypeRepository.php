<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\MasterDataManagement\JobType\Interfaces\JobTypeRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\JobType\Models\JobType;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\ModelDao\JobType as JobTypeDao;

class JobTypeRepository extends EloquentBaseRepository implements JobTypeRepositoryInterface
{

    /**
     * JobTypeRepository constructor.
     * @param JobTypeDao $model
     */
    public function __construct(JobTypeDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllJobType(): Collection
    {
        return $this->getAll();
    }

    /**
     */
    public function getById(int $id): JobType
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.category_not_found'));
    }

    public function save(JobType $jobType): JobType
    {
        return $this->createModelDAO($jobType->getId())->saveData($jobType);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}

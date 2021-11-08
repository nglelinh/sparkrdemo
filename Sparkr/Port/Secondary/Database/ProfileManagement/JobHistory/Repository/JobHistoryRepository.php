<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\JobHistory\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\JobHistory\Interfaces\JobHistoryRepositoryInterface;
use Sparkr\Domain\ProfileManagement\JobHistory\Models\JobHistory;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\JobHistory\ModelDao\JobHistory as JobHistoryDao;

class JobHistoryRepository extends EloquentBaseRepository implements JobHistoryRepositoryInterface
{

    const DEFAULT_SHORT_LIMIT = 3;
    /**
     * ProfileRepository constructor.
     * @param JobHistoryDao $model
     */
    public function __construct(JobHistoryDao $model)
    {
        parent::__construct($model);
    }

    public function getShortJobHistoryByPersonalProfileId(int $id): Collection
    {
        return $this->transformCollection($this->createQuery()
            ->where('personal_profile_id', $id)
            ->limit(self::DEFAULT_SHORT_LIMIT)->get());
    }

    public function getAllJobHistoryByPersonalProfileId(int $id): Collection
    {
        return $this->transformCollection($this->createQuery()
            ->where('personal_profile_id', $id)->get());
    }

    public function save(JobHistory $jobHistory)
    {
        return $this->createModelDAO($jobHistory->getId())->saveData($jobHistory);
    }
}

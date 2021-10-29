<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\JobHistory\Repository;


use Sparkr\Domain\ProfileManagement\JobHistory\Interfaces\JobHistoryRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\JobHistory\ModelDao\JobHistory as JobHistoryDao;

class JobHistoryRepository extends EloquentBaseRepository implements JobHistoryRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param JobHistoryDao $model
     */
    public function __construct(JobHistoryDao $model)
    {
        parent::__construct($model);
    }

}

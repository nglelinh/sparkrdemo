<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\JobInterestedActivity\Repository;


use Sparkr\Domain\JobManagement\JobInterestedActivity\Interfaces\JobInterestedActivityRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\JobManagement\JobInterestedActivity\ModelDao\JobInterestedActivity as JobInterestedActivityDao;

class JobInterestedActivityRepository extends EloquentBaseRepository implements JobInterestedActivityRepositoryInterface
{

    /**
     * JobRepository constructor.
     * @param JobInterestedActivityDao $model
     */
    public function __construct(JobInterestedActivityDao $model)
    {
        parent::__construct($model);
    }

}

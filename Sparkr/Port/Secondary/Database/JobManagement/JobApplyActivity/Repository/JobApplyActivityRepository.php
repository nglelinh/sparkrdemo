<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\JobApplyActivity\Repository;


use Sparkr\Domain\JobManagement\JobApplyActivity\Interfaces\JobApplyActivityRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\JobManagement\JobApplyActivity\ModelDao\JobApplyActivity as JobApplyActivityDao;

class JobApplyActivityRepository extends EloquentBaseRepository implements JobApplyActivityRepositoryInterface
{

    /**
     * JobRepository constructor.
     * @param JobApplyActivityDao $model
     */
    public function __construct(JobApplyActivityDao $model)
    {
        parent::__construct($model);
    }

}

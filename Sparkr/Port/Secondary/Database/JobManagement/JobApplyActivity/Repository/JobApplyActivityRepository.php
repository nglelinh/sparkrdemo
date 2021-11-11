<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\JobApplyActivity\Repository;


use Sparkr\Domain\JobManagement\JobApplyActivity\Interfaces\JobApplyActivityRepositoryInterface;
use Sparkr\Domain\JobManagement\JobApplyActivity\Models\JobApplyActivity;
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

    public function save(JobApplyActivity $jobApplyActivity): JobApplyActivity
    {
        return $this->createModelDAO($jobApplyActivity->getId())->saveData($jobApplyActivity);
    }

}

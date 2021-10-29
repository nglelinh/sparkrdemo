<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\Job\Repository;


use Sparkr\Domain\JobManagement\Job\Interfaces\JobRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\JobManagement\Job\ModelDao\Job as JobDao;

class JobRepository extends EloquentBaseRepository implements JobRepositoryInterface
{

    /**
     * JobRepository constructor.
     * @param JobDao $model
     */
    public function __construct(JobDao $model)
    {
        parent::__construct($model);
    }

}

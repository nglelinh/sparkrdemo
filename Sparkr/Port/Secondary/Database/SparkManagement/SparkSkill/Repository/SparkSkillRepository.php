<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Repository;


use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkill as SparkSkillDao;

class SparkSkillRepository extends EloquentBaseRepository implements SparkSkillRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param SparkSkillDao $model
     */
    public function __construct(SparkSkillDao $model)
    {
        parent::__construct($model);
    }

}

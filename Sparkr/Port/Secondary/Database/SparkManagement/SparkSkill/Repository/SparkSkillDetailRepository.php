<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Repository;


use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillDetailRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkillDetail as SparkSkillDao;

class SparkSkillDetailRepository extends EloquentBaseRepository implements SparkSkillDetailRepositoryInterface
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

<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Repository;


use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillDetailRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkillDetail;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkillDetail as SparkSkillDetailDao;

class SparkSkillDetailRepository extends EloquentBaseRepository implements SparkSkillDetailRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param SparkSkillDetailDao $model
     */
    public function __construct(SparkSkillDetailDao $model)
    {
        parent::__construct($model);
    }

    public function save(SparkSkillDetail $sparkSkillDetail): SparkSkillDetail
    {
        return $this->createModelDAO($sparkSkillDetail->getId())->saveData($sparkSkillDetail);
    }
}

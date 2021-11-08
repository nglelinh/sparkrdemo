<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao;

use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkillDetail as SparkSkillDetailDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Traits\SparkDetailRelationshipTrait;

class SparkSkillDetail extends BaseModel
{
    use SparkDetailRelationshipTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spark_details';

    public function toDomainEntity(): SparkSkillDetailDomainModel
    {
        $sparkSkillDetail = new SparkSkillDetailDomainModel(
            $this->spark_id,
            $this->spark_from_user_id,
        );
        $sparkSkillDetail->setId($this->getKey());

//        if ($this->relationLoaded('user')) {
//            $sparkSkillDetail->setUser($this->user?->toDomainEntity());
//        }


        return $sparkSkillDetail;
    }

    /**
     * @param SparkSkillDetailDomainModel $sparkSkillDetail
     * @return SparkSkillDetail
     */
    protected function fromDomainEntity($sparkSkillDetail)
    {
        $this->spark_id = $sparkSkillDetail->getSparkSkillId();
        $this->spark_from_user_id = $sparkSkillDetail->getSparkFromUserId();

        return $this;
    }

}

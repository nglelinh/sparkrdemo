<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao;

use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkill as SparkSkillDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Traits\SparkSkillRelationshipTrait;

class SparkSkill extends BaseModel
{
    use SparkSkillRelationshipTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sparks';

    protected $with = [
//        'skill',
//        'user'
//        'sparkDetails'
    ];

    public function toDomainEntity(): SparkSkillDomainModel
    {
        $sparkSkill = new SparkSkillDomainModel(
            $this->user_id,
            $this->skill_id,
            $this->spark_count,
            $this->user_create_id,
        );
        $sparkSkill->setId($this->getKey());

        if ($this->relationLoaded('skill')) {
            $sparkSkill->setSkill($this->skill?->toDomainEntity());
        }
        if ($this->relationLoaded('user')) {
            $sparkSkill->setUser($this->user?->toDomainEntity());
        }

        if ($this->relationLoaded('sparkDetails')) {
            $sparkSkill->setSparkDetails($this->sparkDetails?->map(function ($sparkDetails) {
                return $sparkDetails->toDomainEntity();
            }));
        }
        return $sparkSkill;
    }

    /**
     * @param SparkSkillDomainModel $sparkSkill
     * @return SparkSkill
     */
    protected function fromDomainEntity($sparkSkill)
    {
        $this->user_id = $sparkSkill->getUserId();
        $this->skill_id = $sparkSkill->getSkillId();
        $this->spark_count = $sparkSkill->getSparkSkillCount();
        $this->user_create_id = $sparkSkill->getUserCreateId();

        return $this;
    }

}

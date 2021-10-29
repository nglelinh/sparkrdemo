<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao;

use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkill as SparkSkillDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class SparkSkill extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spark_skill';

    public function toDomainEntity(): SparkSkillDomainModel
    {
        $sparkSkill = new SparkSkillDomainModel(
            $this->personal_profile_id,
            $this->skill_id,
            $this->spark_skill_count,
        );
        $sparkSkill->setId($this->getKey());

        return $sparkSkill;
    }

    /**
     * @param SparkSkillDomainModel $sparkSkill
     * @return SparkSkill
     */
    protected function fromDomainEntity($sparkSkill)
    {
        $this->personal_profile_id = $sparkSkill->getPersonalProfileId();
        $this->skill_id = $sparkSkill->getSkillId();
        $this->spark_skill_count = $sparkSkill->getSparkSkillCount();

        return $this;
    }

}

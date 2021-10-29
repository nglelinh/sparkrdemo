<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao;

use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkillDetail as SparkSkillDetailDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class SparkSkillDetail extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spark_skill_details';

    public function toDomainEntity(): SparkSkillDetailDomainModel
    {
        $sparkSkillDetail = new SparkSkillDetailDomainModel(
            $this->spark_skill_id,
            $this->company_profile_id,
        );
        $sparkSkillDetail->setId($this->getKey());

        return $sparkSkillDetail;
    }

    /**
     * @param SparkSkillDetailDomainModel $sparkSkillDetail
     * @return SparkSkillDetail
     */
    protected function fromDomainEntity($sparkSkillDetail)
    {
        $this->spark_skill_id = $sparkSkillDetail->getSparkSkillId();
        $this->company_profile_id = $sparkSkillDetail->getCompanyProfileId();

        return $this;
    }

}

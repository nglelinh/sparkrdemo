<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkTrait\ModelDao;

use Sparkr\Domain\SparkManagement\SparkTrait\Models\SparkTraitDetail as SparkTraitDetailDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class SparkTraitDetail extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spark_trait_details';

    public function toDomainEntity(): SparkTraitDetailDomainModel
    {
        $sparkTraitDetail = new SparkTraitDetailDomainModel(
            $this->spark_trait_id,
            $this->personal_profile_id,
        );
        $sparkTraitDetail->setId($this->getKey());

        return $sparkTraitDetail;
    }

    /**
     * @param SparkTraitDetailDomainModel $sparkTraitDetail
     * @return SparkTraitDetail
     */
    protected function fromDomainEntity($sparkTraitDetail)
    {
        $this->spark_trait_id = $sparkTraitDetail->getSparkTraitId();
        $this->personal_profile_id = $sparkTraitDetail->getPersonalProfileId();

        return $this;
    }

}

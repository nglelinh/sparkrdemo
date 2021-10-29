<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkTrait\ModelDao;

use Sparkr\Domain\SparkManagement\SparkTrait\Models\SparkTrait as SparkTraitDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class SparkTrait extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spark_trait';

    public function toDomainEntity(): SparkTraitDomainModel
    {
        $sparkTrait = new SparkTraitDomainModel(
            $this->company_profile_id,
            $this->trait_id,
            $this->spark_trait_count,
        );
        $sparkTrait->setId($this->getKey());

        return $sparkTrait;
    }

    /**
     * @param SparkTraitDomainModel $sparkTrait
     * @return SparkTrait
     */
    protected function fromDomainEntity($sparkTrait)
    {
        $this->company_profile_id = $sparkTrait->getCompanyProfileId();
        $this->trait_id = $sparkTrait->getTraitId();
        $this->spark_trait_count = $sparkTrait->getSparkTraitCount();

        return $this;
    }

}

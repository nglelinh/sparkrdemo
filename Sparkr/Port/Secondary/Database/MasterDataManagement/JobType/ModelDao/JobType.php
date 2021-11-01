<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\ModelDao;

use Sparkr\Domain\MasterDataManagement\JobType\Models\JobType as JobTypeDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class JobType extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_types';

    public function toDomainEntity(): JobTypeDomainModel
    {
        $category = new JobTypeDomainModel(
            $this->name,
        );
        $category->setId($this->getKey());

        return $category;
    }

    /**
     * @param JobTypeDomainModel $jobType
     * @return JobType
     */
    protected function fromDomainEntity($jobType)
    {
        $this->name = $jobType->getName();

        return $this;
    }

}

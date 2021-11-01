<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\Job\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\ModelDao\JobType;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\ModelDao\CompanyProfile;


trait JobRelationshipTrait
{

    /**
     * Get currency data
     *
     * @return mixed
     */
    public function companyProfile()
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }
}

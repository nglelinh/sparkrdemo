<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\Job\Traits;


use Sparkr\Port\Secondary\Database\JobManagement\JobApplyActivity\ModelDao\JobApplyActivity;
use Sparkr\Port\Secondary\Database\JobManagement\JobInterestedActivity\ModelDao\JobInterestedActivity;
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
    public function jobApplyActivities()
    {
        return $this->hasMany(JobApplyActivity::class);
    }
    public function jobInterestedActivities()
    {
        return $this->hasMany(JobInterestedActivity::class);
    }

}

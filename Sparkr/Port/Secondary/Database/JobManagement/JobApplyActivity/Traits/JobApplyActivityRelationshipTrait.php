<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\JobApplyActivity\Traits;


use Sparkr\Domain\JobManagement\Job\Models\Job;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;


trait JobApplyActivityRelationshipTrait
{

    /**
     * Get currency data
     *
     * @return mixed
     */
    public function personalProfile()
    {
        return $this->belongsTo(PersonalProfile::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}

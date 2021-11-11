<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\JobInterestedActivity\Traits;


use Sparkr\Domain\JobManagement\Job\Models\Job;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;


trait JobInterestedActivityRelationshipTrait
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

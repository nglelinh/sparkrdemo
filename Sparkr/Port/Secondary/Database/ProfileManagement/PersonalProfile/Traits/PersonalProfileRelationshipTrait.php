<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\ModelDao\JobType;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao\Skill;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


trait PersonalProfileRelationshipTrait
{

    /**
     * Get currency data
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

}

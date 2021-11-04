<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\ModelDao\JobType;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao\Skill;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


trait SparkSkillRelationshipTrait
{

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function personalProfile()
    {
        return $this->belongsTo(PersonalProfile::class, 'personal_profile_id');
    }


}

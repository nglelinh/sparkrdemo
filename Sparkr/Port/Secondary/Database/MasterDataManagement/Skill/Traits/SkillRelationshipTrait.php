<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Traits;


use Sparkr\Port\Secondary\Database\JobManagement\Job\ModelDao\Job;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkill;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


trait SkillRelationshipTrait
{
    public function sparkSkills()
    {
        return $this->hasMany(SparkSkill::class);
    }

}

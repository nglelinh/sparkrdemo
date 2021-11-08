<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\ModelDao\JobType;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao\Skill;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkillDetail;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


trait SparkSkillRelationshipTrait
{

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sparkDetails(){
        return $this->hasMany(SparkSkillDetail::class, 'spark_id');
    }

}

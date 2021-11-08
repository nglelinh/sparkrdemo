<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\JobType\ModelDao\JobType;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao\Skill;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkill;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


trait SparkDetailRelationshipTrait
{
    public function spark()
    {
        return $this->belongsTo(SparkSkill::class, 'spark_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'spark_from_user_id');
    }

}

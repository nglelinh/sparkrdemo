<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\User\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\Location\ModelDao\Location;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkill;
use Sparkr\Port\Secondary\Database\UserManagement\UserSocialLink\ModelDao\UserSocialLink;


trait UserRelationshipTrait
{

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function socialLinks()
    {
        return $this->hasMany(UserSocialLink::class);
    }
//    public function sparkSkills()
//    {
//        return $this->hasMany(SparkSkill::class);
//    }

}

<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\Location\ModelDao\Location;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkill;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;
use Sparkr\Port\Secondary\Database\UserManagement\UserSocialLink\ModelDao\UserSocialLink;


trait FollowerRelationshipTrait
{

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

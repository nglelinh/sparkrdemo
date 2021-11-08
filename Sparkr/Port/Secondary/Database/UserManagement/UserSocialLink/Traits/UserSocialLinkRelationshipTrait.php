<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserSocialLink\Traits;


use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


trait UserSocialLinkRelationshipTrait
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

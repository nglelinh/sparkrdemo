<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;
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

}

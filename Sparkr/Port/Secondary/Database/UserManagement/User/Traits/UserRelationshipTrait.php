<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\User\Traits;


use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


trait UserRelationshipTrait
{

    /**
     * Get currency data
     *
     * @return mixed
     */
    public function personalProfile()
    {
        return $this->hasOne(PersonalProfile::class);
    }
    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

}

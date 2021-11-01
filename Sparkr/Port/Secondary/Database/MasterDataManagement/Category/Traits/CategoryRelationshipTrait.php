<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Category\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\ModelDao\CompanyProfile;


trait CategoryRelationshipTrait
{

    /**
     * Get currency data
     *
     * @return mixed
     */
    public function category()
    {
        return $this->hasOne(CompanyProfile::class);
    }

}

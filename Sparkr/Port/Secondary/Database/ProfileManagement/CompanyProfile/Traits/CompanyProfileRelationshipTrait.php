<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;


trait CompanyProfileRelationshipTrait
{

    /**
     * Get currency data
     *
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

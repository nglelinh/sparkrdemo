<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Traits;


use Sparkr\Port\Secondary\Database\JobManagement\Job\ModelDao\Job;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;


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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}

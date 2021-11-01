<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\User\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\Location\ModelDao\Location;


trait UserRelationshipTrait
{

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}

<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Traits;

use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait SkillRelationshipTrait
{
    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

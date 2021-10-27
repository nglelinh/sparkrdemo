<?php


namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Traits;


use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Factory\SkillFactory;

trait HasFactory
{
    /**
     * Get a new factory instance for the model.
     *
     * @param mixed $parameters
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function factory(...$parameters)
    {
        return new SkillFactory();
    }
}

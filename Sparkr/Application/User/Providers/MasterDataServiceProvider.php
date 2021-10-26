<?php

namespace Sparkr\Application\User\Providers;


use Illuminate\Support\ServiceProvider;
use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Repository\EloquentSkillRepository;

class MasterDataServiceProvider extends ServiceProvider
{
    public function register()
    {

        // Repository
        $this->app->bind(SkillRepositoryInterface::class, EloquentSkillRepository::class);
    }
}

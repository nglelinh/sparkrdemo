<?php

namespace Sparkr\Application\User\Providers;


use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\UserManagement\UserFollowing\Interfaces\UserFollowingRepositoryInterface;
use Sparkr\Domain\UserManagement\UserSocialLink\Interfaces\UserSocialLinkRepositoryInterface;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Repository\CompanyProfileRepository;
use Sparkr\Port\Secondary\Database\UserManagement\User\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Port\Secondary\Database\UserManagement\UserFollowing\Repository\UserFollowingRepository;
use Sparkr\Port\Secondary\Database\UserManagement\UserSocialLink\Repository\UserSocialLinkRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Application Service

        //  Repository
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserFollowingRepositoryInterface::class,UserFollowingRepository::class);
        $this->app->bind(UserSocialLinkRepositoryInterface::class,UserSocialLinkRepository::class);

//        register on the same provider, split into individual service provider later
        $this->app->bind(CompanyProfileRepositoryInterface::class,CompanyProfileRepository::class);

    }
}

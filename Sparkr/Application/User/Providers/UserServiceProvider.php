<?php

namespace Sparkr\Application\User\Providers;


use Sparkr\Domain\JobManagement\Job\Interfaces\JobRepositoryInterface;
use Sparkr\Domain\JobManagement\JobApplyActivity\Interfaces\JobApplyActivityRepositoryInterface;
use Sparkr\Domain\JobManagement\JobInterestedActivity\Interfaces\JobInterestedActivityRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Category\Interfaces\CategoryRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\JobType\Interfaces\JobTypeRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;
use Sparkr\Domain\NotificationManagement\Notification\Interfaces\NotificationRepositoryInterface;
use Sparkr\Domain\NotificationManagement\UserNotification\Interfaces\UserNotificationRepositoryInterface;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\JobHistory\Interfaces\JobHistoryRepositoryInterface;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillDetailRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;
use Sparkr\Domain\UserManagement\UserFollowing\Interfaces\UserFollowingRepositoryInterface;
use Sparkr\Domain\UserManagement\UserSocialLink\Interfaces\UserSocialLinkRepositoryInterface;
use Sparkr\Port\Secondary\Database\JobManagement\Job\Repository\JobRepository;
use Sparkr\Port\Secondary\Database\JobManagement\JobApplyActivity\Repository\JobApplyActivityRepository;
use Sparkr\Port\Secondary\Database\JobManagement\JobInterestedActivity\Repository\JobInterestedActivityRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\Repository\CategoryRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Repository\SkillRepository;
use Sparkr\Port\Secondary\Database\NotificationManagement\Notification\Repository\NotificationRepository;
use Sparkr\Port\Secondary\Database\NotificationManagement\UserNotification\Repository\UserNotificationRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Repository\CompanyProfileRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\JobHistory\Repository\JobHistoryRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\Repository\PersonalProfileRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Repository\SparkSkillDetailRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Repository\SparkSkillRepository;
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
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);

        $this->app->bind(JobRepositoryInterface::class,JobRepository::class);
        $this->app->bind(JobApplyActivityRepositoryInterface::class,JobApplyActivityRepository::class);
        $this->app->bind(JobInterestedActivityRepositoryInterface::class,JobInterestedActivityRepository::class);
        $this->app->bind(JobTypeRepositoryInterface::class,SkillRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class,NotificationRepository::class);
        $this->app->bind(UserNotificationRepositoryInterface::class,UserNotificationRepository::class);
        $this->app->bind(CompanyProfileRepositoryInterface::class,CompanyProfileRepository::class);
        $this->app->bind(JobHistoryRepositoryInterface::class,JobHistoryRepository::class);
        $this->app->bind(PersonalProfileRepositoryInterface::class,PersonalProfileRepository::class);
        $this->app->bind(SparkSkillDetailRepositoryInterface::class,SparkSkillDetailRepository::class);
        $this->app->bind(SparkSkillRepositoryInterface::class,SparkSkillRepository::class);
        $this->app->bind(SkillRepositoryInterface::class,SkillRepository::class);
        //        $this->app->bind(JobTypeRepositoryInterface,);
        //        $this->app->bind(LocationRepositoryInterface,);

    }
}

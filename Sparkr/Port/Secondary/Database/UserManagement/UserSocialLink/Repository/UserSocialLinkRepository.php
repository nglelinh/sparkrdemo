<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserSocialLink\Repository;


use Sparkr\Domain\UserManagement\UserSocialLink\Interfaces\UserSocialLinkRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\UserManagement\UserSocialLink\ModelDao\UserSocialLink as UserSocialLinkDao;

class UserSocialLinkRepository extends EloquentBaseRepository implements UserSocialLinkRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param UserSocialLinkDao $model
     */
    public function __construct(UserSocialLinkDao $model)
    {
        parent::__construct($model);
    }

}

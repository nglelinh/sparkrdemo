<?php

namespace Sparkr\Port\Secondary\Database\NotificationManagement\UserNotification\Repository;


use Sparkr\Domain\NotificationManagement\UserNotification\Interfaces\UserNotificationRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\NotificationManagement\UserNotification\ModelDao\UserNotification as NotificationDao;

class UserNotificationRepository extends EloquentBaseRepository implements UserNotificationRepositoryInterface
{

    /**
     * NotificationRepository constructor.
     * @param NotificationDao $model
     */
    public function __construct(NotificationDao $model)
    {
        parent::__construct($model);
    }

}

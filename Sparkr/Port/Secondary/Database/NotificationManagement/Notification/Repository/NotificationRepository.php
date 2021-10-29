<?php

namespace Sparkr\Port\Secondary\Database\NotificationManagement\Notification\Repository;


use Sparkr\Domain\NotificationManagement\Notification\Interfaces\NotificationRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\NotificationManagement\Notification\ModelDao\Notification as NotificationDao;

class NotificationRepository extends EloquentBaseRepository implements NotificationRepositoryInterface
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

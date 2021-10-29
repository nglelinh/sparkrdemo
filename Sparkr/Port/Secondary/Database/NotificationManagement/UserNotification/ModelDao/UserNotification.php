<?php

namespace Sparkr\Port\Secondary\Database\NotificationManagement\UserNotification\ModelDao;

use Carbon\Carbon;
use Sparkr\Domain\NotificationManagement\UserNotification\Models\UserNotification as UserNotificationDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class UserNotification extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_notification';

    public function toDomainEntity(): UserNotificationDomainModel
    {
        $userNotification = new UserNotificationDomainModel(
            $this->user_id,
            $this->notification_id,
            Carbon::make($this->is_read),
        );
        $userNotification->setId($this->getKey());

        return $userNotification;
    }

    /**
     * @param UserNotificationDomainModel $userNotification
     * @return UserNotification
     */
    protected function fromDomainEntity($userNotification)
    {
        $this->user_id = $userNotification->getUserId();
        $this->notification_id = $userNotification->getNotificationId();
        $this->is_read = $userNotification->getIsRead();

        return $this;
    }

}

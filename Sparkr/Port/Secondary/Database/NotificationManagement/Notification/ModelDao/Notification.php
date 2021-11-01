<?php

namespace Sparkr\Port\Secondary\Database\NotificationManagement\Notification\ModelDao;

use Sparkr\Domain\NotificationManagement\Notification\Models\Notification as NotificationDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class Notification extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    public function toDomainEntity(): NotificationDomainModel
    {
        $notification = new NotificationDomainModel(
            $this->title,
            $this->type,
            $this->content,
            $this->variables,
            $this->status,
        );
        $notification->setId($this->getKey());

        return $notification;
    }

    /**
     * @param NotificationDomainModel $notification
     * @return Notification
     */
    protected function fromDomainEntity($notification)
    {
        $this->type = $notification->getType();
        $this->title = $notification->getTitle();
        $this->content = $notification->getContent();
        $this->variables = $notification->getVariables();
        $this->status = $notification->getStatus();

        return $this;
    }

}

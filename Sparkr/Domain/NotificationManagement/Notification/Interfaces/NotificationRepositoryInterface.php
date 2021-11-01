<?php

namespace Sparkr\Domain\NotificationManagement\Notification\Interfaces;


use Sparkr\Domain\NotificationManagement\Notification\Models\Notification;

interface NotificationRepositoryInterface
{
    /**
     */
    public function getAllNotification();

    /**
     */
    public function getById(int $id): Notification;

    /**
     */
    public function save(Notification $notification);

    /**
     */
    public function delete(int $id);


}

<?php

namespace Sparkr\Domain\NotificationManagement\Notification\Interfaces;


interface NotificationRepositoryInterface
{
    /**
     */
    public function getAllNotification();

    /**
     */
    public function getById(int $id);

    /**
     */
    public function save(Notification $notification);

    /**
     */
    public function delete(int $id);


}

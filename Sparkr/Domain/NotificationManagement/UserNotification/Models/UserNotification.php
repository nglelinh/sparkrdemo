<?php

namespace Sparkr\Domain\NotificationManagement\UserNotification\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class UserNotification extends BaseDomainModel
{
    private string $userId;

    private string $notificationId;

    private ?string $isRead;

    /**
     * UserNotification constructor.
     * @param  string  $userId
     * @param  string  $notificationId
     * @param  string|null  $isRead
     */
    public function __construct(string $userId, string $notificationId, ?string $isRead)
    {
        $this->userId = $userId;
        $this->notificationId = $notificationId;
        $this->isRead = $isRead;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param  string  $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getNotificationId(): string
    {
        return $this->notificationId;
    }

    /**
     * @param  string  $notificationId
     */
    public function setNotificationId(string $notificationId): void
    {
        $this->notificationId = $notificationId;
    }

    /**
     * @return string|null
     */
    public function getIsRead(): ?string
    {
        return $this->isRead;
    }

    /**
     * @param  string|null  $isRead
     */
    public function setIsRead(?string $isRead): void
    {
        $this->isRead = $isRead;
    }

}

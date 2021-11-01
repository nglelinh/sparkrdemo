<?php

namespace Sparkr\Port\Secondary\Database\NotificationManagement\Notification\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\NotificationManagement\Notification\Models\Notification;
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

    /**
     */
    public function getAllNotification(): Collection
    {
        return $this->getAll();
    }

    /**
     */
    public function getById(int $id): Notification
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.category_not_found'));
    }

    public function save(Notification $notification): Notification
    {
        return $this->createModelDAO($notification->getId())->saveData($notification);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}

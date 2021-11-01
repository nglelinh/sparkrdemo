<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\NotificationManagement\Notification\Interfaces\NotificationRepositoryInterface;
use Sparkr\Domain\NotificationManagement\Notification\Models\Notification;
use Illuminate\Http\Response;

class AdminNotificationService
{
    /**
     * @var NotificationRepositoryInterface
     */
    private $notificationRepository;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $data = [];

    /**
     */
    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->notificationRepository->getAllNotification()->transform(function (Notification $notification) {
            return [
                'id' => $notification->getId(),
                'title' => $notification->getTitle(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $notification = new Notification($param['title']);
        $this->notificationRepository->save($notification);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $notification = $this->notificationRepository->getById($id);
        $notification->setTitle($param['title']);

        $this->notificationRepository->save($notification);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->notificationRepository->delete($id);

        return $this->handleApiResponse();
    }

    /**
     * Format response data
     *
     * @return array
     */
    public function handleApiResponse(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}

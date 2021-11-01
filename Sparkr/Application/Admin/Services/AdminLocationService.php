<?php

namespace Sparkr\Application\Admin\Services;

use Sparkr\Domain\MasterDataManagement\Location\Interfaces\LocationRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Location\Models\Location;
use Illuminate\Http\Response;

class AdminLocationService
{
    /**
     * @var LocationRepositoryInterface
     */
    private $locationRepository;

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
    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
    }

    /**
     */
    public function index(): array
    {
        $this->data =  $this->locationRepository->getAllLocation()->transform(function (Location $location) {
            return [
                'id' => $location->getId(),
                'name' => $location->getName(),
            ];
        })->toArray();
        return $this->handleApiResponse();
    }

    /**
     */
    public function create(array $param): array
    {
        $location = new Location($param['name']);
        $this->locationRepository->save($location);

        return $this->handleApiResponse();
    }

    /**
     */
    public function update(int $id, array $param): array
    {

        $location = $this->locationRepository->getById($id);
        $location->setName($param['name']);

        $this->locationRepository->save($location);

        return $this->handleApiResponse();
    }

    /**
     */
    public function delete(int $id): array
    {
        $this->locationRepository->delete($id);

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

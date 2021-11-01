<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Location\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\MasterDataManagement\Location\Interfaces\LocationRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Location\Models\Location;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Location\ModelDao\Location as LocationDao;

class LocationRepository extends EloquentBaseRepository implements LocationRepositoryInterface
{

    /**
     * LocationRepository constructor.
     * @param LocationDao $model
     */
    public function __construct(LocationDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllLocation(): Collection
    {
        return $this->getAll();
    }

    /**
     */
    public function getById(int $id): Location
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.category_not_found'));
    }

    public function save(Location $location): Location
    {
        return $this->createModelDAO($location->getId())->saveData($location);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}

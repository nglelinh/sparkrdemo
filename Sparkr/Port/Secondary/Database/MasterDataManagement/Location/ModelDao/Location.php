<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Location\ModelDao;

use Sparkr\Domain\MasterDataManagement\Location\Models\Location as LocationDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class Location extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locations';

    public function toDomainEntity(): LocationDomainModel
    {
        $location = new LocationDomainModel(
            $this->name,
        );
        $location->setId($this->getKey());

        return $location;
    }

    /**
     * @param LocationDomainModel $location
     * @return Location
     */
    protected function fromDomainEntity($location)
    {
        $this->name = $location->getName();

        return $this;
    }

}

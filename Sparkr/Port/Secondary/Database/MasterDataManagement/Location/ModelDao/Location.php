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
        $category = new LocationDomainModel(
            $this->name,
        );
        $category->setId($this->getKey());

        return $category;
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

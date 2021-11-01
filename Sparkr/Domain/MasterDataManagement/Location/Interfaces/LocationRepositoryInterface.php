<?php

namespace Sparkr\Domain\MasterDataManagement\Location\Interfaces;


use Sparkr\Domain\MasterDataManagement\Location\Models\Location;

interface LocationRepositoryInterface
{
    /**
     */
    public function getAllLocation();

    /**
     */
    public function getById(int $id);

    /**
     */
    public function save(Location $location);

    /**
     */
    public function delete(int $id);


}

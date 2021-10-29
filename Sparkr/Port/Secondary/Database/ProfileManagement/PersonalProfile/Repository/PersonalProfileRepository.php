<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\Repository;


use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile as PersonalProfileDao;

class PersonalProfileRepository extends EloquentBaseRepository implements PersonalProfileRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param PersonalProfileDao $model
     */
    public function __construct(PersonalProfileDao $model)
    {
        parent::__construct($model);
    }

}

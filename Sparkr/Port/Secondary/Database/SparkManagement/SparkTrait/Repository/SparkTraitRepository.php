<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkTrait\Repository;


use Sparkr\Domain\SparkManagement\SparkTrait\Interfaces\SparkTraitRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkTrait\ModelDao\SparkTrait as SparkTraitDao;

class SparkTraitRepository extends EloquentBaseRepository implements SparkTraitRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param SparkTraitDao $model
     */
    public function __construct(SparkTraitDao $model)
    {
        parent::__construct($model);
    }

}

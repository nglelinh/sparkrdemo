<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkTrait\Repository;


use Sparkr\Domain\SparkManagement\SparkTrait\Interfaces\SparkTraitDetailRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkTrait\ModelDao\SparkTraitDetail as SparkTraitDetailDao;

class SparkTraitDetailRepository extends EloquentBaseRepository implements SparkTraitDetailRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param SparkTraitDetailDao $model
     */
    public function __construct(SparkTraitDetailDao $model)
    {
        parent::__construct($model);
    }

}

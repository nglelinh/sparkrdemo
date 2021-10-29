<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Category\Repository;


use Sparkr\Domain\MasterDataManagement\Category\Interfaces\CategoryRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category as CategoryDao;

class CategoryRepository extends EloquentBaseRepository implements CategoryRepositoryInterface
{

    /**
     * CategoryRepository constructor.
     * @param CategoryDao $model
     */
    public function __construct(CategoryDao $model)
    {
        parent::__construct($model);
    }

}

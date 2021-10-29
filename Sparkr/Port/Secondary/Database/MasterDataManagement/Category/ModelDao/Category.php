<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao;

use Sparkr\Domain\MasterDataManagement\Category\Models\Category as CategoryDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\Traits\CategoryProfileRelationshipTrait;

class Category extends BaseModel
{
    use CategoryProfileRelationshipTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    public function toDomainEntity(): CategoryDomainModel
    {
        $category = new CategoryDomainModel(
            $this->name,
        );
        $category->setId($this->getKey());

        return $category;
    }

    /**
     * @param CategoryDomainModel $category
     * @return Category
     */
    protected function fromDomainEntity($category)
    {
        $this->name = $category->getName();

        return $this;
    }

}

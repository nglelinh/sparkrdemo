<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Category\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\MasterDataManagement\Category\Interfaces\CategoryRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Category\Models\Category;
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

    /**
     */
    public function getAllCategory(): Collection
    {
        return $this->getAll();
    }

    /**
     */
    public function getById(int $id): Category
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.category_not_found'));
    }

    public function save(Category $category): Category
    {
        return $this->createModelDAO($category->getId())->saveData($category);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}

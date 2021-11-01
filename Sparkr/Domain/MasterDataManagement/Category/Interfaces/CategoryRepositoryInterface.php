<?php

namespace Sparkr\Domain\MasterDataManagement\Category\Interfaces;


use Sparkr\Domain\MasterDataManagement\Category\Models\Category;

interface CategoryRepositoryInterface
{
    /**
     */
    public function getAllCategory();

    /**
     */
    public function getByName(string $name = "");

    /**
     */
    public function getById(int $id);

    /**
     */
    public function save(Category $category);

    /**
     */
    public function delete(int $id);


}

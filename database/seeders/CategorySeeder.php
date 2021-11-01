<?php

namespace Database\Seeders;


use Illuminate\Contracts\Container\BindingResolutionException;
use Sparkr\Domain\MasterDataManagement\Category\Interfaces\CategoryRepositoryInterface;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private CategoryRepositoryInterface $categoryRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [
                'name' => 'Hotel',
            ],
            [
                'name' => 'Cafe',
            ],
            [
                'name' => 'Tourism',
            ],
        ];

        foreach ($seeds as $data) {
            $this->categoryRepository->firstOrCreate($data);
        }
    }

}

<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\MasterDataManagement\Category\Interfaces\CategoryRepositoryInterface;

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
            ['name' => 'Hotel',],
            ['name' => 'Tourism',],
            ['name' => 'Cafe/Bar',],
        ];

        foreach ($seeds as $data) {
            $this->categoryRepository->firstOrCreate($data);
        }
    }

}

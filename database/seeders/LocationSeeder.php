<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\MasterDataManagement\Category\Interfaces\CategoryRepositoryInterface;

class LocationSeeder extends Seeder
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
            ['name' => 'Tokyo',],
            ['name' => 'Osaka',],
            ['name' => 'Kyoto',],
        ];

        foreach ($seeds as $data) {
            $this->categoryRepository->firstOrCreate($data);
        }
    }

}

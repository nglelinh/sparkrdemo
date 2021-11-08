<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;

class SkillSeeder extends Seeder
{
    private SkillRepositoryInterface $skillRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(SkillRepositoryInterface $skillRepository)
    {
        $this->skillRepository = $skillRepository;
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
                'name' => 'a',
            ],
            [
                'name' => 'b',
            ],

        ];

        foreach ($seeds as $data) {
            $this->skillRepository->firstOrCreate($data);
        }
    }

}

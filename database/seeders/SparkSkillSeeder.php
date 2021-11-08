<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;

class SparkSkillSeeder extends Seeder
{
    private SparkSkillRepositoryInterface $sparkSkillRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(SparkSkillRepositoryInterface $sparkSkillRepository)
    {
        $this->sparkSkillRepository = $sparkSkillRepository;
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
                'user_id' => '1',
                'skill_id' => '2',
                'spark_count' => '1',
            ],
            [
                'user_id' => '1',
                'skill_id' => '1',
                'spark_count' => '3',
            ],
            [
                'user_id' => '2',
                'skill_id' => '1',
                'spark_count' => '2',
            ],
        ];

        foreach ($seeds as $data) {
            $this->sparkSkillRepository->firstOrCreate($data);
        }
    }

}

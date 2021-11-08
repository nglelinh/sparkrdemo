<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\MasterDataManagement\JobType\Interfaces\JobTypeRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;

class JobTypeSeeder extends Seeder
{
    private JobTypeRepositoryInterface $jobTypeRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(JobTypeRepositoryInterface $jobTypeRepository)
    {
        $this->jobTypeRepository = $jobTypeRepository;
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
            $this->jobTypeRepository->firstOrCreate($data);
        }
    }

}

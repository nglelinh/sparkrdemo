<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;

class PersonalProfileSeeder extends Seeder
{
    private PersonalProfileRepositoryInterface $personalProfileRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(PersonalProfileRepositoryInterface $personalProfileRepository)
    {
        $this->personalProfileRepository = $personalProfileRepository;
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
                'about' => 'abc xyz',
                'desired_position' => 'Manager',
                'current_position' => 'Senior',
                'education' => 'a',
                'job_type_id' => '1',
                'availability' => '1',
            ],
            [
                'user_id' => '2',
                'about' => 'y and m',
                'desired_position' => 'Junior Position',
                'current_position' => 'Junior',
                'education' => 'a',
                'job_type_id' => '1',
                'availability' => '2',
            ]
        ];

        foreach ($seeds as $data) {
            $this->personalProfileRepository->firstOrCreate($data);
        }
    }

}

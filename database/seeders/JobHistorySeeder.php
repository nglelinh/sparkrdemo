<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Sparkr\Domain\ProfileManagement\JobHistory\Interfaces\JobHistoryRepositoryInterface;

class JobHistorySeeder extends Seeder
{
    private JobHistoryRepositoryInterface $jobHistoryRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(JobHistoryRepositoryInterface $jobHistoryRepository)
    {
        $this->jobHistoryRepository = $jobHistoryRepository;
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
                'personal_profile_id' => '2',
                'title' => 'Title1',
                'company_name' => 'Company Name1',
                'start_date' => Carbon::yesterday()->subHours(),
                'end_date' => Carbon::now()->subHours(),
                'description' => 'abc',
                'job_type_id' => '1',
                'availability' => '1',
            ],
            [
                'personal_profile_id' => '2',
                'title' => 'Title2',
                'company_name' => 'Company Name2',
                'start_date' => Carbon::yesterday()->subHours(2),
                'end_date' => Carbon::now()->subHours(2),
                'description' => 'abc2',
                'job_type_id' => '1',
                'availability' => '1',
            ],
            [
                'personal_profile_id' => '2',
                'title' => 'Title3',
                'company_name' => 'Company Name3',
                'start_date' => Carbon::yesterday()->subHours(3),
                'end_date' => Carbon::now()->subHours(3),
                'description' => 'abc3',
                'job_type_id' => '1',
                'availability' => '1',
            ],
            [
                'personal_profile_id' => '2',
                'title' => 'Title4',
                'company_name' => 'Company Name4',
                'start_date' => Carbon::yesterday(),
                'end_date' => Carbon::now(),
                'description' => 'abc4',
                'job_type_id' => '1',
                'availability' => '1',
            ],
            [
                'personal_profile_id' => '1',
                'title' => 'Title1',
                'company_name' => 'Company Name1',
                'start_date' => Carbon::yesterday(),
                'end_date' => Carbon::now(),
                'description' => 'abc1',
                'job_type_id' => '1',
                'availability' => '1',
            ],
            [
                'personal_profile_id' => '1',
                'title' => 'Title2',
                'company_name' => 'Company Name2',
                'start_date' => Carbon::yesterday()->subHours(),
                'end_date' => Carbon::now()->subHours(),
                'description' => 'abc2',
                'job_type_id' => '1',
                'availability' => '1',
            ],
            [
                'personal_profile_id' => '1',
                'title' => 'Title3',
                'company_name' => 'Company Name3',
                'start_date' => Carbon::yesterday()->subHours(2),
                'end_date' => Carbon::now()->subHours(2),
                'description' => 'abc3',
                'job_type_id' => '1',
                'availability' => '1',
            ],


        ];

        foreach ($seeds as $data) {
            $this->jobHistoryRepository->firstOrCreate($data);
        }
    }

}

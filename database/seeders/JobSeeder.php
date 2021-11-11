<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\JobManagement\Job\Interfaces\JobRepositoryInterface;
use Sparkr\Domain\JobManagement\JobApplyActivity\Interfaces\JobApplyActivityRepositoryInterface;
use Sparkr\Domain\JobManagement\JobInterestedActivity\Interfaces\JobInterestedActivityRepositoryInterface;
use Sparkr\Utility\Enums\Status;

class JobSeeder extends Seeder
{
    private JobRepositoryInterface $jobRepository;
    private JobApplyActivityRepositoryInterface $jobApplyRepository;
    private JobInterestedActivityRepositoryInterface $jobInterestedRepository;
    /**
     * LanguageSeeder constructor.
     */
    public function __construct(JobRepositoryInterface $jobRepository,
    JobApplyActivityRepositoryInterface $jobApplyRepository,
    JobInterestedActivityRepositoryInterface $jobInterestedRepository
    )
    {
        $this->jobRepository = $jobRepository;
        $this->jobApplyRepository = $jobApplyRepository;
        $this->jobInterestedRepository = $jobInterestedRepository;
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
                'title' => 'Executive Chef',
                'company_profile_id' => '1',
                'description' => 'abc',
                'job_type_id' => 1,
                'availability' => 1,
                'status' => Status::Active,
            ],
            [
                'title' => 'Half Staff',
                'company_profile_id' => '1',
                'description' => 'abc',
                'job_type_id' => 2,
                'availability' => 1,
                'status' => Status::Active,
            ],
            [
                'title' => 'Half Staff 2',
                'company_profile_id' => '1',
                'description' => 'abc',
                'job_type_id' => 1,
                'availability' => 1,
                'status' => Status::Inactive,
            ],
            [
                'title' => 'Event Planner',
                'company_profile_id' => '2',
                'description' => 'abc',
                'job_type_id' => 2,
                'availability' => 1,
                'status' => Status::Active,
            ],
            [
                'title' => 'Porter',
                'company_profile_id' => '2',
                'description' => 'abc',
                'job_type_id' => 2,
                'availability' => 1,
                'status' => Status::Active,
            ]
        ];

        $applySeeds = [
            [
                'personal_profile_id' => 1,
                'job_id' => 1
            ],
            [
                'personal_profile_id' => 1,
                'job_id' => 2
            ],
            [
                'personal_profile_id' => 2,
                'job_id' => 2
            ],
        ];
        $interestedSeeds = [
            [
                'personal_profile_id' => 1,
                'job_id' => 1
            ],
            [
                'personal_profile_id' => 1,
                'job_id' => 2
            ],
            [
                'personal_profile_id' => 2,
                'job_id' => 2
            ],
        ];

        foreach ($seeds as $data) {
            $this->jobRepository->firstOrCreate($data);
        }
        foreach ($applySeeds as $data) {
            $this->jobApplyRepository->firstOrCreate($data);
        }
        foreach ($interestedSeeds as $data) {
            $this->jobInterestedRepository->firstOrCreate($data);
        }
    }

}

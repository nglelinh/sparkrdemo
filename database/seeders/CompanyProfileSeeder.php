<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;

class CompanyProfileSeeder extends Seeder
{
    private CompanyProfileRepositoryInterface $companyProfileRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(CompanyProfileRepositoryInterface $companyProfileRepository)
    {
        $this->companyProfileRepository = $companyProfileRepository;
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
                'user_id' => '3',
                'phone' => '01234',
                'company_website_url' => 'abc.com',
                'employee_benefits' => 'Social Insurance',
                'category_id' => 1,
            ],
            [
                'user_id' => '4',
                'phone' => '01234',
                'company_website_url' => 'xyz.com',
                'employee_benefits' => 'Bonus',
                'category_id' => 1,
            ]
        ];

        foreach ($seeds as $data) {
            $this->companyProfileRepository->firstOrCreate($data);
        }
    }

}

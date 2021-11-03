<?php

namespace Database\Seeders;


use Illuminate\Contracts\Container\BindingResolutionException;
use Sparkr\Domain\UserManagement\User\Interfaces\UserRepositoryInterface;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private UserRepositoryInterface $userRepository;

    /**
     * LanguageSeeder constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
                'name' => 'User candidate1',
                'user_type' => '1',
                'spark_count' => '50',
                'email' => 'candidate1@gmail.com',
                'password' => bcrypt('password'),
                'experience_level' => '1',
            ],
            [
                'name' => 'User candidate2',
                'user_type' => '1',
                'spark_count' => '70',
                'email' => 'candidate2@gmail.com',
                'password' => bcrypt('password'),
                'experience_level' => '2',
            ],
            [
                'name' => 'User company1',
                'user_type' => '2',
                'spark_count' => '50',
                'email' => 'company1@gmail.com',
                'password' => bcrypt('password'),
                'experience_level' => '1',
            ],
            [
                'name' => 'User company2',
                'user_type' => '2',
                'spark_count' => '70',
                'email' => 'company2@gmail.com',
                'password' => bcrypt('password'),
                'experience_level' => '2',
            ],
        ];

        foreach ($seeds as $data) {
            $this->userRepository->firstOrCreate($data);
        }
    }

}

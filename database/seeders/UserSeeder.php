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
                'email' => 'company@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        ];

        foreach ($seeds as $data) {
            $this->userRepository->firstOrCreate($data);
        }
    }

}

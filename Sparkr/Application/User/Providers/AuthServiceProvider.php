<?php

namespace Sparkr\Application\User\Providers;


use Illuminate\Support\ServiceProvider;
use Sparkr\Domain\Auth\ResetPassword\Interfaces\PasswordResetRepositoryInterface;
use Sparkr\Port\Secondary\Database\Auth\PasswordReset\Repository\PasswordResetRepository;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Application Service
        $this->app->bind(PasswordResetRepositoryInterface::class, PasswordResetRepository::class);
    }
}

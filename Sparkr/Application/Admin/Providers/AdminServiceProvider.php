<?php

namespace Sparkr\Application\Admin\Providers;

use Sparkr\Domain\Base\Admin\Services\AdminRepository;
use Sparkr\Domain\Base\Admin\Services\Interfaces\AdminInterface;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register Admin services.
     */
    public function register()
    {
//        Admin services in Application and Domain
        $this->app->bind(AdminInterface::class, AdminRepository::class);

    }
}

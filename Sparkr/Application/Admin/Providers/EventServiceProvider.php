<?php

namespace Sparkr\Application\Admin\Providers;

use Sparkr\Application\Admin\EventHandler\Registers\AdminUserManagementEventRegister;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->register(AdminUserManagementEventRegister::class);
    }
}

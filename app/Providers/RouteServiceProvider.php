<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = '';

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->configureRateLimiting();

        $this->mapApiRoutes();

        $this->mapAdminRoutes();

        $this->mapPublicRoutes();

        //
    }

    /**
     * Configures rate limiters for the application
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function () {
            return Limit::perMinute(100);
        });
        RateLimiter::for('web', function () {
            return Limit::perMinute(600);
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->namespace($this->namespace)
            ->group(base_path('Sparkr/Port/Primary/WebApi/routes/admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('Sparkr/Port/Primary/WebApi/routes/api.php'));
    }

    /**
     * Define the "guest" routes for the application.
     *
     * These routes all receive session state
     *
     * @return void
     */
    protected function mapPublicRoutes()
    {
        Route::namespace($this->namespace)
            ->group(base_path('Sparkr/Port/Primary/WebApi/routes/guest.php'));
    }
}

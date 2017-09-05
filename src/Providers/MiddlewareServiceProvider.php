<?php namespace Tukecx\Base\ACL\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Tukecx\Base\ACL\Http\Middleware\HasPermission;
use Tukecx\Base\ACL\Http\Middleware\HasRole;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * @var  Router $router
         */
        $router = $this->app['router'];

        $router->aliasMiddleware('has-role', HasRole::class);
        $router->aliasMiddleware('has-permission', HasPermission::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}

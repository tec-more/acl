<?php namespace Tukecx\Base\ACL\Providers;

use Illuminate\Support\ServiceProvider;
use Tukecx\Base\ACL\Models\Permission;
use Tukecx\Base\ACL\Models\Role;
use Tukecx\Base\ACL\Repositories\Contracts\PermissionRepositoryContract;
use Tukecx\Base\ACL\Repositories\Contracts\RoleRepositoryContract;
use Tukecx\Base\ACL\Repositories\PermissionRepository;
use Tukecx\Base\ACL\Repositories\PermissionRepositoryCacheDecorator;
use Tukecx\Base\ACL\Repositories\RoleRepository;
use Tukecx\Base\ACL\Repositories\RoleRepositoryCacheDecorator;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleRepositoryContract::class, function () {
            $repository = new RoleRepository(new Role);

            if (config('tukecx-caching.repository.enabled')) {
                return new RoleRepositoryCacheDecorator($repository);
            }

            return $repository;
        });
        $this->app->bind(PermissionRepositoryContract::class, function () {
            $repository = new PermissionRepository(new Permission);

            if (config('tukecx-caching.repository.enabled')) {
                return new PermissionRepositoryCacheDecorator($repository);
            }

            return $repository;
        });
    }
}

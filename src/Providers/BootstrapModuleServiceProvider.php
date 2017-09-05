<?php namespace Tukecx\Base\ACL\Providers;

use Illuminate\Support\ServiceProvider;

class BootstrapModuleServiceProvider extends ServiceProvider
{
    protected $module = 'Tukecx\Base\ACL';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $this->booted();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    private function booted()
    {
        /**
         * Register to dashboard menu
         */
        \DashboardMenu::registerItem([
            'id' => 'tukecx-acl-roles',
            'priority' => 3.1,
            'parent_id' => null,
            'heading' => null,
            'title' => '角色',
            'font_icon' => 'icon-lock',
            'link' => route('admin::acl-roles.index.get'),
            'css_class' => null,
            'permissions' => ['view-roles'],
        ])->registerItem([
            'id' => 'tukecx-acl-permissions',
            'priority' => 3.2,
            'parent_id' => null,
            'heading' => null,
            'title' => '权限',
            'font_icon' => 'icon-shield',
            'link' => route('admin::acl-permissions.index.get'),
            'css_class' => null,
            'permissions' => ['view-permissions'],
        ]);
    }
}

<?php namespace Tukecx\Base\ACL\Repositories;

use Tukecx\Base\ACL\Repositories\Contracts\PermissionRepositoryContract;
use Tukecx\Base\Caching\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

class PermissionRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements PermissionRepositoryContract
{
    /**
     * Register permission
     * @param $name
     * @param $alias
     * @param $module
     * @param bool $withEvent
     * @param bool $force
     * @return array|\Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    public function registerPermission($name, $alias, $module, $withEvent = true, $force = true)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param string|array $alias
     * @param bool $withEvent
     * @param bool $force
     * @return array|\Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    public function unsetPermission($alias, $withEvent = true, $force = true)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param string|array $module
     * @param bool $withEvent
     * @param bool $force
     * @return array|\Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    public function unsetPermissionByModule($module, $withEvent = true, $force = true)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}

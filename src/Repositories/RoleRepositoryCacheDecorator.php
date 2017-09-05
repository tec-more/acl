<?php namespace Tukecx\Base\ACL\Repositories;

use Tukecx\Base\ACL\Repositories\Contracts\RoleRepositoryContract;
use Tukecx\Base\Caching\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

class RoleRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements RoleRepositoryContract
{
    /**
     * @param array|int $id
     * @param bool $withEvent
     * @return array
     */
    public function deleteRole($id, $withEvent = true)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $data
     * @param bool $withEvent
     * @return array
     */
    public function createRole($data, $withEvent = true)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int $id
     * @param array $data
     * @param bool $withEvent
     * @return array
     */
    public function updateRole($id, $data, $withEvent = true)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param \Tukecx\Base\ACL\Models\Role $model
     * @param \Illuminate\Database\Eloquent\Collection|array $data
     */
    public function syncPermissions($model, $data)
    {
        $result = call_user_func_array([$this->getRepository(), __FUNCTION__], func_get_args());

        $this->getCacheInstance()->flushCache();

        return $result;
    }

    /**
     * @param int|\Tukecx\Base\ACL\Repositories\Contracts\RoleRepositoryContract $id
     * @return array
     */
    public function getRelatedPermissions($id)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }
}

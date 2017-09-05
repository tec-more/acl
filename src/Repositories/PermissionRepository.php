<?php namespace Tukecx\Base\ACL\Repositories;

use Tukecx\Base\Caching\Services\Traits\Cacheable;
use Tukecx\Base\Core\Repositories\Eloquent\EloquentBaseRepository;

use Tukecx\Base\ACL\Repositories\Contracts\PermissionRepositoryContract;
use Tukecx\Base\Caching\Services\Contracts\CacheableContract;

class PermissionRepository extends EloquentBaseRepository implements PermissionRepositoryContract, CacheableContract
{
    use Cacheable;

    protected $rules = [
        'name' => 'required|between:3,100|string',
        'slug' => 'required|between:3,100|unique:roles|alpha_dash',
        'module' => 'required|max:255',
    ];

    /**
     * Register permission
     * @param $name
     * @param $alias
     * @param $module
     * @param bool $force
     * @return array|\Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    public function registerPermission($name, $alias, $module, $force = true)
    {
        $permission = $this->where(['slug' => $alias])->first();
        if (!$permission) {
            $result = $this->editWithValidate(0, [
                'name' => $name,
                'slug' => str_slug($alias),
                'module' => $module,
            ], true, false);
            if (!$result['error']) {
                if (!$force) {
                    return response_with_messages($result['messages'], false, \Constants::SUCCESS_NO_CONTENT_CODE);
                }
            }
            if (!$force) {
                return response_with_messages($result['messages'], true, \Constants::ERROR_CODE);
            }
        }
        if (!$force) {
            return response_with_messages('Permission alias exists', true, \Constants::ERROR_CODE);
        }
        return $this;
    }

    /**
     * @param string|array $alias
     * @param bool $force
     * @return array|\Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    public function unsetPermission($alias, $force = true)
    {
        $result = $this->where('slug', 'IN', (array)$alias)->delete();
        if (!$result['error']) {
            if (!$force) {
                return response_with_messages($result['messages'], false, \Constants::SUCCESS_NO_CONTENT_CODE);
            }
        }
        if (!$force) {
            return response_with_messages($result['messages'], true, \Constants::ERROR_CODE);
        }
        return $this;
    }

    /**
     * @param string|array $module
     * @param bool $force
     * @return array|\Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    public function unsetPermissionByModule($module, $force = true)
    {
        $result = $this->where('module', 'IN', (array)$module)->delete();
        if (!$result['error']) {
            if (!$force) {
                return response_with_messages($result['messages'], false, \Constants::SUCCESS_NO_CONTENT_CODE);
            }
        }
        if (!$force) {
            return response_with_messages($result['messages'], true, \Constants::ERROR_CODE);
        }
        return $this;
    }
}

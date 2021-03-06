<?php namespace Tukecx\Base\ACL\Repositories\Contracts;

interface RoleRepositoryContract
{
    /**
     * @param int|array $id
     * @return mixed
     */
    public function deleteRole($id);

    /**
     * @param array $data
     * @return array
     */
    public function createRole($data);

    /**
     * @param int $id
     * @param array $data
     * @return array
     */
    public function updateRole($id, $data);

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function syncPermissions($model, $data);
}

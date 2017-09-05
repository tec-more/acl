<?php namespace Tukecx\Base\ACL\Models\Contracts;

interface RoleModelContract
{
    /**
     * @return mixed
     */
    public function permissions();

    /**
     * @return mixed
     */
    public function users();
}

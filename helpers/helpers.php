<?php
use Tukecx\Base\ACL\Repositories\Contracts\PermissionRepositoryContract;

if (!function_exists('check_user_acl')) {
    /**
     * @return \Tukecx\Base\ACL\Support\CheckUserACL
     */
    function check_user_acl()
    {
        return \Tukecx\Base\ACL\Facades\CheckUserACLFacade::getFacadeRoot();
    }
}

if (!function_exists('acl_permission')) {
    /**
     * Get the PermissionRepository instance.
     *
     * @return \Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    function acl_permission()
    {
        return app(PermissionRepositoryContract::class);
    }
}

if (!function_exists('has_permissions')) {
    /**
     * @param \Tukecx\Base\Users\Models\User $user
     * @param array $permissions
     * @return bool
     */
    function has_permissions($user, array $permissions = [])
    {
        if (!$user) {
            return false;
        }

        if (!$permissions) {
            return true;
        }

        /**
         * @var \Tukecx\Base\Users\Repositories\UserRepository $userRepo
         */
        $userRepo = app(\Tukecx\Base\Users\Repositories\Contracts\UserRepositoryContract::class);
        return $userRepo->hasPermission($user, $permissions);
    }
}

if (!function_exists('has_roles')) {
    /**
     * @param \Tukecx\Base\Users\Models\User $user
     * @param array $roles
     * @return bool
     */
    function has_roles($user, $roles = [])
    {
        if (!$user) {
            return false;
        }

        if (!$roles) {
            return true;
        }

        /**
         * @var \Tukecx\Base\Users\Repositories\UserRepository $userRepo
         */
        $userRepo = app(\Tukecx\Base\Users\Repositories\Contracts\UserRepositoryContract::class);
        return $userRepo->hasRole($user, $roles);
    }
}

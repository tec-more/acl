<?php namespace Tukecx\Base\ACL\Http\Controllers;

use Tukecx\Base\ACL\Http\DataTables\PermissionsListDataTable;
use Tukecx\Base\Core\Http\Controllers\BaseAdminController;
use Tukecx\Base\ACL\Repositories\Contracts\PermissionRepositoryContract;

class PermissionController extends BaseAdminController
{
    protected $module = 'tukecx-acl';

    /**
     * @var \Tukecx\Base\ACL\Repositories\PermissionRepository
     */
    protected $repository;

    public function __construct(PermissionRepositoryContract $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->getDashboardMenu($this->module . '-permissions');

        $this->breadcrumbs->addLink('ACL')->addLink('权限', route('admin::acl-permissions.index.get'));;
    }

    public function getIndex(PermissionsListDataTable $permissionsListDataTable)
    {
        $this->setPageTitle('权限', '所有可用权限');

        $this->dis['dataTable'] = $permissionsListDataTable->run();

        return do_filter('acl-permissions.index.get', $this)->viewAdmin('permissions.index');
    }

    public function postListing(PermissionsListDataTable $permissionsListDataTable)
    {
        return do_filter('datatables.acl-permissions.index.post', $permissionsListDataTable, $this);
    }
}

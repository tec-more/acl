<?php namespace Tukecx\Base\ACL\Http\DataTables;

use Tukecx\Base\ACL\Models\Role;
use Tukecx\Base\Core\Http\DataTables\AbstractDataTables;

class RolesListDataTable extends AbstractDataTables
{
    /**
     * @var Role
     */
    protected $model;

    public function __construct()
    {
        $this->model = Role::select('id', 'name', 'slug');

        parent::__construct();
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->setAjaxUrl(route('admin::acl-roles.index.get-json'), 'POST');

        $this
            ->addHeading('id', 'ID', '5%')
            ->addHeading('name', '名称', '50%')
            ->addHeading('alias', 'Alias', '30%')
            ->addHeading('actions', '动作', '20%');

        $this
            ->addFilter(1, form()->text('id', '', [
                'class' => 'form-control form-filter input-sm',
                'placeholder' => '...'
            ]))
            ->addFilter(2, form()->text('name', '', [
                'class' => 'form-control form-filter input-sm',
                'placeholder' => '搜索...'
            ]))
            ->addFilter(3, form()->text('slug', '', [
                'class' => 'form-control form-filter input-sm',
                'placeholder' => '搜索...'
            ]));

        $this->withGroupActions([
            '' => '选择' . '...',
            'deleted' => '删除',
        ]);

        $this->setColumns([
            ['data' => 'id', 'name' => 'id', 'searchable' => false, 'orderable' => false],
            ['data' => 'viewID', 'name' => 'id'],
            ['data' => 'name', 'name' => 'name'],
            ['data' => 'slug', 'name' => 'slug'],
            ['data' => 'actions', 'name' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);

        return $this->view();
    }

    /**
     * @return $this
     */
    protected function fetch()
    {
        $this->fetch = datatable()->of($this->model)
            ->editColumn('id', function ($item) {
                return form()->customCheckbox([
                    ['id[]', $item->id]
                ]);
            })
            ->addColumn('viewID', function ($item) {
                return $item->id;
            })
            ->addColumn('actions', function ($item) {
                /*Edit link*/
                $deleteLink = route('admin::acl-roles.delete.delete', ['id' => $item->id]);
                $editLink = route('admin::acl-roles.edit.get', ['id' => $item->id]);

                /*Buttons*/
                $editBtn = link_to($editLink, '编辑', ['class' => 'btn btn-outline green btn-sm']);
                $deleteBtn = ($item->status != 'deleted') ? form()->button('删除', [
                    'title' => 'Delete this item',
                    'data-ajax' => $deleteLink,
                    'data-method' => 'DELETE',
                    'data-toggle' => 'confirmation',
                    'class' => 'btn btn-outline red-sunglo btn-sm ajax-link',
                ]) : '';

                $deleteBtn = ($item->status != 'deleted') ? $deleteBtn : '';

                return $editBtn . $deleteBtn;
            });

        return $this;
    }
}

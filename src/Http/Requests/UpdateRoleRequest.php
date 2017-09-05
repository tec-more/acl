<?php namespace Tukecx\Base\ACL\Http\Requests;

use Tukecx\Base\Core\Http\Requests\Request;

class UpdateRoleRequest extends Request
{
    public $rules = [
        'name' => 'required|max:255|string',
    ];
}

<?php namespace Tukecx\Base\ACL\Facades;

use Illuminate\Support\Facades\Facade;
use Tukecx\Base\ACL\Support\CheckCurrentUserACL;
use Tukecx\Base\ACL\Support\CheckUserACL;

class CheckUserACLFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CheckUserACL::class;
    }
}

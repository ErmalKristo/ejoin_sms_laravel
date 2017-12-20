<?php
namespace Wangjian\Alisms;

use Illuminate\Support\Facades\Facade;

class Alisms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'alisms';
    }
}

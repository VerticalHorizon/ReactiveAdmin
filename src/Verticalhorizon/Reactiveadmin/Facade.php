<?php namespace Verticalhorizon\Reactiveadmin;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * @see \Verticalhorizon\Reactiveadmin\Facade
 * @package Verticalhorizon\Reactiveadmin
 */
class Facade extends IlluminateFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'reactiveadmin';
    }
}

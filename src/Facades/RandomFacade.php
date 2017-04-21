<?php 
namespace Nirmal\Random\Facades;

use Illuminate\Support\Facades\Facade;

class RandomFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'Random';
    }

}

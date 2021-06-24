<?php

namespace App\Product;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class ProductConfigurator extends IndexConfigurator
{
    use Migratable;

    // protected $name = 'katalog_bersama';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}

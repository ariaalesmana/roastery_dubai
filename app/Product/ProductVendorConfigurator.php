<?php

namespace App\Product;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class ProductVendorConfigurator extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}

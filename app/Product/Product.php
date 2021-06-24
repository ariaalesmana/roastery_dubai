<?php

namespace App\Product;

/*use ScoutElastic\Searchable;
use App\Product\ProductConfigurator;*/
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    //protected $connection = 'katalog_ap2';
    //use Searchable;

    protected $fillable = [
        'name', 'description', 'short_description', 'price', 'unit', 'sku', 'vendor_sku', 'image', 'small_image', 'thumbnail', 'status', 'created_at', 'updated_at'
    ];

    //protected $indexConfigurator = ProductConfigurator::class;

    // Here you can specify a mapping for model fields
    /*protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                // Also you can configure multi-fields, more details you can find here https://www.elastic.co/guide/en/elasticsearch/reference/current/multi-fields.html
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
        ]
    ];*/

    public function product_media_gallery() {
        return $this->hasMany('\App\Product\ProductMediaGallery', 'product_id', 'id');
    }

    public function product_vendor() {
        return $this->hasMany('\App\Product\ProductVendor', 'product_id', 'id');
    }

    public function product_group() {
        return $this->hasMany('\App\Product\ProductGroup', 'product_id', 'id');
    }

    public function category_product() {
        return $this->hasMany('\App\Category\CategoryProduct', 'product_id', 'id');
    }

    public function product_shipping() {
        return $this->hasMany('\App\Product\ProductShipping', 'product_id', 'id');
    }

    public function product_contract() {
        return $this->hasOne('\App\Product\ProductContract', 'product_id', 'id');
    }

    public function batch() {
        return $this->hasOne('\App\Batch', 'id', 'batch_id');
    }
}

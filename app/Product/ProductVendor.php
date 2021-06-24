<?php

namespace App\Product;

//use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\Model;
//use App\Product\ProductVendorConfigurator;

class ProductVendor extends Model {

    //use Searchable;

    protected $fillable = [
        'vendor_id', 'product_id', 'price', 'stock', 'description', 'additional_info', 'status', 'created_at', 'updated_at'
    ];

    /*protected $indexConfigurator = ProductVendorConfigurator::class;

    // Here you can specify a mapping for model fields
    protected $mapping = [
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

    public function vendor() {
        return $this->hasOne('\App\Vendor\vendor', 'id', 'vendor_id');
    }

    public function product() {
        return $this->hasOne('\App\Product\Product', 'id', 'product_id');
    }

    public function product_group() {
        return $this->hasMany('\App\Product\ProductGroup', 'product_id', 'product_id');
    }

    public function category_product() {
        return $this->hasMany('\App\Category\CategoryProduct', 'product_id', 'product_id');
    }

    public function product_contract() {
        return $this->hasOne('\App\Product\ProductContract', 'product_id', 'product_id');
    }

    public function vendor_get_daftar_product($vendor_id) {
        return $this->with(['product'])
        ->has('product')
        ->whereHas('product', function ($p){
            $p->where('status', 1);
        })
        ->where('vendor_id', $vendor_id);
    }

    public function vendor_get_detail_product($id) {
        return $this->with(['vendor'])
        ->with(['product'])
        ->whereHas('product', function ($p){
            $p->whereIn('status', [0,1]);
        })
        ->has('product')
        ->where('product_id', $id)
        ->first();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Category\Category;
use App\Product\Product;
use App\Vendor\vendor;
use App\Product\ProductVendor;
use App\Category\CategoryProduct;
use App\Lokasi\Location;
use App\Style\style;
use App\Katalog\ListKatalog;

class LayoutController extends Controller {
    
    public function sub_sub_ctg($sub_sub_category) {
        $sub_sub_categories = array();
        foreach($sub_sub_category as $sub_sub_cat) {
            $sub_sub_categories_data = array("id" => $sub_sub_cat->id, "name" => $sub_sub_cat->name);
            array_push($sub_sub_categories, $sub_sub_categories_data);
        }
        return $sub_sub_categories;
    }

    public function sub_ctg($sub_category) {
        $sub_categories = array();
        foreach($sub_category as $sub_cat) {
            $sub_sub_category = $sub_cat->where("parent_id", $sub_cat->id)->where("level", 4)->where("status", 1)->get();
            $sub_categories_data = array("id" => $sub_cat->id, "name" => $sub_cat->name, "sub_sub_category" => $this->sub_sub_ctg($sub_sub_category));
            array_push($sub_categories, $sub_categories_data);
        }
        return $sub_categories;
    }

    public function get_ctg() {
        $category = Category::where('level', 2)->where("status", 1)->get();
        $categories = array();
        foreach($category as $cat) {
            $sub_category = $cat->where("parent_id", $cat->id)->where("level", 3)->where("status", 1)->get();
            $categories_data = array("id" => $cat->id, "name" => $cat->name, "sub_category" => $this->sub_ctg($sub_category));
            array_push($categories, $categories_data);
        }

        return $categories;
    }

    public function get_style() {
        $style = style::find(1);
        return $style;
    }

    public function get_code($module) {
        $group = DB::connection('mysql')->table('group')->where('module', $module)->first()->code;
        return $group;
    }
}

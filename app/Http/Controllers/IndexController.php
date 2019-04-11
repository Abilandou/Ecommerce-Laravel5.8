<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class IndexController extends Controller
{
    //
    public function index($id = null){
        //In Ascending order (by default)
        //$productAll = Product::get();

        //In Descending order (by default)
        //$productsAll = Product::orderBy('id', 'DESC')->get();

        // In Random order 
        $productsAll = Product::inRandomOrder()->where('status',1)->where('featured_item',1)->paginate(4);
        
        //Return categories and subcategories, with hasMany relation added in Category Model
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        //Return Banners

        $allBanners = Banner::where('status', '1')->get();

        return view('index')->with(compact('productsAll', 'categories', 'allBanners'));
    }
}

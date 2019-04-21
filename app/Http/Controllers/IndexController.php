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
        $productsAll = Product::inRandomOrder()->where('status',1)->where('featured_item',1)->paginate(6);
        
        //Return categories and subcategories, with hasMany relation added in Category Model
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        //Return Banners

        $allBanners = Banner::where('status', '1')->get();

        //Meta tags
        $meta_title = "My Ecom site";
        //Meta description
        $meta_description = "THe description of your site goes here";
         //Add key words to uniquely identify your site
   	    $meta_key_word = "Enter key words here";

        return view('index')->with(compact('productsAll', 'categories', 'allBanners', 
                        'meta_title', 'meta_description', 'meta_key_word'));
    }
}

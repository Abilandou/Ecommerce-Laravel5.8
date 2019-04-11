<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Session;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use Image;
use App\ProductsImage;
use DB;
use App\Coupon;
use App\Country;
use App\DeliveryAddress;
// use App\Cart;
use App\User;
use App\Order;
use App\OrdersProduct;
use App\OrdersStatus;

class ProductsController extends Controller
{
    //
    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $product = new Product();
           
            if($data['parent_id'] == 0){
                return redirect('/admin/add_product')->with('flash_message_error', 'Fill required(*) fields, Please select a category');
            }
            $product->category_id = $data['parent_id'];
            if(empty($data['product_name'])){
                return redirect('/admin/add_product')->with('flash_message_error', 'Fill required(*) fields, product name is missing');
            }
            $product->product_name = $data['product_name'];

            if(empty($data['product_code'])){
                return redirect('/admin/add_product')->with('flash_message_error', 'Fill required(*) fields, product code is missing');
            }
            $product->product_code = $data['product_code'];

            if(empty($data['product_color'])){
                return redirect('/admin/add_product')->with('flash_message_error', 'Fill required(*) fields, product color is missing');
            }
            $product->product_color = $data['product_color'];

            if(empty($data['description'])){
                return redirect('/admin/add_product')->with('flash_message_error', 'Fill required(*) fields, product description is missing');
            }
            $product->description = $data['description'];
            $product->care = $data['care'];

            if(empty($data['price'])){
                return redirect('/admin/add_product')->with('flash_message_error', 'Fill required(*) fields, product price is missing');
            }
            $product->price = $data['price'];
            //$product->image = '';

            $product->discount = $data['discount'];

            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }
            $product->status = $status;
            if(empty($data['featured_item'])){
                $featured_item = 0;
            }else {
                $featured_item = 1;
            }
            $product->featured_item = $featured_item;

             //Upload Image
             if($request->hasFile('image')){
               $image_tmp = Input::file('image');
                if($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;

                    //Resize images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                    //Store image name in products table
                    $product->image = $filename;



                }
            }

            //check if prodcut name already exists
            $productCheck= Product::where('product_name', $product->product_name)
                                ->first();
                if($productCheck){
                    //if product alredy exists
                    return redirect('/admin/add_product')->with('flash_message_error', 'product already exists');
                }

           

            $product->save();
            return redirect('/admin/view_products')->with('flash_message_success', 'Product added Successfully');

        }
        $categories = Category::get();
        // $categories_dropdown = "<option selected disabled>Select</option>";
        // foreach($categories as $cat){
        //     $categories_dropdown = "<option value='".$cat->id."'>".$cat->name."</option>";
        //     $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
        //     foreach($sub_categories as $sub_cat){
        //         $categories_dropdown = "<option value= '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
        //     }
        // }
        return view('admin.products.add_product')->with(compact('categories'));
    }

    public function viewProducts(){
        $products = Product::orderby('id', 'DESC')->get();
        foreach($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products')->with(compact('products'));

    }

    public function editProduct(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['category_id'])){
                return redirect()->back()->with('flash_message_error', 'Product Not Updated Fill required(*) fields, Make sure all required fields are filled, Category Was Empty.');
            }
            if(empty($data['product_name'])){
                return redirect()->back()->with('flash_message_error', 'Product Not Updated Fill required(*) fields, Make sure all required fields are filled, Product Name Was Empty.');
            }
            if(empty($data['product_code'])){
                return redirect()->back()->with('flash_message_error', 'Product Not Updated Fill required(*) fields, Make sure all required fields are filled, Product Code Was Empty.');
            }
            if(empty($data['product_color'])){
                return redirect()->back()->with('flash_message_error', 'Product Not Updated Fill required(*) fields, Make sure all required fields are filled, Product Color Was Empty.');
            }
            // if(empty($data['product_description'])){
            //     return redirect()->back()->with('flash_message_error', 'Product Not Updated Fill required(*) fields, Make sure all required fields are filled, Product Was Description Empty.');
            // }
            if(empty($data['price'])){
                return redirect()->back()->with('flash_message_error', 'Product Not Updated Fill required(*) fields, Make sure all required fields are filled, Product Price Was Empty.');
            }
            if(empty($data['discount'])){
                return redirect()->back()->with('flash_message_error', 'Product Not Updated Fill required(*) fields, Make sure all required fields are filled, Product Discount Was Empty.');
            }
            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }
            if(empty($data['featured_item'])){
                $featured_item = 0;
            }else {
                $featured_item = 1;
            }

            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
 
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
 
                     //Resize images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                    
                }
            }
            else if(!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else{
                $filename = "";
            }

            Product::where('id',$id)->update([
                                        'category_id'=>$data['category_id'],
                                        'product_name'=>$data['product_name'],
                                        'product_code'=>$data['product_code'],
                                        'product_color'=>$data['product_color'],
                                        'description'=>$data['description'],
                                        'care'=>$data['care'],
                                        'price'=>$data['price'],
                                        'discount'=>$data['discount'],
                                        'status'=>$status,
                                        'featured_item'=>$featured_item,
                                        'image'=>$filename,
                                    ]);
            return redirect('/admin/view_products')->with('flash_message_success', 'Product updated Successfully'); 
        }
        $productDetails = Product::where('id',$id)->first();
        $levels = Category::get();
        

        return view('admin.products.edit_product')->with(compact('productDetails', 'levels'));
    }

    public function deleteProduct($id = null){

        if(!empty($id)){
            Product::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Product deleted successfully');
        }
    }

    public function deleteProductImage($id = null){

         //Get Product Image name
         $prodctImage = Product::where(['id'=>$id])->first();

         //Get Product image path
         $large_image_path = 'images/backend_images/products/large/';
         $medium_image_path = 'images/backend_images/products/medium/';
         $small_image_path = 'images/backend_images/products/small/';
 
         //Delete Large image if not exist
         if(file_exists($large_image_path.$prodctImage->image)){
             unlink($large_image_path.$prodctImage->image);
         }
 
          //Delete medium image if not exist
          if(file_exists($medium_image_path.$prodctImage->image)){
             unlink($medium_image_path.$prodctImage->image);
         }
 
          //Delete small image if not exist
          if(file_exists($small_image_path.$prodctImage->image)){
             unlink($small_image_path.$prodctImage->image);
         }

        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success', 'Product image deleted successfully');

    }

    public function addAttributes(Request $request, $id = null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // $productDetails = json_decode(json_encode($productDetails));
        // echo "<pre>"; print_r($productDetails); die;
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){

                    //Prevent duplicate SkU
                    $attrCountSkU = ProductsAttribute::where('sku',$val)->count();
                    if($attrCountSkU > 0){
                        return redirect('/admin/add_attribute/'.$id)->with('flash_message_error', 'Present sku already taken, Please put another');
                    }

                    //Prevent Duplicate Size
                    $attrCountSizes = ProductsAttribute::where(['product_id'=>$id, 
                                                        'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes > 0){
                        return redirect('/admin/add_attribute/'.$id)->with('flash_message_error', 'Present size: '.$data['size'][$key]. ', already taken for this product, Please try some other sizes');
                    }
                    $attribute = new ProductsAttribute();
                   
                    $attribute->product_id = $data['product_id'];
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->age = $data['age'][$key];

                    $attribute->save();
                }
            }
            return redirect('/admin/add_attribute/'.$id)->with('flash_message_success', 'Product attributes added successfully');
        }
        return view('admin.products.add_attribute')->with(compact('productDetails'));
    }

    public function editAttributes(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           foreach($data['idAttr'] as $key => $attr){
               ProductsAttribute::where(['id'=>$data['idAttr'][$key]])
                                ->update(['price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
           }
           return redirect()->back()->with('flash_message_success', 'Products Attributes updated successfully');
        }
    }

    public function addAlternateImages(Request $request, $id = null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        if($request->isMethod('post')){
           //Add Alternate images
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           if($request->hasFile('image')){
                $files = $request->file('image');
                foreach($files as $file){
                    //Upload Image after resize
                    $image = new ProductsImage();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$fileName;
                    $medium_image_path = 'images/backend_images/products/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/small/'.$fileName;

                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);

                    $image->image=$fileName;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
           }

           return redirect('/admin/add_images/'.$id)->with('flash_message_success', 'Product alternate images added successfully');
        } 
        
        $productsImages = ProductsImage::where(['product_id'=>$id])->get();
        return view('admin.products.add_images')->with(compact('productDetails', 'productsImages'));
    }

    public function deleteAltImage($id = null){

        //Get Product Image name
        $prodctImage = ProductsImage::where(['id'=>$id])->first();

        //Get Product image path
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large image if not exist
        if(file_exists($large_image_path.$prodctImage->image)){
            unlink($large_image_path.$prodctImage->image);
        }

         //Delete medium image if not exist
         if(file_exists($medium_image_path.$prodctImage->image)){
            unlink($medium_image_path.$prodctImage->image);
        }

         //Delete small image if not exist
         if(file_exists($small_image_path.$prodctImage->image)){
            unlink($small_image_path.$prodctImage->image);
        }

        //delete image from products table.
        ProductsImage::where(['id'=>$id])->delete();
       return redirect()->back()->with('flash_message_success', 'Product Alternate image deleted successfully');

   }

    public function deleteProductAttribute($id = null){
        if(!empty($id)){
            ProductsAttribute::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Attribute deleted successfully');
        }
    }

    //Display 404 page
    public function products($url = null){ 

        //Show a 404 page if Category Url does not exist
        $countCategory = Category::where(['url'=>$url, 'status'=>1])->count();
        if($countCategory == 0){
            abort(404);
        }

        //Return categories and subcategories, with hasMany relation added in Category Model
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails = Category::where(['url'=>$url])->first();

        if($categoryDetails->parent_id==0){
            //if url is main category url
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            foreach($subCategories as $subcat){
                $cat_ids[] = $subcat->id;
               
            }
            $productsAll = Product::whereIn('category_id', $cat_ids)->where('status',1)->get();
            $productsAll = json_decode(json_encode($productsAll));
            // echo "<pre>"; print_r($productsAll); die;
        }else {
            //if url is sub category url
            $productsAll = Product::where(['category_id' => $categoryDetails->id])->where('status',1)->get();
        }

        // $productsAll = Product::where(['category_id'=>$categoryDetails->id])->get();
        return view('products.listing_category')->with(compact('categories','categoryDetails', 'productsAll'));
    }

    public function userSearchProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            $categories = Category::with('categories')->where(['parent_id'=>0])->get();

            $search_product = $data['product_search'];

            $search_product = json_decode(json_encode($search_product));
            // echo "<pre>"; print_r($search_product); die;
            $productsAll = Product::where('product_name', 'like', '%'.$search_product.'%')
                                    ->orwhere('product_code',$search_product)->where('status',1)->get();
                                
           return view('products.listing_category')->with(compact('categories','search_product', 'productsAll'));
            
        }
        
    }


    //Product detail page
    public function product($id = null){

        //Show 404 page if user tries to get disabled product by typing the url directly
        $productsCount = Product::where(['id'=>$id, 'status'=>1])->count();
        if($productsCount == 0){
            abort(404);
        }
        //If pruduct does not exist return a 404 when user tries to type a wrong id on the browser.
        $productExist = Product::where(['id'=>$id])->first();
        // echo "<pre>"; print_r($productNotExist); die;
        if($productExist == null){
            abort(404);
        }

        //Get product details without including product attribute table
        //$productDetails = Product::where('id', $id)->first();

        //Get product detail with product attributes by passing with('attributes')
        $productDetails = Product::with('attributes')->where('id', $id)->first();

        $relatedProducts = Product::where('id', '!=', $id)
                                    ->where(['category_id' =>$productDetails
                                    ->category_id])->get();
        // foreach($relatedProducts->chunk(3) as $chunk){
        //     foreach($chunk as $item){
        //         echo $item; echo "<br>";
        //     }
        //     echo "<br><br><br>";
        // }
        // die;

        //Return all categories and sub categories with hasMany relation
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        //Get Product Alternate Images.
        $produtAltImages = ProductsImage::where('product_id', $id)->get();
        $produtAltImages = json_decode(json_encode($produtAltImages));
        // echo "<pre>"; print_r($produtAltImages); die;

       $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');


        return view('products.detail')->with(compact('productDetails', 'categories', 'produtAltImages', 'total_stock', 'relatedProducts'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        $proArr = explode("-",$data['idSize']); //explodes strips out the hyphane('-')
        $proAtrr = ProductsAttribute::where(['product_id' => $proArr[0], 'size' => $proArr[1] ])
                                    ->first();
        echo $proAtrr->price;
        echo "#";
        echo $proAtrr->stock;
    }

    public function addtocart(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        // $user_email = Auth::user()->email;

        $data = $request->all();
        // echo "<pre>"; print_r($data); die;


        //Verify if Product stoc is available or not.
        $product_size = explode("-",$data['size']);
        // echo $product_size[1]; die;
        $getProductStock = ProductsAttribute::where([
                         'product_id'=>$data['product_id'],
                          'size'=>$product_size[1]  
                        ])->first();
        if($getProductStock->stock < $data['quantity']){
            return redirect()->back()->with('flash_message_error', 'The quantity you ask is not in stock, either reduce the quantity you are demanding to continue');
        }

         if(empty($data['user_email'])){
        ///if(empty(Auth::user()->email)){    
            $data['user_email'] = '';
        }
        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = str_random(40);
            Session::put('session_id', $session_id);
        }
        
        //Remove hyphane between productid and size.
        $sizeArr = explode("-",$data['size']);
        //GEt the size after removing the hyphane
        $product_size = $sizeArr[1];

        if(empty(Auth::check())){
            $countProducts =  DB::table('carts')->where([
                'product_id'=>$data['product_id'],
                'product_color'=>$data['product_color'],
                'size'=>$product_size,
                'session_id'=>$session_id,
            ])->count();
    
            // echo "<pre>"; print_r( $sizeArr); die;
            if($countProducts > 0){
               return redirect()->back()->with('flash_message_error', 'Product already exists on cart');
            }
        }else{
            $countProducts =  DB::table('carts')->where([
                'product_id'=>$data['product_id'],
                'product_color'=>$data['product_color'],
                'size'=>$product_size,
                'user_email'=>$data['user_email'],
            ])->count();
    
            // echo "<pre>"; print_r( $sizeArr); die;
            if($countProducts > 0){
               return redirect()->back()->with('flash_message_error', 'Product already exists on cart');
            }
        }
        $getSkU = ProductsAttribute::select('sku')->where([
                                    'product_id'=>$data['product_id'],
                                    'size'=>$sizeArr[1],  
                                ])->first();

        DB::table('carts')->insert([
            'product_id'=>$data['product_id'],
            'product_name'=>$data['product_name'],
            'product_code'=>$getSkU->sku,
            'product_color'=>$data['product_color'],
            'size'=>$sizeArr[1],
            'price'=>$data['price'],
            'quantity'=>$data['quantity'],
            'user_email'=>$data['user_email'],
            'session_id'=>$session_id,
        ]);
                    
        return redirect()->back()->with('flash_message_success', 'Product added to cart!');
    }

    public function cart(){
         
        $session_id = Session::get('session_id');
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();

        }
        
         $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        //  echo "<pre>"; print_r($userCart); die;
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image; 
        }
        //   echo "<pre>"; print_r($userCart); die;
        return view('products.cart')->with(compact('userCart'));
    }

    public function deleteCartProduct($id = null){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        DB::table('carts')->where('id', $id)->delete();
        return redirect('cart');
    }

    public function updateCartQuantity($id = null, $quantity=null){
        $getCartDetails = DB::table('carts')->where('id', $id)->first();
        $getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();

        $updated_quantity = $getCartDetails->quantity+$quantity; //quantity updated by user
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('carts')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart');
        }else{
            return redirect()->back()->with('flash_message_error', 
                                    'Quantity demanded is not in stock, please be patient product will be added soon');
        }
      

    }

    public function applyCoupon(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
       
            $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
            if($couponCount == 0){
                return redirect()->back()->with('flash_message_error', 'Your Coupon code does not exists ');
            }else{
                //perform other checks like active or inactive, Expiry date

               //if coupon is active
                $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first();

                //If coupon is inactive
                if($couponDetails->status == 0){
                    return redirect()->back()->with('flash_message_error', 'Coupon inactive');
                }

                //If coupon is Expired
                $expiry_date = $couponDetails->expiry_date;
               $current_date = date('Y-m-d');
               if($expiry_date < $current_date){
                   return redirect()->back()->with('flash_message_error', 'Sorry coupon code expired');
               }

               //Coupon is valid for discount

               //Get cart total amount 
               $session_id = Session::get('session_id');
            //    $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();


               if(Auth::check()){
                    $user_email = Auth::user()->email;
                    $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
                }else{
                    $session_id = Session::get('session_id');
                    $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
                }

               $total_amount = 0;

               foreach($userCart as $item){
                  $total_amount = $total_amount + ($item->price * $item->quantity);
               }

               //Check if ammount type is fixed or percentage
               if($couponDetails->amount_type == "Fixed"){
                   $couponAmount = $couponDetails->amount;

               }else{
                   $couponAmount = $total_amount * ($couponDetails->amount/100);
               }

               //Add Coupon code and Amount in Session

               Session::put('CouponAmount', $couponAmount);
               Session::put('CouponCode', $data['coupon_code']);

               return redirect()->back()->with('flash_message_success', 'Coupon code successfully applied. Your discount is available.');



            }
    }

    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $userDetails = json_decode(json_encode( $userDetails));
        // echo "<pre>"; print_r( $userDetails); die;
        $countries = Country::get();

        //check if shiping address exists
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingCount = json_decode(json_encode( $shippingCount));
        // echo "<pre>"; print_r( $shippingCount); die;
         //Declear shipping details as an array
         $shippingDetails = array();
        if($shippingCount > 0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }

        //Update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('carts')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre"; print_r($data); die;
            //Return true to check page if any of the field is empty

            if(empty($data['billing_name']) || empty($data['billing_last_name']) || empty($data['billing_address']) || empty($data['billing_city']) ||
                empty($data['billing_state']) ||  empty($data['billing_country']) ||  empty($data['billing_pincode']) ||
                empty($data['billing_mobile']) ||  empty($data['shipping_name']) || empty($data['shipping_last_name']) || empty($data['shipping_address']) || 
                empty($data['shipping_city']) ||  empty($data['shipping_state']) ||  empty($data['shipping_country']) ||  
                empty($data['shipping_pincode']) || empty($data['shipping_mobile'])  
            ){
                return redirect()->back()->with('flash_message_error', 'All fields are required');
            }

            //Update User details
           User::where('id', $user_id)->update([
                   'name'=>$data['billing_name'],
                   'last_name'=>$data['billing_last_name'],
                   'address'=>$data['billing_address'],
                   'city'=>$data['billing_city'],
                   'state'=>$data['billing_state'],
                   'country'=>$data['billing_country'],
                   'pincode'=>$data['billing_pincode'],
                   'mobile'=>$data['billing_mobile'],
                ]);

                if($shippingCount > 0){
                    //Update shipping address
                    DeliveryAddress::where('user_id', $user_id)->update([
                                        'name'=>$data['shipping_name'],
                                        'last_name'=>$data['shipping_last_name'],
                                        'address'=>$data['shipping_address'],
                                        'city'=>$data['shipping_city'],
                                        'state'=>$data['shipping_state'],
                                        'country'=>$data['shipping_country'],
                                        'pincode'=>$data['shipping_pincode'],
                                        'mobile'=>$data['shipping_mobile'],     
                                    ]);

                }else{
                    //Add new shipping address.
                    $shipping = new DeliveryAddress();

                    $shipping->user_id = $user_id;
                    $shipping->user_email = $user_email;
                    $shipping->name = $data['shipping_name'];
                    //$shipping->last_name = $data['shipping_last_name'];
                    $shipping->address = $data['shipping_address'];
                    $shipping->state = $data['shipping_state'];
                    $shipping->city = $data['shipping_city'];
                    $shipping->country = $data['shipping_country'];
                    $shipping->pincode = $data['shipping_pincode'];
                    $shipping->mobile = $data['shipping_mobile'];
                    $shipping->save();
                }
               return redirect('/review_order');
               
        }


        return view('products.checkout')->with(compact('userDetails', 'countries', 'shippingDetails'));
    }

    //Admin view orders from admin panel

    public function viewOrders(){
        $allOrders = Order::with('orders')->orderBy('id', 'DESC')->get();
        $allOrders = json_decode(json_encode($allOrders));
        //  echo "<pre>"; print_r($allOrders); die;
        return view('admin.orders.view_orders')->with(compact('allOrders'));
    }

    public function viewOrderDetails($order_id, $id=null){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();

         //Get Order Status from order_status table
         $orderStatus = OrdersStatus::get();

         //Get a single order status
         $singleOrder = OrdersStatus::where('id',$id)->get();
        return view('admin.orders.order_details')->with(compact('orderDetails', 'userDetails', 'orderStatus', 'singleOrder'));
    }

    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            //Update the order status based on the order id
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success', 'Order Status Updated Successfully');

        }else{
            return redirect()->back()->with('flash_message_error', 'Faliure In Updating Order Status, Check your network connection');
        }
    }

    
   
   
}

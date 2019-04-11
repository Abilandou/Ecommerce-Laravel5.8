<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/admin', 'AdminController@login');

Route::match(['get', 'post'], '/admin','AdminController@login');

Auth::routes();

//Home page route.
//Route::get('/home', 'HomeController@index')->name('home');

//Index Page
Route::get('/', 'IndexController@index');

//---Category Listing page
Route::get('/products/{url}', 'ProductsController@products');


//Product Detail Page
Route::get('product/{id}', 'ProductsController@product');


//Add to Cart Route
Route::match(['get', 'post'], '/add_cart', 'ProductsController@addtocart');

//Cart page
Route::match(['get', 'post'], '/cart', 'ProductsController@cart');

//Delete Product from cart
Route::get('/cart/delete_product/{id}', 'ProductsController@deleteCartProduct'); 

//Get product attribute price
Route::get('/get-product-price', 'ProductsController@getProductPrice');

//Update Product Quantity from cart
Route::get('/cart/update_quantity/{id}/{quantity}', 'ProductsController@updateCartQuantity');


//Apply coupon
Route::post('/cart/apply_coupon', 'ProductsController@applyCoupon');

//User login/register page.
Route::get('/login_register','UsersController@userLoginRegister');

//User Register Form submit
Route::post('/user_register', 'UsersController@register');

//Forgot Password, Reset it
Route::match(['get', 'post'], '/forgot_password', 'UsersController@resetUserPassword');

//Confirm Email on User Registration
Route::get('/confirm/{id}', 'UsersController@confirmAccount');

//User Login
Route::post('user_login', 'UsersController@login');


// Route::match(['get', 'post'], '/login_register','UsersController@register');

//Verify if user already exists
Route::match(['get', 'post'], '/check-email','UsersController@checkEmail');

//User Logout
Route::get('/user_logout', 'UsersController@logout');

//Search Product Route
Route::post('/search_products', 'ProductsController@userSearchProduct');

//All routes after login.
Route::group(['middleware' => ['frontlogin']], function(){
    //User Account
    Route::match(['get', 'post'], 'account', 'UsersController@account');
    //Check user current password.
    Route::get('/check_user_password', 'UsersController@checkUserPassword');
    Route::post('/update_user_password', 'UsersController@updateUserPassword');
    //checkoout page. 
    Route::match(['get', 'post'], 'checkout', 'ProductsController@checkout');

    //Order review page
    Route::match(['get', 'post'], '/review_order', 'OrdersController@orderReview'); 

    //Place Order
    Route::match(['get', 'post'], '/place_order', 'OrdersController@placeOrder');

    //Thanks route
    Route::get('/thanks', 'OrdersController@thanks');

    //Users orders page
    Route::get('/orders', 'OrdersController@userOrders');

    //User Ordered Products Page
    Route::get('/orders/{id}', 'OrdersController@userOrderDetails');

    //Paypal page
    Route::get('/paypal', 'OrdersController@paypalPayment');

});


Route::group(['middleware' => ['adminlogin']], function(){
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkPassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');


    //categories route(Admin)
    Route::match(['get', 'post'], '/admin/add_category', 'CategoryController@addCategory');
    Route::get('/admin/view_categories', 'CategoryController@viewCategories');
    Route::match(['get', 'post'], '/admin/edit_category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete_category/{id}', 'CategoryController@deleteCategory');


    //Products Routes
    Route::match(['get', 'post'], '/admin/add_product', 'ProductsController@addProduct');
    Route::get('/admin/view_products', 'ProductsController@viewProducts');
    Route::match(['get', 'post'], '/admin/edit_product/{id}', 'ProductsController@editProduct');
    Route::get('/admin/delete_product_image/{id}', 'ProductsController@deleteProductImage');
    Route::get('/admin/delete_alt_image/{id}', 'ProductsController@deleteAltImage');

    Route::get('/admin/delete_product/{id}', 'ProductsController@deleteProduct');


    //Products Attribute Route
    Route::match(['get', 'post'], 'admin/add_attribute/{id}', 'ProductsController@addAttributes');
    Route::match(['get', 'post'], 'admin/edit_attribute/{id}', 'ProductsController@editAttributes');
    Route::match(['get', 'post'], 'admin/add_images/{id}', 'ProductsController@addAlternateImages');
    Route::get('/admin/delete_attribute/{id}', 'ProductsController@deleteProductAttribute');

    //Coupon routes
    Route::match(['get', 'post'], 'admin/add_coupon', 'CouponsController@addCoupon');
    Route::get('/admin/view_coupons', 'CouponsController@viewCoupons');
    Route::match(['get', 'post'], 'admin/edit_coupon/{id}', 'CouponsController@editCoupon'); 
    Route::get('/admin/delete_coupon/{id}', 'CouponsController@deleteCoupon');

    //Admin add Banners
    Route::match(['get', 'post'], '/admin/add_banner', 'BannersController@addBanner');
    Route::get('/admin/view_banners', 'BannersController@viewBanners');
    Route::match(['get', 'post'], '/admin/edit_banner/{id}','BannersController@editBanner');
    Route::get('/admin/delete_banner/{id}', 'BannersController@deleteBanner');

    //Admin View Orders Route
    Route::get('/admin/view_orders', 'ProductsController@viewOrders');

    //Admin view other Details
    Route::get('/admin/view_order/{id}', 'ProductsController@viewOrderDetails');

    //Admin Delete Order
    Route::match(['get', 'post'], '/admin/delete_order/{id}', 'OrdersController@deleteOrder');


    //Order Invoice
    Route::get('/admin/view_order_invoice/{id}', 'OrdersController@viewOrderInvoice');



    //Admin Dynamic Order status
    Route::match(['get', 'post'], '/admin/add_order_status', 'OrdersController@addOrderStatus');
    Route::get('/admin/view_order_status', 'OrdersController@viewOrderStatus');
    Route::match(['get', 'post'], '/admin/edit_order_status/{id}', 'OrdersController@editOrderStatus');
    Route::match(['get', 'post'], '/admin/delete_order_status/{id}', 'OrdersController@deleteOrderStatus');

    //Admin Update Order Status
    Route::post('/admin/update_order_status', 'ProductsController@updateOrderStatus');

    //Get all Registered Users
    Route::get('/admin/view_users', 'UsersController@viewAllUsers'); 

    //Delete a single user
    Route::match(['get', 'post'], '/admin/delete_user/{id}', 'UsersController@deleteUser');

    //Add CMS Pages Route
    Route::match(['get', 'post'], '/admin/add_cms_page', 'CmsPagesController@addCmsPage');

    //View CMS Pages
    Route::get('/admin/view_cms_pages', 'CmsPagesController@viewCmsPages');

    //Delete CMS Page
    Route::match(['get', 'post'], '/admin/delete_cms_page/{id}', 'CmsPagesController@deleteCmsPage');

    //Edit CMS Page
    Route::match(['get', 'post'], '/admin/edit_cms_page/{id}', 'CmsPagesController@editCmsPage');


    

});


Route::get('/logout', 'AdminController@logout');



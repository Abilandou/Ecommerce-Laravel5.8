<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //One order having multiple ordered products
    //Pass in the order_id which is the key for the order and the products table.
    public function orders(){
        return $this->hasMany('App\OrdersProduct', 'order_id');
    }

    //Create a static function to get order details
    public static function getOrderDetails($order_id){
        $getOrderDetails = Order::where('id',$order_id)->first();
        return $getOrderDetails;
    }
}

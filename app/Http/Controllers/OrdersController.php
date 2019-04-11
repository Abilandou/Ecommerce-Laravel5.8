<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use Auth;
use App\Order;
use App\User;
use App\DeliveryAddress;
use App\Product;
use Session;
use DB;
use App\OrdersProduct;
use App\OrdersStatus;

class OrdersController extends Controller
{
    //

    public function addOrderStatus(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $orderStatus = new OrdersStatus();

            if(empty($data['status_name'])){
                return redirect()->back()->with('flash_message_error', 'Fill required(*) fields, Status name is missing');
            }
            $orderStatus->status_name = $data['status_name'];
            $orderStatus->status_description = $data['status_description'];
           
            //check if Status already exists
            $StatusCheck= OrdersStatus::where('status_name', $orderStatus->status_name)->first();               
                if($StatusCheck){
                    //if Status alredy exists
                    return redirect('/admin/add_order_status')->with('flash_message_error', 'Status name already exists');
                }
            $orderStatus->save();

            return redirect('/admin/view_order_status')->with('flash_message_success', 'Order Status added Successfully');
        }

        return view('admin.orders.add_order_status');

    }

    public function viewOrderStatus(){
        $orderStatus = OrdersStatus::get();
        return view('admin.orders.view_order_status')->with(compact('orderStatus'));

    }

    public function editOrderStatus(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();

            OrdersStatus::where(['id'=>$id])->update([
                                        'status_name'=>$data['status_name'],
                                        'status_description'=>$data['status_description']
                                    ]);
            return redirect('/admin/view_order_status')->with('flash_message_success', 'Order Status updated Successfully'); 
        }
        $orderStatusDetails = OrdersStatus::where(['id'=>$id])->first();
        return view('admin.orders.edit_order_status')->with(compact('orderStatusDetails'));
    }

    public function deleteOrderStatus($id = null){
        if(!empty($id)){
            OrdersStatus::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Order Status deleted successfully');
        }else{
            return redirect()->back()->with('flash_message_error', 'Order Status Not deleted ');
        }

    }

    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id', $user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        
        //Get cart information
        $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
        //  echo "<pre>"; print_r($userCart); die;
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image; 
        }
        // echo "<pre>"; print_r($userCart); die;

        return view('userOrders.review_order')->with(compact('userDetails', 'shippingDetails', 'userCart'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email; 

            //Get shipping details
            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();
            
            //Check if coupon code and coupon amount are empty
            if(empty(Session::get('CouponCode'))){
                $coupon_code = '';
            }else{
                $coupon_code = Session::get('CouponCode');
            }
            if(empty(Session::get('CouponAmount'))){
               $coupon_amount  = '';
            }else{
                $coupon_amount = Session::get('CouponAmount');
            }
            if(empty($data['order_status'])){
                $data['order_status'] = '';
            }
            if(empty($data['payment_method'])){
                $data['payment_method'] = '';
            }

            //Insert shipping details in order table.
            $order = new Order();
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->last_name = $shippingDetails->last_name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->country = $shippingDetails->country;
            $order->pincode = $shippingDetails->pincode;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            //get the last inserted order
            $order_id = DB::getPdo()->lastInsertId();

            //Search the cart products
            $cartProducts = DB::table('carts')->where(['user_email'=>$user_email])->get();

            //loop through and get each cart product
            foreach($cartProducts as $pro){
                //get cart product
                $cartPro = new OrdersProduct();

                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_size = $pro->size;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_price = $pro->price;
                $cartPro->product_quantity = $pro->quantity;

                $cartPro->save();

            }
            Session::put('order_id', $order_id);
            Session::put('grand_total',$data['grand_total']);

            if($data['payment_method'] =='COD'){

            $productDetails = Order::with('orders')->where('id',$order_id)->first();
            $userDetails = User::where('id',$user_id)->first();    
            

            /* Send Email to users about their order they have made */
                // $email = $user_email;
                // $messageData = [
                //     'email'=>$email,
                //     'name'=>$shippingDetails->name,
                //     'last_name'=>$shippingDetails->last_name,
                //     'order_id'=>$order_id,
                //     'productDetails'=>$productDetails,
                //     'userDetails'=>$userDetails
                // ];
                // Mail::send('emails.order', $messageData, function($message) use($email){
                //     $message->to($email)->subject('order You Placed Ecom-Site');
                // });

            /* End of Send Email to users about their order they have made */


                //COD-Redirect User to thanks page after saving order
                return redirect('/thanks');
            }else{
                return redirect('/paypal');
            }
        }
    }

    public function thanks(Request $request){
        //Get user email inorder to delete user items from cart after placing order
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();

        return view('userOrders.thanks');
    }

    public function userOrders(){
        $user_id = Auth::user()->id;

        //Combine with the order model
        $userOrdersMade = Order::with('orders')->where('user_id',$user_id)->orderBy('id', 'DESC')->get();
        return view('userOrders.users_orders')->with(compact('userOrdersMade'));
    }

    public function deleteOrder($id = null){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
       if(!empty($id) && !empty($user_id) && !empty($user_email) ){
           Order::with('orders')->where(['id'=>$id, 'user_id'=>$user_id, 'user_email'=>$user_email])->delete();
           
           return redirect()->back()->with('flash_message_success', 'Order deleted successfully');
       }else{
           return redirect()->back()->with('flash_message_error', 'Order Not deleted ');
       }
   }

   //Order invoice
   public function viewOrderInvoice($order_id, $id=null){
    $orderDetails = Order::with('orders')->where('id',$order_id)->first();
    $orderDetails = json_decode(json_encode($orderDetails));
    // echo "<pre>"; print_r($orderDetails); die;
    $user_id = $orderDetails->user_id;
    $userDetails = User::where('id',$user_id)->first();
    if(empty($orderDetails) || empty($user_id) || empty($userDetails) ){
        abort(404);
    }

     //Get Order Status from order_status table
     $orderStatus = OrdersStatus::get();

     //Get a single order status
     $singleOrder = OrdersStatus::where('id',$id)->get();
    
    return view('admin.orders.order_invoice')->with(compact('orderDetails', 'userDetails', 'orderStatus', 'singleOrder'));
}

    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        // $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        return view('userOrders.user_order_details')->with(compact('orderDetails'));
    }

    public function paypalPayment(Request $request){
        //Get user email inorder to delete user items from cart after placing order
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();

        return view('userOrders.paypal');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;



class CouponsController extends Controller
{
    //
    public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
          
            $coupon = new Coupon();
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = $data['status'];


            $coupon->save();
           return redirect('/admin/view_coupons')->with('flash_message_success', 'Coupon code added successfully');
        }
        // else{
        //     return redirect('admin.coupons.add_coupon')->with('flash_message_error', 'Error adding Coupon code');
        // }

        return view('admin.coupons.add_coupon');
    }

    public function viewCoupons(){
        $allCoupons = Coupon::get();
        return view('admin.coupons.view_coupons')->with(compact('allCoupons'));
    }

    public function editCoupon(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = Coupon::find($id);
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            $coupon->status = $data['status'];
            $coupon->save();
            return redirect()->action('CouponsController@viewCoupons')
                             ->with('flash_message_success', 'Cupon updated successfully');
        }
        $couponDetails = Coupon::find($id);
       return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }

    public function deleteCoupon($id = null){
        if(!empty($id)){
           Coupon::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Coupon deleted successfully');
        }
    }
}


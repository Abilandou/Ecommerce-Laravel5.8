@extends('layouts.frontLayout.front_design')
@section('content')

<?php use App\Order; ?>
<section>
    <div class="container">
        <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Thanks</li>
                </ol>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
        <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2"></div>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 cart-payment">
                <h4>Thanks Your order have been placed successfully</h4>
                <p><a href="/orders" class="text-primary">Check your order</a> to confirm</p>
                <p>Your order number is: {{ Session::get('order_id') }} and total payable is: 
                    ${{ Session::get('grand_total') }}
                </p>
                <p>Continue with Paypal payment by clicking the Paynow button below</p>

                <?php 
                    $ordeDetails = Order::getOrderDetails(Session::get('order_id'));
                    $ordeDetails = json_decode(json_encode($ordeDetails));
                    // echo "<pre>"; print_r($ordeDetails); die;
                    // $nameArr = explode(' ',$ordeDetails->name );
                ?>

                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" class="cart-payment">
                    {{ csrf_field() }}
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="godloveabilandou-facilitator@gmail.com">
                    <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
                    <input type="hidden" name="item_number" value="{{ Session::get('order_id') }}">
                    <input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
                    <input type="text" name="name" value="{{ $ordeDetails->name }}">
                    <input type="text" name="last_name" value="{{ $ordeDetails->last_name }}">
                    <input type="text" name="address" value="address">
                    <input type="text" name="state" value="state">
                    <input type="text" name="city" value="city">
                    <input type="text" name="country" value="country">
                    <input type="text" name="pincode" value="pincode">
                    <input type="text" name="mobile" value="mobile">
                    <input type="hidden" name="currency_code" value="USD">
                     
                    <input type="hidden" name="bn" value="PP-BuyNowBF">
                    <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
                    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
        <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2"></div>
    </div>
</section>


@endsection
<?php 
Session::forget('grand_total'); 
Session::forget('order_id');
?>
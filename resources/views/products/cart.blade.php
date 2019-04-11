@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif         
        @if(Session::has('flash_message_success'))
            <div class="alert alert-error alert-block" style="background-color:lightblue;">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif       
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="item">Item</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td class="delete">Remove Item</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_amount = 0;?>
                    @foreach($userCart as $cart)
                    <tr>
                        <td class="cart_product">
                            <a title="Click to order more of this product with a different size" href="{{ url('/product/'.$cart->product_id) }}">
                                <img id="cartImage" width="80px" height="80px" src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt="">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart->product_name}}</a></h4>
                            <p>{{$cart->product_code}} | {{$cart->size}} </p>
                        </td>
                        <td class="cart_price">
                            <p>${{$cart->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{ url('/cart/update_quantity/'.$cart->id.'/1') }}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}" autocomplete="off" size="2">
                               @if($cart->quantity > 1)
                                <a class="cart_quantity_down" href="{{ url('/cart/update_quantity/'.$cart->id.'/-1') }}"> - </a>
                               @endif
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$cart->price * $cart->quantity }}</p>
                        </td>
                        <td class="cart_delete">
                            <span><a class="cart_quantity_delete" href="{{ url('/cart/delete_product/'.$cart->id) }}"><i class="fa fa-times"><b>X</b></i></a></span>
                        </td>
                    </tr>
                    <?php $total_amount = $total_amount + ($cart->price * $cart->quantity); ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a coupon code you want to use</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <form method="post" action="{{url('/cart/apply_coupon')}}" name="apply_couponForm" id="apply_couponForm" >

                               {{csrf_field()}}
                                <label>Coupon Code: </label>
                                <input type="text" required name="coupon_code">
                                <input type="submit" value="Apply" class="btn btn default">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                    @if(!empty(Session::get('CouponAmount')))
                         <li>Sud Total <span>$<?php echo $total_amount; ?></span></li>
                         <li>Coupon Discount <span>$<?php echo Session::get('CouponAmount'); ?></span></li>
                        <li>Grand Total <span>$<?php echo $total_amount - Session::get('CouponAmount'); ?></span></li> 
                    @else
                        <li>Grand Total <span>$<?php echo ($total_amount); ?></span></li>
                    @endif
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{ url('/checkout') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->


@endsection
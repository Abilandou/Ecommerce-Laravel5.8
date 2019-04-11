@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Review Order</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Billing Details</h2>
                    <div class="form-group">
                        {{$userDetails->name}}
                    </div>
                    <div class="form-group">
                        {{$userDetails->last_name}}
                    </div>
                    <div class="form-group">
                        {{$userDetails->address}}
                    </div>
                    <div class="form-group">
                        {{$userDetails->city}}
                    </div>
                    <div class="form-group">
                        {{$userDetails->state}}
                    </div>
                    <div class="form-group">
                        {{$userDetails->country }}
                    </div>
                    <div class="form-group">
                        {{$userDetails->pincode}}
                    </div>
                    <div class="form-group">
                        {{$userDetails->mobile}}
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>Shipping Details</h2>
                    <div class="form-group">
                    {{$shippingDetails->name}}
                    </div>
                    <div class="form-group">
                        {{$shippingDetails->last_name}}
                    </div>
                    <div class="form-group">
                        {{$shippingDetails->address}}
                    </div>
                    <div class="form-group">
                        {{$shippingDetails->city}}
                    </div>
                        <div class="form-group">
                        {{$shippingDetails->state}}
                    </div>
                    <div class="form-group">
                        {{$shippingDetails->country }}         
                        </div>
                    <div class="form-group">
                        {{$shippingDetails->pincode}}
                    </div>
                    <div class="form-group">
                        {{$shippingDetails->mobile}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Review Order</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

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
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Cart Sub Total</td>
                                <td>${{ $total_amount }}</td>
                            </tr>
                            <tr class="shipping-cost">
                                <td>Shipping Cost (+)</td>
                                <td>Free</td>										
                            </tr>
                            <tr class="discount">
                                <td>Discount (-)</td>
                                <td>
                                    @if(!empty( Session::get('CouponAmount')))
                                        ${{ Session::get('CouponAmount') }}
                                    @else
                                        $0
                                    @endif
                                </td>										
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td><span>${{ $grand_total =  $total_amount -  Session::get('CouponAmount') }}</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
            <form name="paymentForm" id="paymentForm" action="{{ url('/place_order') }}" method="post">
                {{ csrf_field() }}

                <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                <div class="payment-options">
                    <span>
                        <label><strong>Select Payment Method</strong></label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_method" id="COD" value="COD"><strong> COD</strong></label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_method" id="Paypal" value="Paypal"><strong> Paypal</strong></label>
                    </span>
                    <span style="float:right;">
                        <button id="paymentSelectSubmit" type="submit" class="btn btn-success">Place Order</button>
                    </span>
                    <span id="errorPayment"></span>
                </div>
            </form>
          
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection
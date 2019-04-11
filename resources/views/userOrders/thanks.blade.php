@extends('layouts.frontLayout.front_design')
@section('content')


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
                <h4>Thanks Your order have been place successfully</h4>
                
                <p>Payment Method COD </p>
                <p><a href="/orders" class="text-primary">Check your order</a> to confirm</p>
                <p>Your order number is: {{ Session::get('order_id') }} and total payable is: 
                    ${{ Session::get('grand_total') }}
                </p>
                
            </div>
            <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2"></div>
        </div>
    </div>
</section>


@endsection
<?php 
Session::forget('grand_total'); 
Session::forget('order_id');
?>
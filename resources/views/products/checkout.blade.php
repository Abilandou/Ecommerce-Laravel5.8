@extends('layouts.frontLayout.front_design')
@section('content')


<section id="form"><!--form-->
    <div class="container">
    <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">check out</li>
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
     <form action="{{ url('/checkout') }}" method="post"  id="billingShipping" name="billingShipping">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--Billing form-->
                    <h2>Bill TO</h2>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" 
                            name="billing_name" 
                            id="billing_name"
                            @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif
                            class="form-control" 
                            placeholder="Billing Name" />
                    </div>
                     <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" 
                            name="billing_last_name" 
                            id="billing_last_name"
                            @if(!empty($userDetails->last_name)) value="{{$userDetails->last_name}}" @endif
                            class="form-control" 
                            placeholder="Billing Name" />
                    </div> 
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" 
                            name="billing_address" 
                            id="billing_address" 
                            @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif 
                            class="form-control" 
                            placeholder="Billing Address" >
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" 
                            name="billing_city" 
                            id="billing_city" 
                            @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif 
                            class="form-control" 
                            placeholder="Billing City" >
                    </div>
                        <div class="form-group">
                        <label>State</label>
                        <input type="text" 
                            name="billing_state" 
                            id="billing_state" 
                            @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif 
                            class="form-control" 
                            placeholder="Billing State" >
                    </div>
                    <div class="form-group">
                            <label>Country</label>
                            <select id="billing_country" name="billing_country" required >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->country_name }}" 
                                        @if(!empty( $userDetails->country) && 
                                            $country->country_name == $userDetails->country ) selected @endif>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" 
                            name="billing_pincode" 
                            id="billing_pincode" 
                            @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif 
                            class="form-control" 
                            placeholder="Billing Pincode" >
                    </div>
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" 
                            name="billing_mobile" 
                            id="billing_mobile" 
                            @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif  
                            class="form-control" 
                            placeholder="Billing Mobile" >
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="sameAddress">
                        <label id="sameAddress" for="sameAddress" class="form-check-label">
                            shipping Address same as Billing Address
                        </label>
                    </div>

                </div><!--/Billing form-->
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--Shipping form-->
                    <h2>Ship To</h2>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" 
                            @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif
                            name="shipping_name" id="shipping_name" 
                            class="form-control" 
                            placeholder="Shipping Name" />
                    </div>
                     <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" 
                            @if(!empty($shippingDetails->last_name)) value="{{$shippingDetails->last_name}}" @endif
                            name="shipping_last_name" id="shipping_last_name" 
                            class="form-control" 
                            placeholder="Shipping Last  Name" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" 
                            @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif
                            name="shipping_address" 
                            id="shipping_address" 
                            class="form-control" 
                            placeholder="Shipping Address" >
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" 
                        @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif
                            name="shipping_city" 
                            id="shipping_city"  
                            class="form-control" 
                            placeholder="Shipping City" >
                    </div>
                        <div class="form-group">
                        <label>State</label>
                        <input type="text" 
                        @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif
                            name="shipping_state" 
                            id="shipping_state" 
                            class="form-control" 
                            placeholder="Shipping State" >
                    </div>
                    <div class="form-group">
                            <label>Country</label>
                            <select id="shipping_country" name="shipping_country" required >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->country_name }}" 
                                        @if(!empty( $shippingDetails->country) && 
                                            $country->country_name == $shippingDetails->country ) selected @endif>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" 
                        @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif
                            name="shipping_pincode" 
                            id="shipping_pincode" 
                            class="form-control" 
                            placeholder="Shipping Pincode" >
                    </div>
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" 
                        @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif
                            name="shipping_mobile" 
                            id="shipping_mobile" 
                            class="form-control" 
                            placeholder="Shipping Mobile" >
                    </div>
 
                        <button type="submit" class="btn btn-default">check Out</button>
                </div><!--/Shipping form-->
            </div>
        </div>
    </form>
    </div>
</section><!--/form-->



@endsection
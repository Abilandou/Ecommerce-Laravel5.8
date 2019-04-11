@extends('layouts.adminLayout.admin_design')
@section('content')



<!--main-container-part-->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
        <h1>Order #{{ $orderDetails->id }}</h1>
    </div>
    <div class="container-fluid">
        <hr>
        @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
        @endif         
        @if(Session::has('flash_message_success'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
        @endif       
        <div class="row-fluid">
            <div class="span6">
            <div class="widget-box">
                <div class="widget-title">
                <h5>Order Details</h5>
                </div>
                <div class="widget-content nopadding">
                <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                        <td class="taskDesc">Order Date/Time</td>
                        <td class="taskStatus"><span class="text-primary">{{ $orderDetails->created_at }}</span></td>
                    </tr>
                    <tr>
                        <td class="taskDesc">Order Status</td>
                        <td class="taskStatus"><span class="text-info">{{ $orderDetails->order_status }}</span></td>
                    </tr>
                    <tr>
                        <td class="taskDesc">Total Amount To Pay</td>
                        <td class="taskStatus"><span class="text-info">${{ $orderDetails->grand_total }}</span></td>
                    </tr>
                    <tr>
                        <td class="taskDesc">Shipping Charges</td>
                        <td class="taskStatus"><span class="text-info">${{ $orderDetails->shipping_charges }}</span></td>
                    </tr>
                    <tr>
                        <td class="taskDesc">Coupon Code</td>
                        <td class="taskStatus">
                            <span class="text-info">
                                <?php  
                                    if(empty($orderDetails->coupon_code)){
                                        echo "No Coupon for this order";
                                    }else{
                                        echo ($orderDetails->coupon_code);
                                    }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="taskDesc">Coupon Amount</td>
                        <td class="taskStatus"><span class="text-info">${{ $orderDetails->coupon_amount }}</span></td>
                    </tr>
                    <tr>
                        <td class="taskDesc">Payment Method</td>
                        <td class="taskStatus"><span class="text-info">{{ $orderDetails->payment_method }}</span></td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <h5>Billing Address</h5>
                        </div>
                    </div>
                    <div class="collapse in accordion-body" id="collapseGOne">
                        <div class="widget-content"> 
                            <table class="table table-responsive table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td>First Name</td>
                                        <td>{{$userDetails->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td>{{$userDetails->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{$userDetails->address}}</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>{{$userDetails->state}}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{$userDetails->city}}</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>{{$userDetails->country}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pincode</td>
                                        <td>{{$userDetails->pincode}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>{{$userDetails->mobile}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title">
                    <h5>Customer Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td class="taskDesc">First Name</td>
                            <td class="taskStatus"><span class="text-primary">{{ $orderDetails->name }}</span></td>
                        </tr>
                        <tr>
                            <td class="taskDesc">Last Name</td>
                            <td class="taskStatus"><span class="text-primary">{{ $orderDetails->last_name }} </span></td>
                        </tr>
                        <tr>
                            <td class="taskDesc">Email</td>
                            <td class="taskStatus"><span class="text-info">{{ $orderDetails->user_email }}</span></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Update Order Status</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="{{ url('/admin/update_order_status') }}" method="post">
                            {{csrf_field()}}
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                                        </td>
                                        <td>
                                            <div class="form-group" >
                                                <label>Select Order Status</label>
                                                <select name="order_status" id="order_status" class="control-label" required>
                                                    @foreach($orderStatus as $ordstatus)
                                                        <option value="{{ $ordstatus->status_name }}" >{{ $ordstatus->status_name }}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-top:22px;">
                                                <input type="submit" style="border-radius:20px; border-color:green; border-width:2px;" value="Update Status" class="btn btn-default btn-md" id="update_status">
                                            </div>
                                        </td>
                                   <tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                        <h5>Shipping Address</h5>
                        </div>
                    </div>
                <div class="collapse in accordion-body" id="collapseGOne">
                    <div class="widget-content"> 
                    <table class="table table-responsive table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>First Name</td>
                                <td>{{$orderDetails->name}}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{$orderDetails->last_name}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$orderDetails->address}}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{$orderDetails->state}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$orderDetails->city}}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{$orderDetails->country}}</td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>{{$orderDetails->pincode}}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{$orderDetails->mobile}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>
            </div>
        </div>
        
        <div class="row-fluid text-primary">
            <h4 style="margin-left:30%;" >Product Details</h4>
        </div>
        <div class="row-fluid">
            <table id="userOrderstable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="btn-primary text-center">Product Code</th>
                        <th class="btn-success text-center">Product Name</th>
                        <th class="btn-info text-center">Product Size</th>
                        <th class="btn-warning text-center">Product Colo</th>
                        <th class="btn-danger text-center">Product Price</th>
                        <th class="btn-default text-center">Product Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetails->orders as $proDet)
                    <tr>
                        <td class="text-center">{{ $proDet->product_code }}</td>
                        <td class="text-center">{{ $proDet->product_name }} </td>
                        <td class="text-center">{{ $proDet->product_size }} </td>
                        <td class="text-center">{{ $proDet->product_color }} </td>
                        <td class="text-center">${{ $proDet->product_price }} </td>
                        <td class="text-center">{{ $proDet->product_quantity }} </td>
                    </tr>
                    @endforeach  
                </tbody> 
            </table>
        </div>
    </div>
</div>
<!--main-container-part-->



@endsection
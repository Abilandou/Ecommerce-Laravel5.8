@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Orders</a> <a href="#" class="current">view Orders</a> 
  </div>
    
    <h1>Orders</h1>
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
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
         
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>Order ID</th>
                    <th>Customer First Name</th>
                    <th>Ordered Products</th>
                    <th>Customer Email</th>
                    <th>Amount(USD)</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($allOrders as $order)
                    <tr class="gradeX center">
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>
                            @foreach($order->orders as $orderPro)
                                {{$orderPro->product_name}}, {{$orderPro->product_code}}
                            @endforeach
                        </td>

                        <td>{{$order->user_email}}</td>
                        <td>${{$order->grand_total}}</td>
                        <td class="center">
                            <a style="margin-bottom:5px;" href="{{ url('/admin/view_order/'.$order->id) }}" class="btn btn-success btn-mini" title="See Order's Complete Imformation">view Order Details</a> 
                            <a style="margin-bottom:5px;" href="{{ url('/admin/view_order_invoice/'.$order->id) }}" class="btn btn-primary btn-mini" title="See Order's Invoice">view Order Invoice</a> 
                            <a  rel="{{ $order->id }}" rel1="delete_order" href="javascript:" <?php /*href="{{ url('admin/delete_order/'.$order->id) }}"*/?>
                               class="btn btn-danger btn-mini deleteRecord" title="Delete This Order">Delete this order</a>
                        </td>
                    </tr> 
                     @endforeach
                   

                   
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

  

</div>

@endsection
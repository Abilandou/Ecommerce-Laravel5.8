@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Coupons</a> <a href="#" class="current">view Coupons</a> 
  </div>
    
    <h1>Coupons</h1>
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
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Coupons</h5><a href="/admin/add_coupon" style="margin-left:65%; margin-top:2px;"  class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add Coupon</a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>Coupon ID</th>
                    <th>Coupon Code</th>
                    <th>Amount</th>
                    <th>Amount Type</th> 
                    <th>Expiry Date</th> 
                    <th>Created Date</th> 
                    <th>Status</th> 
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allCoupons as $coupon)
                    <tr class="gradeX">
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->coupon_code }}</td>
                        <td>
                          {{ $coupon->amount }}
                          @if($coupon->amount_type == "Percentage") % @else $ @endif
                        </td>
                        <td>{{ $coupon->amount_type }}</td>
                        <td>{{ $coupon->expiry_date }}</td>
                        <td>{{ $coupon->created_at }}</td>
                        <td>
                            <?php 
                              if($coupon->status =="1") {
                               echo "Active";
                              }else{
                                echo "In Active";
                              } 
                            ?>
                        </td>
                        <td class="center">
                            <a href="{{ url('admin/edit_coupon/'.$coupon->id) }}" class="btn btn-primary btn-mini" title="Edit This Coupon">Edit</a>
                            <a rel="{{ $coupon->id }}" rel1="delete_coupon" href="javascript:" 
                               class="btn btn-danger btn-mini deleteRecord" title="Delete This coupon">Delete</a>
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


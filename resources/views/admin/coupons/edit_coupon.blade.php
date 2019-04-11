@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">coupons</a> <a href="#" class="current">Edit Coupon</a> </div>
    <h1>Edit Coupon</h1>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Coupon</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit_coupon/'.$couponDetails->id) }}" name="edit_coupon" id="edit_coupon">
                {{ csrf_field() }}

                <div class="control-group">
                  <label>Required fields(<span style="color:red;">*</span>)</label>
                </div>
                
              <div class="control-group">
                <label class="control-label">Coupon Code<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required
                    name="coupon_code" 
                    id="coupon_code" 
                    value="{{ $couponDetails->coupon_code }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Amount<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="number" 
                    required
                    name="amount" 
                    id="amount" 
                    min="1"
                    max="10000000" 
                    value="{{ $couponDetails->amount }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Amount Type<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <select name="amount_type" id="amount_type">
                    <option value="Percentage" @if($couponDetails->amount_type=="Percentage") selected @endif>Percentage</option>
                    <option value="Fixed" @if($couponDetails->amount_type=="Fixed") selected @endif>Fixed</option>
                  </select>
                </div>
              </div> 

              <div class="control-group">
                <label class="control-label">Expiry Date<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="date" 
                    required
                    name="expiry_date" 
                    id="expiry_date" 
                    value="{{ $couponDetails->expiry_date }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                  <input type="checkbox" 
                    name="status"
                    id="status"
                    @if($couponDetails->status=="1") checked @endif value="1"
                  >
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Confirm Edit" class="btn btn-success">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
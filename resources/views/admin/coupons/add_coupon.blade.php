@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">coupons</a> <a href="#" class="current">Add coupons</a> </div>
    <h1>Add Coupon</h1>
    @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>{!! session('flash_message_error') !!}</strong>
      </div>
    @endif         
    @if(Session::has('flash_message_success'))
      <div class="alert alert-success alert-block">
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
            <h5>Add Coupon</h5><a href="/admin/view_coupons" style="margin-left:65%; margin-top:2px;" class="btn btn-primary btn-sm">View Coupons</a>
          </div>

          <div class="widget-content nopadding">
            <form class="form-horizontal " method="post" action="{{ url('/admin/add_coupon') }}" name="add_coupon" id="add_coupon" >
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
                    minlength="5"
                    maxlength="15"
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
                    >
                </div>
              </div>

              <div class="control-group" style="width:450px;">
                <label class="control-label">Amount Type<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <select name="amount_type" id="amount_type">
                    <option value="Percentage">Percentage</option>
                    <option value="Fixed">Fixed</option>
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
                    autocomplete="off"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox"  
                    name="status" 
                    id="status" 
                    value="1"
                    required
                    >
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Coupon" id="add_coupon" class="btn btn-success ">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
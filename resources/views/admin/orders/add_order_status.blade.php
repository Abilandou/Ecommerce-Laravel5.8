@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">order_status</a> <a href="#" class="current">Add Order Status</a> </div>
    <h1>Add Order Status</h1>
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
            <h5>Add Order Status</h5> <a href="/admin/view_order_status" style="margin-left:65%; margin-top:2px;" class="btn btn-primary btn-sm">View Order Status</a>
          </div>

          <div class="widget-content nopadding">
            <form class="form-horizontal add_order_status " method="post" action="{{ url('/admin/add_order_status') }}" name="add_order_status" id="add_order_status">
                {{ csrf_field() }}

              <div class="control-group">
                <label class="control-label">Status Name<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" name="status_name" required id="status_name">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Status Description</label>
                <div class="controls">
                  <textarea type="text" name="status_description" id="status_description"></textarea>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Order Status" id="add_order_status" class="btn btn-success">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">order status</a> <a href="#" class="current">Edit Order Status</a> </div>
    <h1>Edit Order Status</h1>
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
            <h5>Edit Order Status</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit_order_status/'.$orderStatusDetails->id) }}" name="edit_order_status" id="edit_order_status">
                {{ csrf_field() }}
                
              <div class="control-group">
                <label class="control-label">Status Name</label>
                <div class="controls">
                  <input type="text" 
                    required
                    name="status_name" 
                    id="status_name" 
                    value="{{ $orderStatusDetails->status_name }}"
                    >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Status Description</label>
                <div class="controls">
                  <textarea type="text" 
                    name="status_description" 
                    id="status_description"
                    required
                  >
                  {{ $orderStatusDetails->status_description }}
                  </textarea>
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Edit Order Status" class="btn btn-success">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
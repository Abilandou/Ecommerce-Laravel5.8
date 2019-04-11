@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">banners</a> <a href="#" class="current">Add banners</a> </div>
    <h1>Add Banner</h1>
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
            <h5>Add Banner</h5><a href="/admin/view_banners" style="margin-left:65%; margin-top:2px;" class="btn btn-primary btn-sm">View Banners</a>
          </div>

          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal " method="post" action="{{ url('/admin/add_banner') }}" name="add_banner" id="add_banner" >
                {{ csrf_field() }}
              <div class="control-group">
                <label>Required fields(<span style="color:red;">*</span>)</label>
              </div>

              <div class="control-group">
                <label class="control-label">Banner Image</label>
                <div class="controls">
                  <div class="uploader" id="uniform-undefined">
                    <input name="image" required type="file" size="19" style="opacity: 1;">
                    <span class="filename" style="-moz-user-select: none;">No Image file selected</span>
                    <span class="action" style="-moz-user-select: none;">Choose Image File</span>
                  </div>
                </div>
            </div>

              <div class="control-group">
                <label class="control-label">Banner Title<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="title" 
                    id="title">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Banner Link<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="link" 
                    id="link">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox"
                   
                    name="status" 
                    id="status" 
                    value="0">
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Banner" id="add_banner" class="btn btn-success ">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
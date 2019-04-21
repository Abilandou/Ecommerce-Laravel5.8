@extends('layouts.adminLayout.admin_design')

@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">categories</a> <a href="#" class="current">Add Categories</a> </div>
    <h1>Add Category</h1>
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
            <h5>Add Category</h5> <a href="/admin/view_categories" style="margin-left:65%; margin-top:2px;" class="btn btn-primary btn-sm">View Categories</a>
          </div>

          <div class="widget-content nopadding">
            <form class="form-horizontal add_category " method="post" action="{{ url('/admin/add_category') }}" name="add_category" id="add_category">
                {{ csrf_field() }}

              <div class="control-group">
                <label class="control-label">Category Name<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" name="category_name" required id="category_name">
                </div>
              </div>

              <div class="control-group" style="width:450px;">
                <label class="control-label">Category Level</label>
                <div class="controls">
                  <select name="parent_id">
                    <option  required value="0">Main Category</option>
                    @foreach($levels as $val)
                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Category Description</label>
                <div class="controls">
                  <textarea type="text" required name="description" id="description"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Title</label>
                <div class="controls">
                  <input type="text" required name="meta_title" id="meta_title">
                </div>
              </div

              <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <input type="text" required name="meta_description" id="meta_description">
                </div>
              </div

              <div class="control-group">
                <label class="control-label">Meta KeyWord</label>
                <div class="controls">
                  <input type="text" required name="meta_keyword" id="meta_keyword">
                </div>
              </div

              <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                  <input type="text" required name="url" id="url">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Category" id="add_category" class="btn btn-success">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
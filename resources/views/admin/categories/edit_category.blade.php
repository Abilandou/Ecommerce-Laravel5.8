@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">categories</a> <a href="#" class="current">Edit Category</a> </div>
    <h1>Edit Category</h1>
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
            <h5>Edit Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit_category/'.$categoryDetails->id) }}" name="edit_category" id="edit_category">
                {{ csrf_field() }}
                
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" 
                    required
                    name="category_name" 
                    id="category_name" 
                    value="{{ $categoryDetails->name }}"
                    >
                </div>
              </div>

              <div class="control-group" style="width:450px;">
                <label class="control-label">Category Level</label>
                <div class="controls">
                <select name="parent_id">
                    <option value="0">Main Category</option>
                    @foreach($levels as $val)
                    <option required value="{{ $val->id }}"
                        @if($val->id == $categoryDetails->parent_id)
                          selected
                        @endif
                    >{{ $val->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea type="text" 
                    name="description" 
                    id="description"
                    required
                  >
                  {{ $categoryDetails->description }}
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Title</label>
                <div class="controls">
                  <input type="text" 
                    name="meta_title" 
                    required
                    id="meta_title"
                    value="{{ $categoryDetails->meta_title }}"
                  >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <input type="text" 
                    name="meta_description" 
                    required
                    id="meta_description"
                    value="{{ $categoryDetails->meta_description }}"
                  >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Keyword</label>
                <div class="controls">
                  <input type="text" 
                    name="meta_keyword" 
                    required
                    id="meta_keyword"
                    value="{{ $categoryDetails->meta_keyword }}"
                  >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                  <input type="text" 
                    name="url" 
                    required
                    id="url"
                    value="{{ $categoryDetails->url }}"
                  >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" 
                    name="status"
                    id="status"
                    @if($categoryDetails->status=="1") checked @endif value="1"
                  >
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Edit Category" class="btn btn-success">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
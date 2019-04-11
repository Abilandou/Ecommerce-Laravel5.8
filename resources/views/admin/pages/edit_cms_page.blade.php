@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">cms pages</a> <a href="#" class="current">Edit Cms Page</a> </div>
    <h1>Edit Cms Page</h1>
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
            <h5>Edit Cms Page</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit_cms_page/'.$cmsPageDetails->id) }}" name="edit_cms_page" id="edit_cms_page">
                {{ csrf_field() }}
                
              <div class="control-group">
                <label class="control-label">Page Title</label>
                <div class="controls">
                  <input type="text" 
                    required
                    name="title" 
                    id="title" 
                    value="{{ $cmsPageDetails->title }}"
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
                    value="{{ $cmsPageDetails->url }}"
                  >
                </div>

              <div class="control-group">
                <label class="control-label">Page Description(Body)</label>
                <div class="controls">
                  <textarea type="text" 
                    name="description" 
                    id="description"
                    required
                    cols="400"
                    rows="10"
                  >
                  {{ $cmsPageDetails->description }}
                  </textarea>
                </div>
              </div>

              </div>
              <div class="control-group">
                <label class="control-label">Publish</label>
                <div class="controls">
                  <input type="checkbox" 
                    name="status"
                    id="status"
                    @if($cmsPageDetails->status=="1") checked @endif value="1"
                  >
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Edit Cms Page" class="btn btn-success">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
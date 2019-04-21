@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">cms pages</a> <a href="#" class="current">Add Cms Page</a> </div>
    <h1>Add Cms Page</h1>
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
            <h5>Add Cms Page</h5><a href="/admin/view_cms_pages" style="margin-left:65%; margin-top:2px;" class="btn btn-primary btn-sm">View Cms Pages</a>
          </div>

          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal " method="post" action="{{ url('/admin/add_cms_page') }}" name="add_cms_page" id="add_cms_page" >
                {{ csrf_field() }}
              <div class="control-group">
                <label>Required fields(<span style="color:red;">*</span>)</label>
              </div>

              <div class="control-group">
                <label class="control-label">Cms Page Title<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="title" 
                    id="title">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Cms Page Url<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="url" 
                    id="url">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Title<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="meta_title" 
                    id="meta_title">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta keyword<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="meta_keyword" 
                    id="meta_keyword">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Description<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <textarea type="text" 
                    required 
                    style="width:250px;"
                    cols="20"
                    rows="5"
                    name="meta_description" 
                    id="meta_description">
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Cms Subtitle One<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="sub_title_one" 
                    id="sub_title_one">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description(Page Body One)<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <textarea type="text" 
                    required 
                    style="width:500px;"
                    cols="400"
                    rows="10"
                    required 
                    name="description" 
                    id="description">
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Cms Subtitle Two<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text"  
                    name="sub_title_two" 
                    id="sub_title_two">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description(Page Body Two)<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <textarea type="text" 
                    style="width:500px;"
                    cols="400"
                    rows="10"
                    name="content_two" 
                    id="content_two">
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Cms Subtitle Three<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    name="sub_title_three" 
                    id="sub_title_three">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description(Page Body Three)<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <textarea type="text" 
                    required 
                    style="width:500px;"
                    cols="400"
                    rows="10"
                    name="content_three" 
                    id="content_three">
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Publish</label>
                <div class="controls">
                  <input type="checkbox"  
                    name="status" 
                    id="status" 
                    value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Page" id="add_product" class="btn btn-success ">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
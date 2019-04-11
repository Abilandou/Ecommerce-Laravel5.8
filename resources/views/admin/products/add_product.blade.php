@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">products</a> <a href="#" class="current">Add products</a> </div>
    <h1>Add Product</h1>
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
            <h5>Add Product</h5><a href="/admin/view_products" style="margin-left:65%; margin-top:2px;" class="btn btn-primary btn-sm">View Products</a>
          </div>

          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal " method="post" action="{{ url('/admin/add_product') }}" name="add_product" id="add_product" >
                {{ csrf_field() }}
              <div class="control-group">
                <label>Required fields(<span style="color:red;">*</span>)</label>
              </div>

            <div class="control-group" style="width:450px;">
                <label class="control-label">Under Category<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <select name="parent_id">
                    <option value="0">Select Category</option>
                    @foreach($categories as $category)
                    <option required value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div> 

              <div class="control-group">
                <label class="control-label">Product Name<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="product_name" 
                    id="product_name">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Code<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="product_code" 
                    id="product_code">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Color<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required 
                    name="product_color" 
                    id="product_color">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <textarea type="text" 
                    required 
                    name="description" 
                    id="description">
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Material & Care</label>
                <div class="controls">
                  <textarea type="text" 
                    name="care" 
                    id="care">
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Price<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="number" 
                    required 
                    min="1"
                     max="10000000"
                     name="price" 
                     id="price">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Discount(As a percentage)</label>
                <div class="controls">
                  <input type="number" 
                    required 
                    min="1" 
                    max="100" 
                    name="discount" 
                    id="discount">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Add To Featured Items(on Home Page).</label>
                <div class="controls">
                  <input type="checkbox"  
                    name="featured_item" 
                    id="featured_item" 
                    value="1">
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

              <div class="control-group">
                <label class="control-label">Product Image</label>
                <div class="controls">
                  <div class="uploader" id="uniform-undefined">
                    <input name="image" required type="file" size="19" style="opacity: 1;">
                    <span class="filename" style="-moz-user-select: none;">No Image file selected</span>
                    <span class="action" style="-moz-user-select: none;">Choose Image File</span>
                  </div>
                </div>
            </div>

              <div class="form-actions">
                <input type="submit" value="Add product" id="add_product" class="btn btn-success ">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
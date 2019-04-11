@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">products</a> <a href="#" class="current">Edit Product</a> </div>
    <h1>Edit Product</h1>
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
            <h5>Edit Product</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit_product/'.$productDetails->id) }}" name="edit_product" id="edit_product">
                {{ csrf_field() }}

                <div class="control-group">
                  <label>Required fields(<span style="color:red;">*</span>)</label>
                </div>

                <div class="control-group" style="width:450px;">
                <label class="control-label">Product Category<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                <select name="category_id">
                    <option value="0">Select</option>
                    @foreach($levels as $val)
                    <option required value="{{ $val->id }}"
                        @if($val->id == $productDetails->category_id)
                          selected
                        @endif
                    >{{ $val->name }}</option>
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
                    id="product_name" 
                    value="{{ $productDetails->product_name }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Code<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required
                    name="product_code" 
                    id="product_code" 
                    value="{{ $productDetails->product_code }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Color<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="text" 
                    required
                    name="product_color" 
                    id="product_color" 
                    value="{{ $productDetails->product_color }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <textarea type="text" 
                    required
                    name="description" 
                    id="description"
                  >
                  {{ $productDetails->description }}
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Material & Care</label>
                <div class="controls">
                  <textarea type="text" 
                    name="care" 
                    id="care"
                  >
                  {{ $productDetails->care }}
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
                    id="price" 
                    value="{{ $productDetails->price }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Discount<span class="required" style="color:red;">*</span></label>
                <div class="controls">
                  <input type="number" 
                    required
                    min="1"
                    max="10000000"
                    name="discount" 
                    id="discount" 
                    value="{{ $productDetails->discount }}"
                    >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Publish</label>
                <div class="controls">
                  <input type="checkbox" 
                    name="status"
                    id="status"
                    @if($productDetails->status=="1") checked @endif value="1"
                  >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Add As Featured Item(on home page)</label>
                <div class="controls">
                  <input type="checkbox" 
                    name="featured_item"
                    id="featured_item"
                    @if($productDetails->featured_item=="1") checked @endif value="1"
                  >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Image</label>
              <div class="controls">
                <div class="uploader" id="uniform-undefined">
                  <input type="file" name="image"  id="image">
                  <input type="hidden" name="current_image"  value="{{ $productDetails->image }}"> 
                </div>
              </div>
            </div>
            <div class="form-control">
              @if(!empty($productDetails->image))
                  <img style="margin-left:35%;" src="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}"  /> 
                  <a href="{{ url('/admin/delete_product_image/'.$productDetails->id) }}"> Delete </a>
              @endif
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
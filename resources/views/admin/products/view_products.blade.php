@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Products</a> <a href="#" class="current">view Products</a> 
  </div>
    
    <h1>Products</h1>
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
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Products</h5><a href="/admin/add_product" style="margin-left:65%; margin-top:2px;"  class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add Product</a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>Product ID</th>
                    <th>status</th>
                    <th>Feature Item</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Price(USD)</th>
                    <th>Product Image</th> 
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="gradeX">
                        <td>{{ $product->id }}</td>
                        <td>
                            <?php 
                              if($product->status =="1") {
                               echo "Published";
                              }else{
                                echo "Not Published";
                              } 
                            ?>
                        </td> 
                        <td>
                            <?php 
                              if($product->featured_item =="1") {
                               echo "Featured";
                              }else{
                                echo "Not Featured";
                              } 
                            ?>
                        </td> 
                        <td>{{ $product->category_name }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_code }}</td>
                        <td>${{ $product->price }}</td>
                        <td>
                            <img src="{{ asset('/images/backend_images/products/large/'.$product->image) }}" alt="upload image." height=20px width=48px>
                        </td>
                        <td class="center">
                            <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini" title="See Product's Complete Imformation">view</a> 
                            <a href="{{ url('admin/edit_product/'.$product->id) }}" class="btn btn-primary btn-mini" title="Edit This Product">Edit</a>
                            <a href="{{ url('admin/add_attribute/'.$product->id) }}" class="btn btn-success btn-mini" title="Add Product Attributes">Add</a> 
                            <a href="{{ url('admin/add_images/'.$product->id) }}" class="btn btn-info btn-mini" title="Add Alternate Images For This Product">Add Im.</a> 
                            <a rel="{{ $product->id }}" rel1="delete_product" href="javascript:" <?php /*href="{{ url('admin/delete_product/'.$product->id) }}"*/?>
                               class="btn btn-danger btn-mini deleteRecord" title="Delete This Product">Delete</a>
                        </td>
                    </tr>     
                    <div id="myModal{{ $product->id }}" class="modal hide">
                        <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">×</button>
                            <h3 style="display:margin-left:50%;"> View Details For: {{ $product->product_name }}.</h3>
                        </div>
                        <div class="modal-body">
                        <p><b>Product ID:</b> {{ $product->id }}</p>
                        <p><b>Category Name:</b> {{ $product->category_name }}</p>
                        <p><b>Product Name:</b> {{ $product->product_name }}</p>
                        <p><b>Product Code:</b> {{ $product->product_code }}</p>
                        <p><b>Product Color:</b> {{ $product->product_color }}</p>
                        <p><b>Product Description:</b> {{ $product->description }}</p>
                        <p><b>Product Care:</b> {{ $product->care }}</p>
                        
                        <p><b>Status</b>
                            <?php 
                              if($product->status =="1") {
                               echo "Published";
                              }else{
                                echo "Not Published";
                              } 
                            ?>
                        </p> 
                        <p><b>Featured?: </b>
                            <?php 
                              if($product->featured_item =="1") {
                               echo "Yes Featured";
                              }else{
                                echo "Not Featured";
                              } 
                            ?>
                        </p> 

                        <p><b>Product Price:</b> <i style="color:hotpink;">$</i>{{ $product->price }}</p>
                        <p><b>Product Discount:</b> {{ $product->discount }}%</p>
                        <p>
                          <b>Product Image:</b>  <img src="{{ asset('/images/backend_images/products/large/'.$product->image) }}" alt="upload image." height=200px width=200px>
                        </p>
                            
                        </div>
                    </div>

                    @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

  

</div>
@endsection


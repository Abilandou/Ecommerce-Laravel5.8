@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Categories</a> <a href="#" class="current">view Categories</a> </div>
    
    <h1>Categories</h1>
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
            <h5>View Categories</h5><a href="/admin/add_category"  style="margin-left:65%; margin-top:2px;"  class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add Category</a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>status</th>
                  <th>Category Name</th>
                  <th>Category Level</th>
                  <th>Category URL</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($categories as $category)
                <tr class="gradeX">
                <td>{{ $category->id }}</td>
                <td>
                  <?php 
                      if($category->status =="1") {
                        echo "Published";
                      }else{
                        echo "Not Published";
                      } 
                  ?>
                </td>
                 <td>{{ $category->name }}</td>

                 <td>
                 <?php 
                      if($category->parent_id =="0") {
                        echo ("Main Category(".( $category->parent_id ).")");
                      }else{
                        echo  ( "sub-category(". ( $category->parent_id).")");
                      } 
                  ?>
                 </td>

                 <td>{{ $category->url }}</td>
                 <td class="center"><a href="{{ url('admin/edit_category/'.$category->id) }}" class="btn btn-primary btn-mini">Edit</a>
                    <a <?php /*id="delCat" href="{{ url('admin/delete_category/'.$category->id) }}"*/?> 
                     rel="{{$category->id}}" rel1="delete_category" href="javascript:"
                      class="btn btn-danger btn-mini deleteRecord">Delete</a></td>

                </tr>
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


@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Banners</a> <a href="#" class="current">view Banners</a> 
  </div>
    
    <h1>Banners</h1>
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
            <h5>View Banners</h5><a href="/admin/add_banner" style="margin-left:65%; margin-top:2px;"  class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add Banner</a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>Banner ID</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Banner Image</th> 
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr class="gradeX">
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->link }}</td>
                        <td>
                            <?php 
                              if($banner->status =="1") {
                               echo "Published";
                              }else{
                                echo "Not Published";
                              } 
                            ?>
                        </td>
                        <td>
                            <img src="{{ asset('/images/frontend_images/banners/'.$banner->image) }}" alt="upload image." height="60px" width="60px">
                        </td>
                        <td class="center">
                            <a href="{{ url('admin/edit_banner/'.$banner->id) }}" class="btn btn-primary btn-mini" title="Edit This banner">Edit</a>
                            <a rel="{{ $banner->id }}" rel1="delete_banner" href="javascript:" <?php /*href="{{ url('admin/delete_banner/'.$banner->id) }}"*/?>
                               class="btn btn-danger btn-mini deleteRecord" title="Delete This banner">Delete</a>
                        </td>
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


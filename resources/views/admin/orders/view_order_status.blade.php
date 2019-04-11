@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Order Status</a> <a href="#" class="current">view Order Status</a> </div>
    
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
            <h5>View Order Status</h5><a href="/admin/add_order_status"  style="margin-left:65%; margin-top:2px;"  class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add Order Status</a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Status ID</th>
                  <th>Status Name</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($orderStatus as $ordStatDet)
                <tr class="gradeX">
                <td>{{ $ordStatDet->id }}</td>
                 <td>{{ $ordStatDet->status_name }}</td>
                 <td>{{ $ordStatDet->status_description }}</td>
                 <td class="center"><a href="{{ url('admin/edit_order_status/'.$ordStatDet->id) }}" class="btn btn-primary btn-mini">Edit</a>
                    <a <?php /*id="delCat" href="{{ url('admin/delete_order_status/'.$ordStatDet->id) }}"*/?> 
                     rel="{{$ordStatDet->id}}" rel1="delete_order_status" href="javascript:"
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
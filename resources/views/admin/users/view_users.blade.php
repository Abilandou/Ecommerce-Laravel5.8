@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Users</a> <a href="#" class="current">view Users</a> </div>
    
    <h1>Users</h1>
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
            <h5>View Users</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Pincode</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Register On</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($allUsers as $user)
                <tr class="gradeX">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->state }}</td>
                <td>{{ $user->country }}</td>
                <td>{{ $user->pincode }}</td>
                <td>{{ $user->mobile }}</td>
                <td>
                  <?php 
                      if($user->status =="1") {
                        echo "Registered";
                      }else{
                        echo "Not Registerd";
                      } 
                  ?>
                </td>
                 <td>{{ $user->created_at }}</td>
                    <td><a <?php /*id="delCat" href="{{ url('admin/delete_user/'.$user->id) }}"*/?> 
                     rel="{{$user->id}}" rel1="delete_user" href="javascript:"
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


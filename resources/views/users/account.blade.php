@extends('layouts.frontLayout.front_design')
@section('content')


<section id="form"><!--form-->
    <div class="container">
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
        <div class="row">
            <div id="logindiv" class="col-sm-6 col-md-6 col-xm-6 col-lg-6 col-sm-offset-1">
                <div class="login-form form-group"><!--login form-->
                    <h2>Update  Account</h2>
                    <form action="{{ url('/account') }}" method="post" class="accountForm" id="accountForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" id="name" required value="{{ $userDetails->name }}" class="form-control" name="name" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="last_name" required value="{{ $userDetails->last_name }}" class="form-control" name="last_name" placeholder="Last Name" />
                        </div>
                        <div class="form-group">
                        <label>Address</label>
                            <input type="text" id="address" required value="{{ $userDetails->address }}" class="form-control" name="address" placeholder="Address" />
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="city" required value="{{ $userDetails->city }}" class="form-control" name="city" placeholder="City" />
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" id="state" required value="{{ $userDetails->state }}" class="form-control" name="state" placeholder="State" />
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <select id="country" name="country" required >
                                <option value="">Select Country</option>
                                @foreach($allCountries as $country)
                                    <option value="{{ $country->country_name }}" 
                                        @if($country->country_name == $userDetails->country ) selected @endif>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" required id="pincode" value="{{ $userDetails->pincode }}" class="form-control" name="pincode" placeholder="Pincode" /> 
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" required id="mobile" value="{{ $userDetails->mobile }}" class="form-control" name="mobile" placeholder="Mobile number" />
                        </div>                      
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>  
                </div><!--/login form-->
                <p id="loginDir">Update Password <a  id="signupInfo" href="#">Update</a></p>
            </div>

            <div id ="signupdiv"  class="col-sm-6 col-md-6 col-xm-6 col-lg-6 col-sm-offset-1">
                <div class="signup-form form-group"><!--sign up form-->
                    <h2>Update Password</h2>
                    
                    <form method="post" name="updateUserPasswordForm" id="updateUserPasswordForm"
                      class="updateUserPasswordForm" action="{{ url('/update_user_password') }}" 
                    >
                       {{ csrf_field() }}
                       <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" required id="current_password" name="current_password" placeholder="Current Password" class="form-control current_password">
                            <span id="checkPwd"></span>
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" required id="new_password" name="new_password" placeholder="New Password" class="form-control new_password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" required id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control confirm_password">
                        </div>

                        <button id="pass" type="submit" class="btn btn-default">Update</button>

                    </form>

                </div><!--/update user password form-->
                <p id="signUpDir">Update Account <a id="loginInfo" href="#">Update</a></p>
            </div>
        </div>
    </div>
</section><!--/form-->


@endsection
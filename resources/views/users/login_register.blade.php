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
                    <h2>Login to your account</h2>
                    <form action="{{ url('/user_login') }}" method="post" class="loginFormD" id="loginFormD">
                        {{ csrf_field() }}
                        <input type="email" class="form-control" name="email" placeholder="Email Address" />
                        <input type="password" id="myPasswordLogin" class="form-control" name="password" placeholder="Password" />
                        <!-- <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span> -->
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
                <p id="loginDir">No account? <a  id="signupInfo" href="#">Create Account</a></p>
                <p id="forgotPassDir" style="margin-top:-28px; margin-left:-80px;" class="pull-right">Forgot Password? <a  id="forgotPassInfo" href="{{url('/forgot_password') }}">Get Helping Hand</a></p>
            </div>

            <!-- <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div> -->
            <div id ="signupdiv"  class="col-sm-6 col-md-6 col-xm-6 col-lg-6 col-sm-offset-1">
                <div class="signup-form form-group"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{url('/user_register') }}" method="post" class="registerForm" id="registerForm">
                        {{ csrf_field() }}
                        <input type="text" class="form-control" name="name" placeholder="Name"/>
                        <input type="email" class="form-control" name="email" placeholder="Email Address"/>
                        <input type="password" class="form-control" id="myPasswordRegister" name="password" placeholder="Password"/>
                        <button id="signUpBut" type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
                <p id="signUpDir">Already have an account? <a id="loginInfo" href="#">Login</a></p>
            </div>
        </div>
    </div>
</section><!--/form-->


@endsection
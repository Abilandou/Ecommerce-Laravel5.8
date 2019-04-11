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
            <div id ="forgotPassdiv"  class="col-sm-6 col-md-6 col-xm-6 col-lg-6 col-sm-offset-1" >
                <div class="forgotPassword-form form-group"><!--sign up form-->
                    <h4>Get New Password!</h4>
                    <form action="{{url('/forgot_password') }}" method="post" class="forgotPasswordForm" id="forgotPasswordForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="email" required class="form-control" name="email" placeholder="Email Address"/>
                        </div>
                        <div class="form-group">
                            <button id="forgotPassBut" type="submit" class="btn btn-success">Get PassWord</button>
                        </div>
                    </form>
                </div><!--/sign up form-->
                <p id="backToLoginDir">Back To <a id="backToLoginInfo" href="{{url('/login_register') }}">Login?</a></p>
            </div>
        </div>
    </div>
</section>



@endsection
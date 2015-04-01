@extends('layouts.default')
@section('content')	

<div class="row" style = "margin-top: 10%; margin-bottom: 100px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Login</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url' => 'login')) }}
                @if(Session::get("message") == "0")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Pleale login or register a account before post a job. Thanks
                
                </div>
                @endif
                @if(Session::get("emailfirst") == "1")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    An email is sent to your email address. please click the link to verify your email account and phone number before you can login.
                
                </div>
                @endif
                @if(Session::get("success") == "0")
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Wrong combination of email/password.
                </div>
                @endif
                @if(Session::get("confirmed") == "1")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Verification success. Now you can login.
                </div>
                @elseif(Session::get("confirmed") == "0")
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Email Verification fail.
                </div>
                @endif
                @if(Session::get("changepass") == "1")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Please check your email for new password.
                </div>
                @endif
                @if(Session::get("facebook") == "1")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    There was an error communicating with Facebook.
                </div>
                @endif
                
				@if($errors->any())
				<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>

				@endif
				
                    <fieldset>
                        <div class="form-group">
                        	{{ Form::text('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
                        </div>
                        <div class="checkbox" style="text-align:right">
                            <label>
                                <input name="remember_me" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <div class="form-group" style="text-align:right">
                            {{ HTML::link('forgetpass', 'Forgot your password?', array('style' => 'display:inline;margin-top:10px')) }}
                            {{ Form::submit('Login', array('class' => 'btn btn-success')) }}
                            {{ HTML::link('register', 'Register', array('class' => 'btn btn-primary')) }}
                            
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
           
        </div>
    </div>
</div>


@stop
@extends('layouts.default')
@section('content')
	
<div class="row" style = "margin-top :5%; margin-bottom: 270px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Reset password</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url' => 'forgetpass')) }}
                <!--change here-->
                @if(Session::get("changepass") == "0")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Please check your email inbox for a password reset link.
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>
                @endif
                <!--change here-->
                    <fieldset>
                        <div class="form-group">
                        	{{ Form::text('email', '', array('placeholder' => 'Input your email account', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group" style="text-align:right">
                            {{ Form::submit('Reset password', array('class' => 'btn btn-success')) }}
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop
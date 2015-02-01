@extends('layouts.default')
@section('content')
<style>
	.text-login {
		color: #53A524;
	}
	.floating-label {
		font-size: 200%;
		color: red;
	}
</style>	
<div class="main-body-container">
<div class="login-background" style="background-image: url({{ asset('home_page/img/Wood_Wallpaper_by_stenosis.jpg') }});">
<div class="row">
<form accept-charset="UTF-8" action="#" class="simple_form analytics-event" data-event-name="regular email log in attempt" id="new_user_session" method="post">
	<div class="login-block" >
		<p class="larger center" style = "color: #53A524">Reset your Password</p>
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
<p style = "font-size: 100%; color: #53A524; text-align: center;">You'll receive an email with a link to reset your password.</p>
		<div class="form-fields-wrapper" style = " max-width: 25em">
			<div class="pad-top">
				<div class="form-control-wrapper" style = "margin-bottom: 10%;" >
					<input name = "email" style = "color: #009587; font-size: 110%;	margin-bottom: 5%;" type="email" class="form-control empty" data-hint="A valid email should contains @"><div class="hint">A valid email should contains @</div>
					<div class="floating-label" style = "color: #53A524;">Email</div>
					<span class="material-input"></span>
				</div>			
			</div>
			
		</div>
		
		<div class="form-fields-wrapper">
			<div class="form-steps-bottom"></div>
			<style>
				#btn-submit {
					background-color: #8cc63f; 
					border: 1px solid #8cc63f; 
					color: #fff;
				}
				#btn-submit:hover {
					background-color: #53A524; 
					border: 1px solid #53A524; 
					color: #fff;
				}
			</style>
			<input class="button btn-full push-top btn-primary" name="commit" type="submit" value="Send to Email" id = "btn-submit" id = "btn-submit">
		</div>
		
		
	</div>
</form>
</div>
</div>
</div>


@stop
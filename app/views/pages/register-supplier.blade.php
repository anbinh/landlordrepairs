@extends('layouts.default')
@section('content')	

<div class="main-body-container">
<div class="login-background" style="background-image: url({{ asset('home_page/img/Wood_Wallpaper_by_stenosis.jpg') }});">
<div class="row">
<form accept-charset="UTF-8" action="{{URL::to('register-supplier')}}" class="simple_form analytics-event" data-event-name="regular email log in attempt" id="new_user_session" method="post">
	<div class="login-block" >
		<p class="larger center color-53A524">Register for Supplier</p>
		@if($errors->any())
			<div class="alert alert-danger alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 {{ implode('', $errors->all('<li class="error">:message</li>')) }}
         	</div>

		@endif
		<div class="form-fields-wrapper" id = "form-fields-wrapper-plusCss">
			<div class="pad-top">
				<div class="form-control-wrapper" id = "form-control-wrapper-plusCss" >
					<input name = "username" id = "input-email-plusCss" type="text" class="form-control empty" data-hint="A valid email should contains @" required><div class="hint">A valid email should contains @</div>
					<div class="floating-label" id = "floating-label-plusCss">User name</div>
					<span class="material-input"></span>
				</div>			
			</div>
			<div class="pad-top">
				<div class="form-control-wrapper" id = "form-control-wrapper-plusCss" >
					<input name = "email" id = "input-email-plusCss" type="email" class="form-control empty" data-hint="A valid email should contains @" required><div class="hint">A valid email should contains @</div>
					<div class="floating-label" id = "floating-label-plusCss">Email</div>
					<span class="material-input"></span>
				</div>			
			</div>
			<div class="pad-top">
				<div class="form-control-wrapper" >
					<input style = "color: #009587; font-size: 110%;" type="password" id = "input-email-plusCss" class="form-control empty" data-hint="" required name = "password">
					<div class="hint"></div>
					<div class="floating-label" id = "floating-label-plusCss">Password</div>
					
					<span class="material-input"></span>
				</div>
			</div>
			<div class="pad-top">
				<div class="form-control-wrapper">
					<input style = "color: #009587; font-size: 110%;" type="password" id = "input-email-plusCss"  class="form-control empty" data-hint="" required name = "password_confirmation">
					<div class="hint"></div>
					<div class="floating-label" id = "floating-label-plusCss">Re-Enter Password</div>
					<span class="material-input"></span>
				</div>
			</div>
			<div class="pad-top">
				<div class="form-control-wrapper">
					<input style = "color: #009587; font-size: 110%;" type="text" id = "input-email-plusCss" class="form-control empty" data-hint="" required name = "phone_number">
					<div class="hint"></div>
					<div class="floating-label" id = "floating-label-plusCss">Phone number</div>
					<span class="material-input"></span>
				</div>
			</div>
			<div class="pad-top">
				<div class="form-control-wrapper">
					<label for="select" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label padding-zero select-title">Area:</label>
            		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 padding-zero">
	                  <select class="form-control select-color margin-bottom" name = "area">
						    <option>Dubai</option>
	                  </select>
					</div>
				</div>
			</div>
			
			<div class="pad-top">
				<div class="form-control-wrapper">
					<label for="select" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label padding-zero select-title">City:</label>
            		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 padding-zero">
	                  <select class="form-control select-color margin-bottom" name = "city">
						    <option>Al Badaa</option>
						    <option>Al Barsha</option>
						    <option>Al Hamriya</option>
						    <option>Al Hudaiba</option>
						    <option>Al Jafeliah</option>
						    <option>Al Karama</option>
						    <option>Al Mankhool</option>
						    <option>Al Qouz</option>
						    <option>Al Refaa</option>
						    <option>Al Sofouh</option>
						    <option>Al Souq Al Kabeer</option>
						    <option>Al Wasl</option>
						    <option>Jumeirah</option>
						    <option>Madinat Dubai Al Melaheyah</option>
						    <option>Oud Metha</option>
						    <option>Satwa</option>
						    <option>Trade Center 1</option>
						    <option>Trade Center 2</option>
						    <option>Umm Hurair</option>
						    <option>Umm  Suqeim</option>
						    <option>Al Qouz (ALkhail Gate Project)</option>
						    <option>Al Safa</option>
	                  </select>
					</div>
				</div>
			</div>
			
			
			
		</div>
		
		<div class="form-fields-wrapper">
			<div class="form-steps-bottom"></div>
			
			<input class="button btn-full push-top btn-primary" name="commit" type="submit" value="Register" id = "btn-submit" id = "btn-submit">
		</div>
	</div>
</form>
      

</div>
</div>
</div>
<link rel="stylesheet" href="{{ asset('home_page/css/include-login.css?1') }}">


@stop
@extends('blank')

@section('content')

@extends('blank')

@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Register</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url' => 'register')) }}
				@if($errors->any())
				<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>

				@endif
                    <fieldset>
                        <div class="form-group">
                        	{{ Form::text('username', '', array('placeholder' => 'Username', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::text('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password_confirmation', array('placeholder' => 'Re-enter Password', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group" style="text-align:right">
							{{ Form::submit('Register', array('class' => 'btn btn-success')) }}
							{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-danger')) }}                           
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop



<div class="row">
	<div class="span4 offset1">
		<div class="well">
			<legend>Please Register</legend>
			
			@if($errors->any())
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif
			
			<br>
			<br>

			
		</div>
	</div>
</div>


@stop
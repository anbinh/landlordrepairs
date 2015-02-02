@extends('blank')

@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Choose new password</h3>
            </div>
            <div class="panel-body">

                {{ Form::open() }}
                @if($errors->any())
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>
                @endif
                <!--change here-->
                    <fieldset>
                        <div class="form-group">
                            {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password_confirmation', array('placeholder' => 'Re-enter Password', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group" style="text-align:right">
                            {{ Form::submit('Set password', array('class' => 'btn btn-success')) }}
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop
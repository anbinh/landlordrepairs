@extends('layouts.default')
@section('content')	

<div class="row" style = "margin-top: 10%; margin-bottom: 100px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Confirm phone number</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url' => 'phoneconfirm')) }}
                @if(Session::get("phone_confirm") == "0")
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Wrong confirm phone number11
                </div>
                @endif
                @if(Session::get("phone_confirm") == "1")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Success
                </div>
                @endif
                
                
				
                    <fieldset>
                        <div class="form-group">
                        	{{ Form::text('phoneconfirm', '', array('placeholder' => 'Code', 'class' => 'form-control')) }}
                        </div>
                        
                        
                        <div class="form-group" style="text-align:right">
                   
                            {{ Form::submit('Confirm', array('class' => 'btn btn-success')) }}
                            
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


@stop
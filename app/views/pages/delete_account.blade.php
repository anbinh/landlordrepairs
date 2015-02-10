@extends('layouts.default')
@section('content')	

<div class="row" style = "margin-top: 10%; margin-bottom: 100px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Delete Account with email</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url' => 'delete_account')) }}
                @if(Session::get("delete_account") == "0")
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Not have account with this email, you can register with this email now
                </div>
                @endif
                @if(Session::get("delete_account") == "1")
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Delete user success, you can register with this email again 
                </div>
                @endif
                
                
				
                    <fieldset>
                        <div class="form-group">
                        	{{ Form::text('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
                        </div>
                        
                        
                        <div class="form-group" style="text-align:right">
                   
                            {{ Form::submit('Delete', array('class' => 'btn btn-success')) }}
                            
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


@stop
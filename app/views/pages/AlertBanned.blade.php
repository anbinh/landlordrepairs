@extends('layouts.default')
@section('content')	
<div class="row" style = "margin-top: 10%; margin-bottom: 80px;">
<style>
.col-lg-8 {
	padding-left: 0px;
	padding-right: 0px;
}
#submit-div {
	text-align: center;
}
</style>
    <div class="col-md-4 col-md-offset-4">
   				 @if($errors->any())
					<div class="alert alert-danger alert-dismissable">
		                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                 {{ implode('', $errors->all('<li class="error">:message</li>')) }}
		         	</div>
		
				@endif
				@if(Session::get("success") == "1")
                 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Post job success
                </div>
                @endif
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ALERT</h3>
            </div>
            <div class="panel-body">
				YOUR ACCOUNT HAS BEEN BANNED BY ADMIN, SO YOU CANNOT POST JOB WITHIN 5 DAYS SINCE {{$date}}.
			</div>
			</div>
        </div>
    </div>


@stop
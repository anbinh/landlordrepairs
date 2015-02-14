
@extends('layouts.default')
@section('content')
	<div class="container" style= "margin-bottom: 160px;">
			<div class="row">
				<h1 class="text-center">Dashboard</h1>
			</div>
			<div class="col-md-2">
				<div class="list-group">
					  <a href="#" class="list-group-item active">
					    Dashboard
					  </a>
					  <a href="#" class="list-group-item">My Profile</a>
					  <a href="#" class="list-group-item">Jobs</a>
					  <a href="#" class="list-group-item">My Invites</a>
					  <a href="#" class="list-group-item">My favorites</a>
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				    <div class="col-lg-4">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                User Profile
				            </div>
			            <div class="panel-body">
			                <div class="row">
			                    <div class="col-lg-12">
			                        @if($errors->any())
			                        <div class="alert alert-danger alert-dismissable">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
			                        </div>
			                        @endif
			                        @if(Session::get("success") == '1')
			                        <div class="alert alert-success alert-dismissable">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                            Profile has been updated successfully.
			                        </div>
			                        @endif
			                        
			                       {{ Form::open(array('url' => 'change_password')) }}
		                            <div class="form-group">
		                                <label>Username</label>
		                                {{ Form::text('username', $user->username, array('placeholder' => 'Choose your username', 'class' => 'form-control')) }}
		                            </div>
		                           
		                            <div class="form-group">
		                                <label>Email</label>
		                                {{ Form::text('email', $user->email, array('placeholder' => 'Type your email','class' => 'form-control')) }}
		                            </div>
		                           

		                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		                            
		                        {{ Form::close() }}
		                    </div>
		                </div>
		            </div>
        </div>
    </div>
    <!-- end col-md-6-->
      <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change password
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      
                        @if(Session::get("cpsuccess") == "1")
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            User password has been changed successfully.
                        </div>
                        @endif
                        {{ Form::open(array('url' => 'change_password')) }}
                            <div class="form-group">
                                <label>New Password</label>
                                {{ Form::text('password','', array('placeholder' => 'Type your new Password', 'class' => 'form-control')) }}
                            </div>
                           

                            {{ Form::submit('Change password', array('class' => 'btn btn-primary')) }}
                           
                        {{ Form::close() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end change password-->
      <div class="col-lg-3" >
        <div class="panel panel-default">
            <div class="panel-heading">
                Change Phone Number
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        
                        @if(Session::get("phonesuccess") == "1")
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Phonenumber has been changed successfully.
                        </div>
                        @endif
                        {{ Form::open(array('url' => 'change_phonenumber')) }}
                            <div class="form-group">
                                <label>New Phonenumber</label>
                                {{ Form::text('phonenumber','', array('placeholder' => 'Type your new Phonenumber', 'class' => 'form-control')) }}
                            </div>
                           
                            {{ Form::submit('Change Phonenumber', array('class' => 'btn btn-primary')) }}
                           
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end change phone number -->
</div>
			</div>
		</div>
		
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@stop